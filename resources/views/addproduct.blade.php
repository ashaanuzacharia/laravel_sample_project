@extends('layout')
  
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Add Item') }}</div>
  
                <div class="card-body">
                
                    <form method="post" action="{{route('product.store')}}" autocomplete="on" class="form-horizontal" enctype="multipart/form-data" name="add" id="add">
                    @csrf
                        <div class="form-group">
                            
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Item <span class="required">*</span></label>
                            <div class="col-md-6">
                                <input id="name" class="form-control col-md-12 col-xs-12" name="name" value="" required="required" type="text" >

                            </div>
                            
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Price <span class="required">*</span></label>

                            <div class="col-md-6 ">
                                <input id="price" class="form-control col-md-12 col-xs-12" name="price" value="" required="required" type="number">

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
    
@endpush