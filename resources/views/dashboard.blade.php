@extends('layout')
  
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
  
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if(Session::has('message'))
                    <div class="alert {{ Session::get('alert-class') }}">
                        {{ Session::get('message') }}
                    </div>
                    @endif
                    <div class="row">
                        <div class="col-lg-12 margin-tb">
                            <div class="pull-left">
                                <h2>News & Articles</h2>
                            </div>
                            <div class="pull-right mb-2">
                                <a class="btn btn-success" href="{{ route('blog.create') }}"> Create Blog</a>
                            </div>
                        </div>
                    </div>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Blog Title</th>
                                <th>Blog SubTitle</th>
                                <th>Blog Description</th>
                                <th width="280px">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($blogs as $blog)
                                <tr>
                                    <td>{{ $blog->id }}</td>
                                    <td>{{ $blog->title }}</td>
                                    <td>{{ $blog->sub_title }}</td>
                                    <td>{{ $blog->desc }}</td>
                                    <td>
                                        <a class="btn btn-success" href="{{ route('blog.view',$blog->id) }}">View</a>

                                        <a class="btn btn-primary" href="{{ route('blog.edit',$blog->id) }}">Edit</a>
                                        <a class="btn btn-danger" href="{{ route('blog.delete',$blog->id) }}">Delete</a>

                                    </td>
                                </tr>
                                @endforeach
                        </tbody>
                    </table>
                    {!! $blogs->links() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection