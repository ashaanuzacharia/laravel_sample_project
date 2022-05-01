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
                    Here is the list of Activities
                    <br><br>
                    @foreach ($activity as $activity_all) 
                        <tbody>
                        <tr>
                            <td>{{ $activity_all->activity }}</td><br>
                        </tr>
                        </tbody>
                    @endforeach
                    <hr style="width:50%;text-align:left;margin-left:0">
                    <a  href="{{route('activity.create')}}">Add More Activity</a>
                    <hr style="width:50%;text-align:left;margin-left:0">
                    @foreach($tasks as $task)
                        <h6>{{ $task->activity}}</h6>
                        <p>
                            <a href="{{ route('activity.edit',[$task->id]) }}" class="btn btn-primary">Edit Activity</a>
                            @if((auth()->user()->role =='admin'))
                            <a  onclick="return confirm('Are you sure?')" id="del" href="{{ route('activity.delete',$task->id) }}" class="btn btn-danger">Delete Activity</a>
                            @endif
                        </p>
                        <hr>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection