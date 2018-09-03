@extends('layouts.app')

@section('content')

<div class="container">

  @if(session('status'))
  <div class="alert alert-success" role="alert">
      The Workplace was created successfully!
  </div>
  @endif

    <h1>Create Workplace</h1>
    <form action="http://127.0.0.1:8000/saveWorkplace" method="post">
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
      <div class="form-group col-md-8">
        <label for="name">Name:</label>
        <input type="text" name="name" class="form-control">
      </div>
      <div class="form-group col-md-8">
        <h5>Users List</h5>
          @foreach($users as $user)
            <input type="checkbox" name="users[]" value="{{$user->id}}"> {{$user->name}} <br>
          @endforeach
      </div>
      <div class="form-group">
        <input type="submit" name="send" value="Create" class="btn btn-primary">
      </div>
    </form>
</div>

@endsection
