@extends('layout')
  
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Add Blog') }}</div>
  
                <div class="card-body">
                
                    <form method="post" action="{{route('blog.store')}}" autocomplete="on" class="form-horizontal" enctype="multipart/form-data" name="add" id="add">
                    @csrf
                        <input id="user_id" class="form-control col-md-12 col-xs-12" name="user_id" value="{{auth()->user()->id}}" required="required" type="hidden">
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Title <span class="required">*</span></label>
                            <div class="col-md-6">
                                <input id="title" class="form-control col-md-12 col-xs-12" name="title" value="" required="required" type="text" >

                            </div>
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Sub Title <span class="required">*</span></label>

                            <div class="col-md-6 ">
                                <input id="sub_title" class="form-control col-md-12 col-xs-12" name="sub_title" value="" required="required" type="text">

                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="desc">Description*</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <textarea rows="4" name='desc' id='desc' class='form-control' placeholder="Description" required="required" type="text"></textarea>
                                @if ($errors->has('desc'))
                                    <span class="errormsg">{{ $errors->first('desc') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="desc">Image *</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <img id="preview" src="#" alt="your image" class="img-fluid" style="width:320px; height:180px; object-fit: cover;" onerror="this.onerror=null; this.src='{{ asset('images/default-image.png') }}'"/>
                                <br><br>
                                <input type="file" class="form-control" name="image" @error('image') is-invalid @enderror id="selectImage">
                                
                                <p class="text-sm text-muted"><small>
                                    Upload ad image.<br>
                                    - Please ensure the image is in the supported formats [JPG, JPEG, PNG].<br>
                                    - The Maximum Upload Size of your Image should be less than 6MB. 
                                </small></p>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6">

                                <input type="submit" name="submit" value='Submit' class='btn btn-success'>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
    <script>
        selectImage.onchange = evt => {
            preview = document.getElementById('preview');
            preview.style.display = 'block';
            const [file] = selectImage.files
            if (file) {
                preview.src = URL.createObjectURL(file)
            }
        }
    </script>
@endpush