@extends('layouts.app')
@section('content')
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
 <h1> Create blog</h1>
        <div class="card-body">

            <form action="{{ route('blogs.store') }}" method="post">
            @csrf
                <label>Title</label></br>
                <input type="text" name="title" class="form-control"></br>

                <label>Description</label></br>
                <input type="text"  name="description" class="form-control"></br>

                <label>Body</label></br>
                <input type="text" name="content" class="form-control"></br>
                
                <label>Category</label></br>
                <select name="category" class="form-control">
                    <option value="">Choose topic</option>
                    <option value="Advice">Advice</option>
                    <option value="News">News</option>
                    <option value="Questions">Questions</option>
                </select></br>

                <label>Author</label></br>
                <input type="text" name="author" class="form-control"></br>
                <input type="hidden" name="user_id" value="{{Auth::user()->id}}" class="form-control">                
                <input type="submit" value="Save" class="btn btn-success"></br>
            </form>

        </div>
    </div>

    <button type="button" class="btn btn-sm btn-primary "><a class="text-white" href="{{route('blogs.index')}}"> Terug </a></button>

@endsection 