@extends('layouts.task')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{$user}}</div>
                <div class="card-body">
                    <form action="{{url('/save')}}">
                    <textarea placeholder="Please Enter Some Notes" cols="95" name="description"></textarea><br>
                    <input type="file" name="file"/><br><br>
                    <input type="hidden" name="user_id" value="{{ $user_id }}">
                    <a  class="btn btn-info"> Save </a>  
                    </form> 
                </div>
            </div>
        </div>

        <div class="col-md-12">
            
            <table class="table">
                <tr>
                  <th>Notes</th>
                  <th>File</th>
                  <th>Action</th>
                </tr>
                @foreach($records as $value)
                <tr>
                  <td>{{ $value->description }}</td><td>{{ $value->file }}</td><td><a href="#" class="btn btn-info"> Delete </a></td>
                </tr>
                @endforeach
            </table>

        </div>

    </div>
</div>
@endsection
