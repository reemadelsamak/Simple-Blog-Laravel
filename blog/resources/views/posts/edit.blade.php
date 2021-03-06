@extends('layouts.app')

@section('title')
Create Post
@endsection

@section('content')
<form method="POST" action="{{route('posts.update', $postToShow['id'])}}" class="mt-5 col-md-6 mx-auto">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label class="form-label">Title</label>
        <input name="title" type="text" class="form-control" value="{{$postToShow->title}}">
    </div>
    <div class=" mb-3">
        <label class="form-label">Description</label>
        <textarea name="description" class="form-control">{{$postToShow->description}}</textarea>
    </div>
    <div class="mb-3">
        <label class="form-label">Posted By</label>

        <select name="user_id" class="form-control">

            <option class="text-center"> -- select creator -- </option>

            @foreach ($users as $user)
            <option value="{{ $user->id }}">{{ $user->name }}</option>
            @endforeach

        </select>

    </div>

    <button type="submit" class="btn btn-primary">Update</button>
</form>

@endsection