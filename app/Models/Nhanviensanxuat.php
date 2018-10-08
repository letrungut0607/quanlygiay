<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nhanviensanxuat extends Model
{
   protected $table = 'nhanviensanxuat';

   public function nhanvien()
   {
   	return $this->belongsTo('App\Models\Nhanvien');
   }

   public function sanpham()
   {
   	return $this->belongsTo('App\Models\Sanpham');
   }
}
