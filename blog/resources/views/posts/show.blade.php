@extends('layout.app')

@section('title')
Show Post
@endsection

@section('content')
<div class="card col-md-8 mx-auto my-5">
    <div class="card-header">
        Post Info
    </div>
    <div class="card-body">
        <h5 class="card-title"><strong>Title : </strong><span>{{$postToShow->title}}</span></h5>
        <h5 class="card-title"><strong>description : </strong></h5>
        <p>{{$postToShow->description}}</p>
    </div>
</div>

<div class="card col-md-8 mx-auto my-5">
    <div class="card-header">
        Post Creator Info
    </div>
    <div class="card-body">

        <h5 class="card-title"><strong>Name : </strong><span class="fs-5">
                {{ $postToShow->user ? $postToShow->user->name : "UNKNOWN !!" }} </span></h5>
        <h5 class="card-title"><strong>Created At : </strong><span>{{$postToShow->created_at}}</span></h5>
    </div>
</div>
@endsection