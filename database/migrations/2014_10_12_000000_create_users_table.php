<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\User;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('type')->default('normal');
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
          $newUser = new User();
          $newUser->name = 'admin';
          $newUser->email = 'admin@gmail.com';
          $newUser->password = Hash::make('admin');
          $newUser->type = 'admin';
          $newUser->save();

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
