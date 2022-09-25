<?php

namespace App\Http\Controllers\Author;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        return view('pages.author.category.index', [
            'categories' => $categories
        ]);
    }

    public function create()
    {
        return view('pages.author.category.create');
    }

    public function store(Request $request)
    {
        $data = $request->except('_token');

        $request->validate([
            'name' => 'required|string'
        ]);

        $data['user_id'] = ($request->user()->id);

        // dd($data);

        Category::create($data);

        return redirect()->route('author.category.index');
    }

    public function edit($id)
    {
        $category = Category::find($id);

        return view('pages.author.category.edit', [
            'category' => $category
        ]);
    }

    public function update(Request $request, $id)
    {
        $data = $request->except('_token');

        $request->validate([
            'name' => 'required|string'
        ]);

        $category = Category::find($id);

        $category->update($data);

        return redirect()->route('author.category.index');
    }

    public function destroy($id)
    {
        Category::find($id)->delete();

        return redirect()->route('author.category.index');
    }
}
