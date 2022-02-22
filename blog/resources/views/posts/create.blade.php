@extends('layouts.app')

@section('title')
Create Post
@endsection

@section('content')
<form method="POST" action="{{route('posts.store')}}" class="col-md-6 mx-auto my-5">
    @csrf
    <!-- <h1>Create Post</h1> -->

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <div class="mb-3">
        <label class="form-label">Title</label>
        <input name="title" type="text" class="form-control">
    </div>
    <!-- <div class="mb-3">
        <label class="form-label">Slug</label>
        <input name="title" type="text" class="form-control">
    </div> -->
    <div class="mb-3">
        <label class="form-label">Description</label>
        <textarea name="description" class="form-control"></textarea>
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

    <button type="submit" class="btn btn-success">Add</button>
</form>
@endsection