@extends('layouts.app')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

@section('content')
    <h1> Blogs</h1>

    <form class="form-check-inline" type="get" action="{{route('search')}}">
        <input type="search" name="query" placeholder="Search Blogs">
        <button type="submit">Search</button>
    </form>

    <form method="get" action="{{route('filter')}}">
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
                        <td><a href="{{route('blogs.show',$blog)}}" >read more...</a></td>
                        <td><a href="{{route('blogs.edit',$blog->id)}}" >Edit</a></td>
                        <!-- <td><a href="" >{{Auth::user()}}</a></td> -->
                        
                        @if(Auth::user()->id == $blog->user_id || Auth::user()-> admins =='1')
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
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                @if($countPost >= '5' || Auth::user()->admin =='1')
                <thead>
                <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Content</th>
                    <th>Author</th>
                    <th>Created_at</th>
                    @if(Auth::user()->admin =='1'||$blog->user_id == Auth::user()->id)
                        <th>Status</th>
                    @endif
                </tr>
                </thead>
                @foreach($blogs as $blog)
                    @if($blog->user_id == Auth::user()->id||Auth::user()->admin =='1')
                <tbody>
                <tr>
                    <td>{{$blog->Title}}</td>
                    <td>{{$blog->Description}}</td>
                    <td>{{$blog->Body}}</td>
                    <td>{{$blog->Author}}</td>
                    @if(Auth::user()->admin =='1' ||$blog->user_id == Auth::user()->id)
                    <td>
                        <div class="form-group">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"
                                       {{($blog->status) ? 'checked' : ''}}
                                       onclick="changeBlogStatus(event.target, {{ $blog->id }});">
                                <label class="custom-control-label pointer"></label>
                            </div>
                        </div>
                    </td>
                    @endif
                    </tr>
                </tbody>
                        @endif
                @endforeach
                @endif
            </table>
        </div>
    </div>

    <script>
        function changeBlogStatus(_this, id) {
            let status = $(_this).prop('checked') == true ? 1 : 0;
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
                }
            });
        }

    </script>

@endsection
