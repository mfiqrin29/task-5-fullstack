<?php

namespace App\Http\Controllers\Author;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::all()->where('user_id', auth()->user()->id);

        return view('pages.author.article.index', [
            'articles' => $articles
        ]);
    }

    public function create()
    {
        $categories = Category::all();

        return view('pages.author.article.create', [
            'categories' => $categories
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->except('_token');

        $request->validate([
            'title' => 'required|string',
            'content' => 'required|string',
            'image' => 'required|image|mimes:jpeg,jpg,png',
        ]);
        
        $data['user_id'] = $request->user()->id;        
        $image = $request->image;
        
        $originalImageName = Str::random(3).$image->getClientOriginalName();
        
        $image->storeAs('public/article', $originalImageName);
        
        $data['image'] = $originalImageName;
        
        // dd($data);

        Article::create($data);

        return redirect()->route('author.article.index');
    }

    public function edit($id)
    {
        $article = Article::find($id);
        $categories = Category::all();

        return view('pages.author.article.edit', [
            'article' => $article,
            'categories' => $categories
        ]);
    }

    public function update(Request $request, $id)
    {
        $data = $request->except('_token');

        $request->validate([
            'title' => 'required|string',
            'content' => 'required|string',
            'image' => 'required|image|mimes:jpeg,jpg,png',
        ]);

        $article = Article::find($id);

        if ($request->image) {
            // save new image
            $image = $request->image;
            $originalImageName = Str::random(3).$image->getClientOriginalName();
            $image->storeAs('public/article', $originalImageName);
            $data['image'] = $originalImageName;

            // delete old image
            Storage::delete('public/article/'.$article->image);
        }

        $article->update($data);

        return redirect()->route('author.article.index');
    }

    public function destroy($id)
    {
        Article::find($id)->delete();

        return redirect()->route('author.article.index');
    }
}
