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

                        <a href="{{route('blogs.show',$blog)}}"><img class="card-img-top img-fluid" src="https://bootstrap-ecommerce.com/bootstrap-ecommerce-html/images/items/1.jpg"></a>
                        <div class="card-body">
                            <p class="card-text"><a href="{{route('blogs.show',$blog)}}" class="text-dark">{{$blog->title}}</a></p>
                        <p>{{ $blog->description }}</p>
                        <p>{{ $blog->content }}</p>
                        <p>{{ $blog->author }}</p>
                        <p>{{ $blog->created_at }}</p>

                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>


@endsection
