<?php

use App\Events\MessagePosted;
use App\Message;
use App\Group;
use App\User;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'ChatController@Allgroups')->middleware('auth');

Route::get('/chat/{chat_id}', function($chat_id){
    $group = Group::find($chat_id);
    $users = $group->users;
    $files = $group->files;
    return view('chat', ['group' => $group, 'users' => $users, 'files' => $files] );
})->middleware('auth');

//Devuelve los mensajes de un grupo en especifico
Route::get('/messages/{group_id}', function ($group_id){
    return App\Message::where('group_id', '=', $group_id)->with('user')->get();
})->middleware('auth');

Route::post('/messages/{jsonMessage}', function ($jsonMessage){
    //Store the message
    $user = Auth::user();

    $messageNew = new Message();

    $params = json_decode($jsonMessage);

    $messageNew->message = $params->message;
    $messageNew->group_id = $params->group_id;
    $messageNew->user_id = $user->id;
    $messageNew->save();

    /*
    $message = $user->messages()->create([
      'message' => request()->get('message')
    ]);
    */

    //Announce thah a message has been posted
    broadcast(new MessagePosted($messageNew, $user))->toOthers();

    return ['status' => 'OK'];
    //return App\Message::with('user')->get();
})->middleware('auth');

Route::post('file/{group_id}', 'ChatController@UploadFile');

Route::get('/downloads/{fileName}', function($fileName){
  return Storage::download($fileName);
})->middleware('auth');

Route::get('/createWorkplace', function(){
  $users = User::all();
  return view('createWorkplace', ['users' => $users]);
})->middleware('auth');



Auth::routes();

/*
Route::get('/home' ,function(){
    return view('chat');
})->middleware('auth');
*/
Route::get('/workplaces', 'ChatController@Allgroups')->middleware('auth');
Route::get('/home', 'ChatController@Allgroups')->middleware('auth');

Route::post('/saveWorkplace', 'ChatController@SaveWorkplace');
