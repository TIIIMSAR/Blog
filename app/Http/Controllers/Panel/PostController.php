<?php

namespace App\Http\Controllers\Panel;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Panel\Post\CreatePostRequest;
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

  
    public function store(CreatePostRequest $request)
    {
        dd($request->all());
        // categories
        $categoriyIds = Category::whereIn('name', $request->categories)->get()->pluck('id')->toArray(); // whereIn : برای جستجو بین مقادیر ارایه 
        // file

        $file = $request->file('banner');
        $file_name = $file->getClientOriginalName(); // getClientOriginalName : نام اولیه فایل را برمیگردد
        $file->storeAs('images/banners', $file_name, 'public_files' /*تعقیر دیسک پیش فرض*/); // storeAs : محل ذخیره شدن 
        
        // validate
        Post::create(
            $request->validated()
        );

        // redirect
        return redirect()->route('posts.index');
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
