@extends('layouts.app')

@section('title')
Welcome To ITI Blog
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 mx-auto d-flex justify-content-center my-5">
            <a class="btn btn-info mx-2 text-light fw-bold shadow-sm" href="{{route('posts.create')}}">Create Post</a>
            <a class="btn btn-info mx-2 text-light fw-bold shadow-sm" href="{{route('posts.index')}}">All Posts</a>
        </div>
    </div>
</div>
@endsection