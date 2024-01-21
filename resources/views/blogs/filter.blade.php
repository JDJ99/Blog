@extends('layouts.app')

@section('content')
    
    
    <form class="form-check-inline" type="get" action="{{route('search')}}">
        <input type="search" name="query" placeholder="Search Title">
        <button type="submit">Search</button>
    </form>
    <div class="container cardItem" id="blogs">
        <br>
        <div class="row">
            @foreach($blogs as $blog)
                @if($blog->status == 1 || Auth::user()->id == $blog->user_id || Auth::user()->admins == '1')
                    <div class="col-md-3 style">
                        <div class="card">
                            <a href="{{route('blogs.show',$blog)}}"></a>
                            <div class="card-body">
                                <p class="card-text"><a href="{{route('blogs.show',$blog)}}" class="text-dark">{{$blog->Title}}</a></p>

                                <p class="author">{{$blog->author}}</p>
                                <p class="description"> {{$blog->description}}</p>
                                <p class="content">{{$blog->content}}</p>
                                <p class="category">{{$blog->category}}</p>
                                <br>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
        <br>
        <button type="button" class="btn btn-sm btn-primary"><a class="text-black" href="{{route('blogs.index')}}"> Go back </a></button>
    </div>
@endsection
