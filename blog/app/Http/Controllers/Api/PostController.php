<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Http\Requests\PostRequest;
use App\Http\Resources\PostResource;

class PostController extends Controller
{
    //
    public function index()
    {
        // $posts = Post::all();
        $posts = Post::paginate(3);
        return PostResource::collection($posts);
    }

    public function show($postID)
    {
        $post = Post::findOrFail($postID);
        return new PostResource($post);
    }

    public function store(PostRequest $request)
    {
        $requestData = request()->all();
        $post = Post::create($requestData);

        return new PostResource($post);
    }
}
