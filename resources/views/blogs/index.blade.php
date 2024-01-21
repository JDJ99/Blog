@extends('layouts.app')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

@section('content')
    <h1>Blogs</h1>

    <form class="form-check-inline" type="get" action="{{ route('search') }}">
        <input type="search" name="query" placeholder="Search Title">
        <button type="submit">Search</button>
    </form>

    <form method="get" action="{{ route('filter') }}">
        <select name="filter">
            <option value="Advice">Advice</option>
            <option value="News">News</option>
            <option value="Questions">Questions</option>
        </select>
        <button type="submit" class="btn btn-primary">Filter</button>
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
                    <th>Category</th>
                    <th>Created</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($blogs as $blog)
                    <tr>
                        <td>{{ $blog->title }}</td>
                        <td>{{ $blog->description }}</td>
                        <td>{{ $blog->content }}</td>
                        <td>{{ $blog->author }}</td>
                        <td>{{ $blog->category }}</td>
                        <td>{{ $blog->created_at }}</td>
                        <td>
                            <a href="{{ route('blogs.show', $blog) }}">Read more...</a>
                            @auth
                                @if(Auth::user()->id == $blog->user_id || Auth::user()->admins == '1')
                                    <a href="{{ route('blogs.edit', $blog->id) }}">Edit</a>
                                    <form class="btn btn-sm" action="{{ route('blogs.destroy', $blog->id) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-sm btn-primary">Delete</button>
                                    </form>
                                    <label class="switch">
                                        <input type="checkbox" class="blog-status" data-blog-id="{{ $blog->id }}" {{ $blog->status ? 'checked' : '' }}>
                                        <span class="slider"></span>
                                    </label>
                                @endif
                            @endauth
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script>
        $(document).ready(function() {
            function changeBlogStatus(_this, id) {
                let status = $(_this).prop('checked') ? 1 : 0;
                let _token = $('meta[name="csrf-token"]').attr('content');

                $.ajax({
                    url: `{{route('changeStatus')}}`,
                    type: 'post',
                    datatype: 'json',
                    data: {
                        '_token': _token,
                        'id': id,
                        'status': status
                    },
                    success: function (result) {
                        console.log(result);
                    },
                    error: function (error) {
                        console.error(error);
                    }
                });
            }

            // Attach changeBlogStatus to all checkboxes with the 'blog-status' class
            $(document).on('change', '.blog-status', function() {
                let id = $(this).data('blog-id');
                changeBlogStatus(this, id);
            });
        });
    </script>
@endsection