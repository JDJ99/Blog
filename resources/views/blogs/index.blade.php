@extends('layouts.app')

@section('content')
    <h1> Blogs</h1>

    <form class="form-check-inline" type="get" action="{{route('search')}}">
        <input type="search" name="query" placeholder="Search Blogs">
        <button type="submit">Search</button>
    </form>

    <a href="{{ route('blogs.create') }}">Create blog</a>
    
    <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Content</th>
                    <th>Author</th>
                    <th>Created</th>
                </tr>
            </thead>
            <tbody>
                @foreach($blogs as $blog)
                    <tr>
                        <td>{{ $blog->title }}</td>
                        <td>{{ $blog->description }}</td>
                        <td>{{ $blog->content }}</td>
                        <td>{{ $blog->author }}</td>
                        <td>{{ $blog->created_at }}</td>
                        <td><a href="{{route('blogs.show',$blog)}}" >read mor   e...</a></td>
                        <td><a href="{{route('blogs.edit',$blog->id)}}" >Edit</a></td>
                        <!-- <td><a href="" >{{Auth::user()}}</a></td> -->
                        
                        @if(Auth::user()->id == $blog->id || Auth::user()-> admins =='1')
                        <td><form class="btn btn-sm" action="{{route('blogs.destroy', $blog->id)}}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-sm btn-primary">Delete</button>
                                    </form></td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
