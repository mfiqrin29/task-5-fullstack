<?php

namespace App\Http\Controllers\Author;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $article = Article::all()->where('user_id', auth()->user()->id)->count();

        $category = Category::all()->count();

        return view('pages.author.dashboard', [
            'article' => $article,
            'category' => $category
        ]);
    }
}
