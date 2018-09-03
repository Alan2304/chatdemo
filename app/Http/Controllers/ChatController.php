<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Group;
use App\User;
use App\chatFile;

class ChatController extends Controller
{
    public function Allgroups(){
      $user = \Auth::user();
      $groups = $user->groups;
      return view('workplaces', ['groups' => $groups]);
    }

    public function SaveWorkplace(Request $request){
      $workplaceName = $request->input('name');
      $users = $request->input('users');

      //Create the record on the database
      $newWorkplace = new Group();
      $newWorkplace->name = $workplaceName;
      $newWorkplace->save();

      $idNewWorkplace = $newWorkplace->id;

      foreach ($users as $key => $user_id) {
        DB::table('group_user')->insert(
          ['user_id' => $user_id, 'group_id' => $idNewWorkplace]
        );
      }
      return redirect('createWorkplace')->with('status', 'OK');
    }



    public function UploadFile(Request $request, $group_id){
      $file = $request->file('file');
      $name = $request->input('name');
      //Save the path of the image in the Database
      $newFile = new chatFile();
      $newFile->name = $name;

      $fileName = time().$file->getClientOriginalName();
      $newFile->path = $fileName;
      $newFile->group_id = $group_id;
      $newFile->save();
      //save the file in the server
      \Storage::disk('local')->put($fileName, \File::get($file));
      
      return redirect('/chat/' . $group_id)->with('status', 'OK');
    }
}
