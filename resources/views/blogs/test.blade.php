@extends('layouts.app')

@section('content')
    <h1> Blogs</h1>

    <form class="form-check-inline" method="get" action="{{ route('search') }}">
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
                    <th>Action</th>
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
                        <td>
                            <a href="{{ route('blogs.show', $blog) }}">Read more</a>
                            <a href="{{ route('blogs.edit', $blog->id) }}">Edit</a>
                            @if(Auth::user()->id == $blog->id || Auth::user()->admins =='1')
                                <form class="btn btn-sm" action="{{ route('blogs.destroy', $blog->id) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-sm btn-primary">Delete</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Display the Conditional Table for Blogs -->
    @if($countPost >= 5 || Auth::user()->admin =='1')
        <h1> Conditional Blogs</h1>
        <div class="table-responsive">
            <table class="table table-bordered" id="conditionalBlogTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Content</th>
                        <th>Author</th>
                        <th>Created</th>
                        @if(Auth::user()->admin =='1' || $product->user_id == Auth::user()->id)
                            <th>Status</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach($blogs as $blog)
                        @if(Auth::user()->id == $blog->id || Auth::user()->admins =='1')
                            <tr>
                                <td>{{ $blog->title }}</td>
                                <td>{{ $blog->description }}</td>
                                <td>{{ $blog->content }}</td>
                                <td>{{ $blog->author }}</td>
                                <td>{{ $blog->created_at }}</td>
                                @if(Auth::user()->admin =='1' || $product->user_id == Auth::user()->id)
                                    <td>
                                        <div class="form-group">
                                            <div class="custom-control custom-switch">
                                                <!-- Adjusted checkbox logic assuming 'status' is a field in the blogs table -->
                                                <input type="checkbox" class="custom-control-input"
                                                    {{ ($blog->status) ? 'checked' : '' }}
                                                    onclick="changeBlogStatus(event.target, {{ $blog->id }});">
                                                <label class="custom-control-label pointer"></label>
                                            </div>
                                        </div>
                                    </td>
                                @endif
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
@endsection
