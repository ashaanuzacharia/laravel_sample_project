@extends('layout')
  
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Edit Blog') }}</div>
  
                <div class="card-body">
                    <form method="post" action="{{route('blog.update',[$blog->id])}}" autocomplete="on" class="form-horizontal" enctype="multipart/form-data" name="add" id="add">
                    @csrf
                        <input id="user_id" class="form-control col-md-12 col-xs-12" name="user_id" value="{{auth()->user()->id}}" required="required" type="hidden">
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Title <span class="required">*</span></label>
                            <div class="col-md-6">
                                <input id="title" class="form-control col-md-12 col-xs-12" name="title" value="{{$blog->title}}" required="required" type="text" >

                            </div>
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Sub Title <span class="required">*</span></label>

                            <div class="col-md-6 ">
                                <input id="sub_title" class="form-control col-md-12 col-xs-12" name="sub_title" value="{{$blog->sub_title}}" required="required" type="text">

                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="desc">Description*</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <textarea rows="4" name='desc' id='desc' class='form-control' placeholder="Description" required="required" type="text">{{$blog->desc}}</textarea>
                                @if ($errors->has('desc'))
                                    <span class="errormsg">{{ $errors->first('desc') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="desc">Image *</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                @if(!empty($blog->image))
                                <input type="hidden" id="current_image" name="current_image" placeholder="" value="{{ $blog->image }}" class="form-control">
                                <br><br><img src = "{{ asset('/images/blog/'.$blog->image)}}" class="img-fluid" style="width:120px;">
                                <a href="{{ route('blog.imagedelete',$blog->id) }}" class='text-danger'><br>Delete</a>
                                @else
                                <img id="preview" src="#" alt="" class="img-fluid" style="width:320px; height:180px; object-fit: cover;" onerror="this.onerror=null; this.src='{{ asset('images/image_preview.png') }}'" />
                                <br><br><input type="file" id="image" name="image" placeholder="" class="form-control" required>
                                
                                <p class="text-sm text-muted"><small>
                                    Upload ad image.<br>
                                    - Please ensure the image is in the supported formats [JPG, JPEG, PNG].<br>
                                    - The Maximum Upload Size of your Image should be less than 6MB. 
                                </small></p>
                                @endif
                                
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6">

                                <input type="submit" name="submit" value='Update' class='btn btn-success'>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection