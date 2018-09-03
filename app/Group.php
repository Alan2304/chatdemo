<?php

namespace App;

use App\User;
use App\chatFile;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
  protected $table = 'group';

    protected $fillable = ['name'];

    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    public function files(){
      return $this->hasMany(chatFile::class);
    }
}
