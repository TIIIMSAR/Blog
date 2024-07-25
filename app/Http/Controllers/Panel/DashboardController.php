<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $users_count = User::count();
        $categories_count = Category::count();
        $posts_count = Post::count();
        $comments_count = Comment::count();
        
            // نویسند ها پست ها و نظر های خودشان را دریافت کنند
        if(auth()->user()->role == 'author')
            $posts_count = Post::where('user_id', auth()->user()->id)->count();
            $comments_count = Comment::whereHas('post', function($query){
                return $query->where('user_id', auth()->user()->id); 
            })->count();//select count(*) as aggregate from 'comments' where exists 
                                                        //(select * from 'posts' where 'comments', 'user_id' = 'post', 'id' and 'user_id' = ... );


        return view('panel.index', compact(
            'users_count',
            'posts_count',
            'categories_count',
            'comments_count'
        ));
    }
}
