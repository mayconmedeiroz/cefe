<?php

namespace CEFE\Http\Controllers;

use CEFE\BlogPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.admin.blog.blog');
    }

    public function indexHome()
    {
        $posts = BlogPost::select(['id', 'title', 'created_at', 'image'])
            ->orderByDesc('id')
            ->paginate('9');

        return view('blog')->with(compact('posts'));
    }

    public function validation($request)
    {
        return Validator::make($request->all(), [
            'title' => 'required',
            'body' => 'required|max:65536',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    }

    public function getData()
    {
        if (request()->ajax()) {
            $posts = BlogPost::with('user:id,name')->get(['id', 'title', 'user_id']);

            return DataTables()->of($posts)
                ->addColumn('action', function ($data) {
                    $button = '<button type="button" name="edit" id="' . $data->id . '" class="edit btn btn-primary btn-sm mx-lg-1"><i class="fas fa-edit"></i></button>';
                    $button .= '<button type="button" name="delete" id="' . $data->id . '" class="delete btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>';
                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function uploadImage(Request $request)
    {
        $image = 'blog'.time().'.'.request()->image->getClientOriginalExtension();
        $request->image->storeAs('posts',$image);

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
            return response()->json(['errors' => $error->errors()->all()]);

        BlogPost::create([
            'user_id' => Auth::user()->id,
            'image' => ($request->image) ? $this->uploadImage($request)->original : 'default.jpg',
            'title' => $request->title,
            'body' => $request->body,
        ]);

        return response()->json(['success' => 'Postagem adicionada com sucesso.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = BlogPost::findOrFail($id, ['blog_posts.id', 'blog_posts.title', 'blog_posts.body', 'blog_posts.created_at']);

        return view('news-single')->with(compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = BlogPost::findOrFail($id, ['blog_posts.id', 'blog_posts.title', 'blog_posts.body']);

        return response()->json($post);
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
            return response()->json(['errors' => $error->errors()->all()]);

        $post = [
            'title' => $request->title,
            'body' =>  $request->body,
        ];

        if(isset($request->image)) {
            $post['image'] = $this->uploadImage($request)->original;
        }

        BlogPost::findOrFail($request->hidden_id)->update($post);

        return response()->json(['success' => 'Posteagem atualizada com sucesso.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        BlogPost::findOrFail($id)->delete();
    }
}
