<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use Illuminate\Http\Request;
use Illuminate\Pagination;
use Cviebrock\EloquentSluggable\Services\SlugService;

use function GuzzleHttp\Promise\all;
use App\Models\Post;
use App\Models\User;

class PostController extends Controller
{

    // public $posts = [
    //     ['id' => 1, 'title' => 'first post', 'description' => 'this is a post', 'posted_by' => 'Reem', 'created_at' => '2022-02-19 04:15:00'],
    //     ['id' => 2, 'title' => 'second post', 'description' => 'this is a post', 'posted_by' => 'Adel', 'created_at' => '2022-02-15 03:20:00'],
    //     ['id' => 3, 'title' => 'third post', 'description' => 'this is a post', 'posted_by' => 'Bedeer', 'created_at' => '2022-02-14 02:20:00'],
    //     ['id' => 4, 'title' => 'forth post', 'description' => 'this is a post', 'posted_by' => 'Samak', 'created_at' => '2022-02-13 01:20:00']
    // ];

    public function index()
    {
        // if (!session()->exists('posts')) {
        //     session()->put('posts', $this->posts);
        // }
        // return view('posts.index', ['posts' => session()->get('posts')]);
        // $postsFromDB = Post::paginate(3);
        
        $postsFromDB = Post::with('user')->where('user_id', '!=', null)->paginate(3);
        return view('posts.index', ['posts' => $postsFromDB]);
    }

    public function create()
    {
        $users = User::all();

        return view('posts.create', ['users' => $users]);
    }

    public function store(PostRequest $request)
    {
        $requestData = request()->all();
        // dd($requestData);
        // $posts = session()->get('posts');
        // $numOfPosts = count($posts);
        // $post = [
        //     'id' => $numOfPosts + 1,
        //     'title' => $requestData['title'],
        //     'description' => $requestData['desc'],
        //     'posted_by' => $requestData['posted_by'],
        //     'created_at' => now()
        // ];
        // array_push($posts, $post);
        // session()->put('posts', $posts);

        // request()->validate(
        //     [
        //         'title' => ['required', 'min:3'],
        //         'description' => ['required', 'min:10'],
        //     ],
        //     [
        //         'title.required' => "Title Can't Be Empty",
        //         'description.required' => "Description Can't Be Empty",
        //         'description.min' => "Description must Be <= 10 Characters"
        //     ]
        // );

        $newPost = Post::create(
            [
                'title' => $requestData['title'],
                'slug' => SlugService::createSlug(Post::class, 'slug', $requestData['title']),
                'description' => $requestData['description'],
                'user_id' => $requestData['user_id'],
                'created_at' => now()
            ]
        );
        return redirect()->route('posts.index');
    }


    public function show($postID)
    {
        // $posts = session()->get('posts');
        // foreach ($posts as $post) {
        //     if ($post['id'] == $postID) {
        //         $postToShow =  ['id' => $postID, 'title' => $post['title'], 'description' => $post['description'], 'posted_by' => $post['posted_by'], 'created_at' => $post['created_at']];
        //     }
        // }

        // return view('posts.show', [
        //     'postToShow' => $postToShow
        // ]);

        $postToShow = Post::findOrFail($postID);
        return view('posts.show', ['postToShow' => $postToShow]);
    }

    public function edit($postID)
    {
        // $posts = session()->get('posts');
        // foreach ($posts as $post) {
        //     if ($post['id'] == $postID) {
        //         $postToShow =  ['id' => $postID, 'title' => $post['title'], 'description' => $post['description'], 'posted_by' => $post['posted_by'], 'created_at' => $post['created_at']];
        //     }
        // }

        // return view('posts.edit', [
        //     'postToShow' => $postToShow
        // ]);
        $users = User::all();
        $postToShow = Post::findOrFail($postID);
        return view('posts.edit', ['postToShow' => $postToShow, 'users' => $users]);
    }

    public function update($postID, Request $request)
    {
        // $requestData = request()->all();
        // $posts = session()->get('posts');

        // foreach ($posts as $i => $post) {

        //     if ($post['id'] == $postID) {
        //         $posts[$i]['title'] =  $requestData['title'];
        //         $posts[$i]['description'] =  $requestData['desc'];
        //         $posts[$i]['posted_by'] =  $requestData['posted_by'];
        //     }
        // }
        // session()->put('posts', $posts);
        // return redirect()->route('posts.index');
        // request()->validate([
        //     'title' => ['required', 'min:3'],
        //     'description' => ['required', 'min:10'],
        // ]);
        $postToUpdate = Post::findOrFail($postID);
        $postToUpdate->update(
            [
                'title' => $request->title,
                'description' => $request->description,
                'user_id' => $request->user_id,
                'created_at' => now()
            ]
        );

        return redirect()->route('posts.index');
    }

    public function destroy($postID)
    {
        Post::find($postID)->delete();
        return redirect()->route('posts.index');
    }

    public function welcome()
    {
        return view('posts.welcome');
    }
}
