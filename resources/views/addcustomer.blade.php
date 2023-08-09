@extends('layout')
  
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Add Customer') }}</div>
  
                <div class="card-body">
                
                    <form method="post" action="{{route('customer.store')}}" autocomplete="on" class="form-horizontal" enctype="multipart/form-data" name="add" id="add">
                    @csrf
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Customer <span class="required">*</span></label>
                            <div class="col-md-6">
                                <input id="name" class="form-control col-md-12 col-xs-12" name="name" value="" required="required" type="text" >

                            </div>
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Discount <span class="required">*</span></label>

                            <div class="col-md-6 ">
                                <input id="discount" class="form-control col-md-12 col-xs-12" name="discount" value="" required="required" type="number">

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