@extends('layouts.app')

@section('content')
<div id="back-btn">
    <button type="button" class="btn btn-sm btn-primary"><a class="text-white" href="{{route('blogs.index')}}"> Terug </a></button>
    &nbsp;
</div>
<div class="container mt-5 mb-5" id="productPage">
    <div class="row">
        <div class="col-md-5">
            <div class="card">
                <img src="https://bootstrap-ecommerce.com/bootstrap-ecommerce-html/images/items/1.jpg" class="figure-img img-fluid rounded">

            </div>
        </div>

        <div class="col-md-7">
            <h5>{{$blog->title}}</h5>
            <p class="text-muted">{{$blog->description}} </p>

            <h5 class="pt-4">{{$blog->content}}</h5>
            <p class="description text-muted">{{$blog->author}}</p>
        </div>

    </div>
</div>


@endsection
