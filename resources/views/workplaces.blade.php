@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row">
    <div class="col-md-12">
        <h1>My Work Centers</h1>
    </div>
@foreach($groups as $group)
      <div class="col-md-8">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title"><a href="http://127.0.0.1:8000/chat/{{$group->id}}"> {{$group->name}} </a></h5>
            <p class="card-text">Integrantes:<br>
              @foreach($group->users as $member)
                {{$member->name}} ,
              @endforeach
            </p>
          </div>
          <a href="http://127.0.0.1:8000/chat/{{$group->id}}" class="btn btn-primary">Go to Workplace</a>
        </div>
      </div>


@endforeach
  </div>
</div>

@endsection
