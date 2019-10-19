<?php

namespace App\Http\Controllers;

use App\Article;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ArticleController extends Controller
{

	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::get(['id', 'name']);

        return view('dashboard.admin.articles.articles')->with(compact('categories'));
    }

    public function getData()
    {
        $articles = DB::table('articles')
            ->select('articles.id', 'title', 'categories.name AS category')
            ->selectRaw('DATE_FORMAT(date,"%d/%m/%Y") AS `date`')
            ->selectRaw('CASE WHEN `featured` = 1 THEN "Sim" ELSE "Não" END AS `featured`')
            ->selectRaw(' CASE WHEN `featured` = "DRAFT" THEN "Revisão" ELSE "Publicado" END AS `status`')
            ->join('categories', 'categories.id', '=', 'articles.category_id')
            ->whereNull('articles.deleted_at')
            ->get();

        return DataTables()->of($articles)->make(true);
    }

    public function validation($request)
    {
        return Validator::make($request->all(), [
            'title' => 'required|min:2|max:255',
            'content' => 'required|min:2',
            'date' => 'date|nullable',
            'status' => 'required',
            'category' => 'required',
        ]);
    }

    public function summerNote($request)
    {
        $dom = new \DomDocument();

        $dom->loadHtml($request->input('content'), LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

        $images = $dom->getElementsByTagName('img');

        foreach($images as $k => $img){
            $data = $img->getattribute('src');

            if (strpos($data,'base64') == true)
            {
                list($type, $data) = explode(';', $data);
                list(, $data) = explode(',', $data);

                $data = base64_decode($data);
                $image_name = time() . $k . '.png';
                $path = storage_path('app/public/article/') . $image_name;

                file_put_contents($path, $data);

                $img->removeAttribute('src');
                $img->removeAttribute('data-filename');
                $img->setAttribute('src', '/storage/article/'. $image_name);
            }
        }

        return $dom->saveHTML();
    }

    public function uploadImage($request)
    {
        $image = 'article_image'.time().'.'.request()->image->getClientOriginalExtension();
        $request->image->storeAs('article',$image, 'public');

        return response()->json($image);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $error = $this->validation($request);

        if($error->fails())
            return response()->json(['error' => true, 'messages' => $error->errors()->all()]);

        $content = $this->summerNote($request);

        Article::create([
            'category_id'   => $request->category,
            'user_id'       => Auth::id(),
            'title'         => $request->title,
            'content'       => $content,
            'image'         => ($request->image) ? $this->uploadImage($request)->original : NULL,
            'status'        => $request->status,
            'date'          => ($request->date) ? $request->date : NOW(),
            'featured'      => $request->featured,
        ]);

        return response()->json(['error' => false, 'messages' => ['Notícia adicionada com sucesso.']]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $article = Article::findOrFail($id, ['title', 'date', 'content']);

        return view('single-article')->with(compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $article = Article::findOrFail($id, ['id', 'title', 'content', 'status', 'date', 'featured', 'category_id as category']);

        return response()->json($article);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $error = $this->validation($request);

        if($error->fails())
            return response()->json(['error' => true, 'messages' => $error->errors()->all()]);

        $content = $this->summerNote($request);

        $data = [
            'category_id'   => $request->category,
            'title'         => $request->title,
            'content'       => $content,
            'status'        => $request->status,
            'featured'      => $request->featured
        ];

        ($request->image) ? $data['image'] = $this->uploadImage($request)->original : '';
        ($request->date) ? $data['date'] = $request->date : '';

        Article::findOrFail($request->id)->update($data);

        return response()->json(['error' => false, 'messages' => ['Notícia modificada com sucesso.']]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Article::findOrFail($id)->delete();
    }
}
