@extends('layouts.app')

@section('content')
<div class="container mt-5 mb-5" id="blogPage">
    <div class="row">
        <div class="col-md-7">
            <div class="mb-3">
                <h5>Title: {{$blog->title}}</h5>
            </div>

            <div class="mb-3">
                <h6>Description: </h6>
                <p class="text-muted">{{$blog->description}}</p>
            </div>

            <div class="mb-3">
                <h6>Content: </h6>
                <p>{{$blog->content}}</p>
            </div>

            <div class="mb-3">
                <h6>Author: </h6>
                <p class="description text-muted">{{$blog->author}}</p>
            </div>

            <div class="mb-3">
                <a href="{{ route('blogs.index') }}" class="btn btn-sm btn-primary">Back</a>
            </div>
        </div>
    </div>
</div>
@endsection
