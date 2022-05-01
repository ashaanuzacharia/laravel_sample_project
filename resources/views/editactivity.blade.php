@extends('layout')
  
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Add Activity') }}</div>
  
                <div class="card-body">
                    <form action="{{route('activity.update',[$activity->id])}}" method="post" >
                    {{csrf_field()}}

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="activity">activity <span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="activity" class="form-control col-md-12 col-xs-12" name="activity" placeholder="Enter activity" required="required" type="text" value="{{old('activity',$activity->activity)}}">

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