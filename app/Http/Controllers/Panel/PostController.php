<?php

namespace App\Http\Controllers\Panel;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Panel\Post\CreatePostRequest;
use App\Http\Requests\Panel\Post\UpdatePostRequest;
use App\Models\Category;
use Illuminate\Validation\ValidationException;

class PostController extends Controller
{

    public function index()
    {
        if(auth()->user()->role == 'author')
            $posts = Post::where('user_id', auth()->user()->id)->with('user')->paginate(7);
        else
            $posts = Post::with('user')->paginate(7);

        return view('panel.posts.index', compact('posts'));
    }

 
    public function create()
    {
        return view('panel.posts.create');
    }

  
    public function store(CreatePostRequest $request)
    {
        // categories
    //  $categoryIds = Category::whereIn('name', $request->categories)->get()->pluck('id')->toArray();
        $categoryIds = Category::whereIn('name', $request->categories)->get()->pluck('id')->toArray(); // whereIn : برای جستجو بین مقادیر ارایه 
        if(count($categoryIds) < 1 )
            throw ValidationException::withMessages(['categories' => ['دسته بندی یافت نشد!']]);

        // file
        $file = $request->file('banner');
        $file_name = $file->getClientOriginalName(); // getClientOriginalName : نام اولیه فایل را برمیگردد
        $file->storeAs('images/banners', $file_name, 'public_files' /*تعقیر دیسک پیش فرض*/); // storeAs : محل ذخیره شدن 
        
        $data = $request->validated();
        $data['banner'] = $file_name;
        $data['user_id'] = auth()->user()->id;

        // validate
        $post = Post::create(
            $data
        );

        $post->categories()->sync($categoryIds);

        session()->flash('status', 'مقاله به درستی ایجاد شد ');
        // redirect
        return redirect()->route('posts.index');
    }

  
    public function show(Post $post)
    {
        //
    }


    public function edit(Post $post)
    {
        return view('panel.posts.edit', compact('post'));
    }

    public function update(UpdatePostRequest $request, Post $post)
    {
        // dd($request);

        $categoryIds = Category::whereIn('name', $request->categories)->get()->pluck('id')->toArray(); // whereIn : برای جستجو بین مقادیر ارایه 
        if(count($categoryIds) < 1 )
            throw ValidationException::withMessages(['categories' => ['دسته بندی یافت نشد!']]);

        // file
        $data = $request->validated();
        
            if($request->hasFile('banner'))
            {
                $file = $request->file('banner');
                $file_name = $file->getClientOriginalName(); // getClientOriginalName : نام اولیه فایل را برمیگردد
                $file->storeAs('images/banners', $file_name, 'public_files' /*تعقیر دیسک پیش فرض*/); // storeAs : محل ذخیره شدن 

                $data['banner'] = $file_name;
            }


        // validate
        $post->update(
            $data
        );

        $post->categories()->sync($categoryIds);

        session()->flash('status', 'مقاله به درستی ویرایش شد ');
        // redirect
        return redirect()->route('posts.index');
    }

    public function destroy(Post $post)
    {
        $post->delete();

        session()->flash('status', 'مقاله به درستی پاک شد!');

        return back();
    }
}
