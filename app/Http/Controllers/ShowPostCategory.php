<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class ShowPostCategory extends Controller
{
    public function show(Category $category)
    {
        $posts = $category->posts()->paginate(7);

        return view('landing', compact('posts'));
    }
}
