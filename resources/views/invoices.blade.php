@extends('layout')
  
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Add Item') }}</div>
  
                <div class="card-body">
                    <div class="form-group">
                        <?php
                        $customers = DB::table('customer')->get();
                        $products = DB::table('product')->get();
                        ?>
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Customer <span class="required">*</span></label>
                        <div class="col-md-6">
                        <select name="name" id="name" placeholder="" class="form-control" required onchange="getCustomer()">
                        <option value="">&nbsp;&nbsp;select</option>
                        @foreach($customers as $customer)
                        <option value="{{ $customer -> name }}">&nbsp;&nbsp;{{ $customer -> name }}</option>
                        @endforeach
                        </select>
                        </div>
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Discount <span class="required">*</span></label>

                        <div class="col-md-6 ">
                            <input id="discount" class="form-control col-md-12 col-xs-12" name="discount" value="" required="required" type="nu">

                        </div>
                        
                    </div>
                    <div class="row mt-3 fieldGroup">
                  
                    <div class="col-12 col-sm-2">
                        <label>Item</label>
                        <select name="item" id="item" placeholder="" class="form-control" required onchange="getPrice()">
                        <option value="">&nbsp;&nbsp;select</option>
                        @foreach($products as $product)
                        <option value="{{ $product -> name }}">&nbsp;&nbsp;{{ $product -> name }}</option>
                        @endforeach
                        </select>                    
                    </div>
                    <div class="col-12 col-sm-3 mt-3 mt-sm-0">
                        <label>Qty</label>
                        <input id="qty" class="form-control col-md-12 col-xs-12" name="qty" value="" required="required" type="number" onchange="total()">
                    </div>
                    <div class="col-12 col-sm-3 mt-3 mt-sm-0">
                        <label>Price</label>
                        <input id="price" class="form-control col-md-12 col-xs-12" name="price" value=""  type="text">
                    </div>
                    <div class="col-12 col-sm-2 mt-3 mt-sm-0">
                        <label>Total</label>
                        <input type="number" step="0.01" id="sub_total" name="sub_total" class="form-control"  value="" readonly > 
                    </div>
                    <!--<div class="col-12 col-sm-2 mt-3 mt-sm-0">
                        <label>Add/Remove</label><br>
                        <a href="javascript:void(0)" class="btn btn-sm btn-outline-danger addMore"> 
                        Add
                        </a>
                    </div>-->
                    
                    </div>
                    <!--<div class="row mt-2">
                        <label class="col-md-3 form-label">{{ __('Total') }}</label>
                        <div class="col-md-4">
                            <input type="number" step="0.01" id="total" name="total" class="form-control"  value="" readonly> 
                        </div>
                    </div>-->
                        

                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
