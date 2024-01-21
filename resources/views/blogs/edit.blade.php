@extends('layouts.app')
@section('content')
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card">
        <div class="card-header">Edit product</div>
        <div class="card-body">

            @auth
                @if(Auth::user()->id == $blogs->user_id || Auth::user()->admins == '1')
                    <form action="{{ route('blogs.update', $blogs) }}" method="post">
                        @csrf
                        @method("PATCH")
                        <input type="hidden" name="id" value="{{$blogs->id}}" id="id" />
                        <label>Title</label></br>
                        <input type="text" name="title" value="{{$blogs->title}}" class="form-control"></br>

                        <label>Description</label></br>
                        <input type="text" name="description" value="{{$blogs->description}}" class="form-control"></br>
                        
                        <label>Content</label></br>
                        <input type="text" name="content" value="{{$blogs->content}}" class="form-control"></br>
                        
                        <label>Author</label></br>
                        <input type="text" name="author" value="{{$blogs->author}}" class="form-control"></br>

                        <input type="submit" value="Update" class="btn btn-success"></br>
                    </form>
                @else
                    <p>You are not authorized to edit this blog.</p>
                @endif
            @endauth

            <div id="return-btn">
            </br>
                <button type="button" class="btn btn-sm btn-primary "><a class="text-black" href="{{ route('blogs.index') }}"> Go back </a></button>
                &nbsp;
            </div>
        </div>
    </div>
@stop
