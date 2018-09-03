@extends('layouts.app')

@section('content')
    <div class="container">
      <div class="row">
          <div class="col-md-8 ">
              <div class="card">
                <div class="card-body">
                  <div id="app">
                    <div class="card-header">
                      <h1 class="card-title">{{$group->name}} <span class="badge badge-primary float-right">@{{ usersInRoom.length }}</span></h1>
                      <h5>

                        @foreach($users as $user)
                          Usuarios: {{$user->name}} ,
                        @endforeach

                      </h5>
                    </div>
                    <chat-log :messages="messages"></chat-log>
                    <chat-composer v-on:messagesent="addMessage"></chat-composer>
                    <input type="hidden" id="group_id" name="group_id" value="{{$group->id}}">
                  </div>
                </div>
              </div>
          </div>
          <div class="col-md-4">
            @if(session('status'))
            <div class="alert alert-success" role="alert">
                The file was Uploaded successfully!
            </div>
            @endif
            <h3>Uploaded Files</h3>
            <div class="row">
                @foreach($files as $file)
                <div class="col-md-6">
                    <a href="http://127.0.0.1:8000/downloads/{{$file->path}}">{{$file->name}}</a>
                </div>
                <div class="col-md-6">
                  <a href="http://127.0.0.1:8000/downloads/{{$file->path}}" class="btn btn-secondary"><i class="fas fa-download"></i></a>
                </div>
                <br>
                <br>
                @endforeach
            </div>
            <h5>Upload a File</h5>
            <form accept-charset="UTF-8" enctype="multipart/form-data" action="http://127.0.0.1:8000/file/{{$group->id}}" method="post">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <div class="form-group">
                <label class="col-md-6 control-label">Nombre del Archivo</label>
                <div class="col-md-6">
                    <input type="text" name="name" class="form-control">
                </div>
              <div class="form-group">
                <label class="col-md-4 control-label">Archivo</label>
                <div class="col-md-6">
                    <input type="file" name="file">
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                    <input type="submit" value="Enviar" class="btn btn-primary">
                </div>
              </div>
            </form>
          </div>
      </div>
    </div>
@endsection
