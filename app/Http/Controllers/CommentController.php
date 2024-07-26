<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'content' => ['required'],
            'post_id' => ['required', 'exists:posts,id'],
        ]);

        $data['user_id'] = auth()->user()->id;

        Comment::create($data);

        return back();
    }
}
