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

            <form action="{{ route('blogs.update',$blogs) }}" method="post">
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
            <div id="return-btn">
            </br>
                <button type="button" class="btn btn-sm btn-primary "><a class="text-white" href="{{route('blogs.index')}}"> Terug </a></button>
                &nbsp;
            </div>


        </div>
    </div>
@stop
