<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sanpham extends Model
{
   protected $table = 'sanpham';

   public function loaisanpham()
   {
   	return $this->belongsTo('App\Models\Loaisanpham');
   }
}
