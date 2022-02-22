<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Http\Requests\PostRequest;

class PostController extends Controller
{
    //
    public function index()
    {
        $posts = Post::All();
        return [$posts];
    }

    public function show($postID)
    {
        $post = Post::findOrFail($postID);
        return $post;
    }

    public function store(PostRequest $request){
        $requestData = request()->all();
        $post = Post::create($requestData);

        return $post;
    }
}
