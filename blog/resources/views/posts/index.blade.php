@extends('layout.app')

@section('title')
Posts
@endsection

@section('content')
<div class="col-md-8 mx-auto my-5">
    <table class="table">
        <thead>
            <tr>
                <th scope="col"></th>
                <th scope="col">Title</th>
                <th scope="col" class="col-md-3">Description</th>
                <th scope="col">Posted By</th>
                <th scope="col">Created At</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($posts as $post)
            <tr>
                <th scope="row">{{$post['id']}}</th>
                <td>{{$post['title']}}</td>
                <td class="col-md-3">{{$post['description']}}</td>
                <!-- <td>{{$post['userID']}}</td> -->
                <!-- @dump($post) -->

                <td>{{$post->user ? $post->user->name : 'User Not Found !' }}</td>
                <td>{{$post['created_at']}}</td>
                <td>
                    <a href="{{route('posts.show', $post['id'])}}" class="btn btn-info">View</a>
                    <a href="{{route('posts.edit', $post['id'])}}" class="btn btn-primary">Edit</a>
                    <form class="d-inline" action="{{ route('posts.destroy', $post['id']) }}" method="post">
                        @csrf
                        @method('delete')
                        <button class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this record ?')" type="submit">
                            Delete
                        </button>
                    </form>

                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="col-md-4 mx-auto my-5">
    {{$posts->links()}}
</div>



@endsection