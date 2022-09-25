<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $article = Article::all()->count();
        $category = Category::all()->count();
        $user = User::where('roles', 'AUTHOR')->count();

        return view('pages.admin.dashboard', [
            'article' => $article,
            'category' => $category,
            'user' => $user
        ]);
    }
}
