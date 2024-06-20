<?php

namespace App\Http\Controllers\Panel;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;

class PostController extends Controller
{

    public function index()
    {
        return view('panel.posts.index');
    }

 
    public function create()
    {
        return view('panel.posts.create');
    }

  
    public function store(Request $request)
    {
        $request->validate([
            'categories' =>['required','array'],
            'title' =>['required','string', 'max:255'],
            'categories.*' =>['required','string'],
            'banner' =>['required', 'image'],
        ]);
        // dd($request->categories);    
        // dd($request->all());
        $categoriyIds = Category::whereIn('name', $request->categories)->get()->pluck('id')->toArray();
        $file = $request->file('banner');
        $file_name = $file->getClientOriginalName();

        $file->storeAs('images/banners', $file_name, 'public_files');
        return back();
    }

  
    public function show(Post $post)
    {
        //
    }


    public function edit($post)
    {
        return view('panel.posts.edit');
    }

    public function update(Request $request, Post $post)
    {
        //
    }

    public function destroy(Post $post)
    {
        //
    }
}
