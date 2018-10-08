<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Nhanvien extends Authenticatable
{
	protected $table = 'nhanvien';
	
   use Notifiable;

   protected $fillable = [
      'name', 'email', 'password',
   ];

   protected $hidden = [
      'password', 'remember_token',
   ];
}
