@extends('layouts.app')

@section('content')
    <button type="button" class="btn btn-sm btn-primary"><a class="text-white" href="{{route('products.index')}}"> Go back </a></button>
    </br>
    </br>
    <form class="form-check-inline" type="get" action="{{route('search')}}">
        <input type="search" name="query" placeholder="Search Products">
        <button type="submit">Search</button>
    </form>
    <div class="container cardItem" id="products">
        <br>
        <div class="row">
            @foreach($products as $product)

                <div class="col-md-3 style">
                    <div class="card">

                        <a href="{{route('products.show',$product)}}"><img class="card-img-top img-fluid" src="https://bootstrap-ecommerce.com/bootstrap-ecommerce-html/images/items/1.jpg"></a>
                        <div class="card-body">
                            <p class="card-text"><a href="{{route('products.show',$product)}}" class="text-dark">{{$product->name}}</a></p>

                            <p class="card-cost">€ {{$product->price}}</p>
                            <p class="card-category">{{$product->category}}</p>

                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>


@endsection
