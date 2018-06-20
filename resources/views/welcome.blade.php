@extends('layouts.task')

@section('content')
    <div class="main main-list">
        <div class="main-row">

            @if(Session::has('success'))
                <p>{{ Session::get('success') }}</p>
            @endif 

            <div class="login-form">
                <h2> List of Users </h2>
            </div>

                    @if(Auth::check())
                      <!-- Table -->
                      <table class="table">
                          <tr>
                              <th>Name</th>
                              <th>Email</th>
                              <th>Action</th>
                          </tr>
                          @foreach($users as $value)
                            <tr>
                              <td>{{ $value->name }}</td><td>{{ $value->email }}</td><td><a href="{{ url('profile/' . $value->name) }}" class="btn btn-info"> Upload</a>  </td>
                            </tr>
                          @endforeach
                      </table>
                    @endif
            </div>
            @if(Auth::guest())
              <a href="/login" class="btn btn-info"> You need to login to see the list 😜😜 </a>
            @endif
        </div>
    </div>
</div>
@endsection