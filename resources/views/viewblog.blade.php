@extends('layout')
  
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    {{ __('Blog') }}
                </div>
  
                <div class="card-body">
                    @if(!empty($blog->image))
                    <img src = "{{ asset('/images/blog/'.$blog->image)}}" class="img-fluid" style="width:120px;">
                    @endif
                    <h3>{{$blog->title}}</h3>
                    <p>{{$blog->desc}}</P>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection