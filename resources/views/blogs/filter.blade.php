@extends('layouts.app')

@section('content')
    <button type="button" class="btn btn-sm btn-primary"><a class="text-white" href="{{route('blogs.index')}}"> Go back </a></button>
    </br>
    </br>
    <form class="form-check-inline" type="get" action="{{route('search')}}">
        <input type="search" name="query" placeholder="Search Blogs">
        <button type="submit">Search</button>
    </form>
    <div class="container cardItem" id="blogs">
        <br>
        <div class="row">
            @foreach($blogs as $blog)

                <div class="col-md-3 style">
                    <div class="card">

                        <a href="{{route('blogs.show',$blog)}}"></a>
                        <div class="card-body">
                            <p class="card-text"><a href="{{route('blogs.show',$blog)}}" class="text-dark">{{$blog->Title}}</a></p>

                            <p class="author">{{$blog->author}}</p>
                            <p class="description"> {{$blog->description}}</p>
                            <p class="content">{{$blog->content}}</p>
                            <p class="category">{{$blog->category}}</p><br> 
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>


@endsection
