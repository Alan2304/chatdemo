<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Group;

class chatFile extends Model
{
  protected $table = 'files';

  public function group(){
    return $this->belongsTo(Group::class);
  }


}
