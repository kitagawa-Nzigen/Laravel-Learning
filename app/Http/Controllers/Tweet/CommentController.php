<?php

namespace App\Http\Controllers\Tweet;

use App\Http\Controllers\Controller;
use App\Models\Tweet;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function __invoke(Request $request, $tweetId)
    {
        $tweet = Tweet::findOrFail($tweetId);

        $comment = new Comment;
        $comment->body = $request->body;
        $comment->user_id = auth()->id();

        $tweet->comments()->save($comment);

        return redirect()->back();
    }
}
