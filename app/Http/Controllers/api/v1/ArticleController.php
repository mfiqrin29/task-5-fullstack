<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Article::paginate(2);

        return response([
            'data' => $posts
        ], 200);
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
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:100',
            'content' => 'required|string|max:1000',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'category_id' => 'required|integer|exists:categories,id',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $image = $request->image;

        $originalImageName = Str::random(3).$image->getClientOriginalName();
        
        $image->storeAs('public/article', $originalImageName);

        $article = Article::create([
            'title' => $request->title,
            'content' => $request->content,     
            'image' => $originalImageName,    
            'user_id' => $request->user()->id,
            'category_id' => $request->category_id
        ]);        

        return response()->json([
            'success' => true,
            'message' => 'Create Article Success!',
            'data'    => $article  
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $article = Article::find($id);

        return response([
            'data' => $article
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:100',
            'content' => 'required|string|max:1000',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'category_id' => 'required|integer|exists:categories,id',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $article = Article::find($id);

        $article->title = $request->title;
        $article->content = $request->content;        
        $article->category_id = $request->category_id;

        if ($request->image) {
            // save new image
            $image = $request->image;
            $originalImageName = Str::random(3).$image->getClientOriginalName();
            $image->storeAs('public/article', $originalImageName);
            $data['image'] = $originalImageName;

            // delete old image
            Storage::delete('public/article/'.$article->image);
        }

        $article->update();

        return response()->json([
            'success' => true,
            'message' => 'Update Article Success!',
            'data'    => $article  
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $article = Article::find($id)->delete();

        return response()->json([
            'success' => true,
            'message' => 'Delete Article Success!',
            'data'    => $article  
        ]);
    }
}
