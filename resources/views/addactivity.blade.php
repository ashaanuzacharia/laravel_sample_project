@extends('layout')
  
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Add Activity') }}</div>
  
                <div class="card-body">
                <form action="{{route('activity.store')}}" method="post" >
                {{csrf_field()}}
                <input id="user_id" class="form-control col-md-12 col-xs-12" name="user_id" value="{{auth()->user()->id}}" required="required" type="hidden">
                <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Type <span class="required">*</span></label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input id="type" class="form-control col-md-12 col-xs-12" name="type" value="{{auth()->user()->type}}" required="required" type="text" readonly>

                </div>
                </div>

                <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="activity">Activity*</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <textarea rows="2" name='activity' id='activity' class='form-control' placeholder="Enter activity " required="required" type="text"></textarea>
                    @if ($errors->has('activity'))
                        <span class="errormsg">{{ $errors->first('activity') }}</span>
                    @endif
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