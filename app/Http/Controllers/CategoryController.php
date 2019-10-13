<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.admin.categories.categories');
    }

    public function getData(Request $request)
    {
        $data = DB::table('categories')
            ->select('id', 'name');

        return DataTables()->of($data)->make(true);
    }

    public function validation($request)
    {
        return Validator::make($request->all(), [
            'name' => 'required|max:255',
        ]);
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

        Category::create([
            'name'   => $request->name,
        ]);

        return response()->json(['error' => false, 'messages' => ['Categoria adicionada com sucesso.']]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id, ['id', 'name']);

        return response()->json($category);
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

        Category::findOrFail($request->id)->update([
            'name'   => $request->name,
        ]);

        return response()->json(['error' => false, 'messages' => ['Categoria modificada com sucesso.']]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Category::findOrFail($id)->delete();
    }
}
