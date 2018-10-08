<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sanxuatwallet extends Model
{
   protected $table = 'sanxuatwallet';

   public function nhanviensanxuat()
   {
   	return $this->belongsTo('App\Models\Nhanviensanxuat');
   }

   public function sanpham()
   {
      return $this->belongsTo('App\Models\Sanpham');
   }

   public function nhanvien()
   {
   	return $this->belongsTo('App\Models\Nhanvien');
   }

   public function nguyenlieu()
   {
   	return $this->belongsTo('App\Models\Nguyenlieu');
   }

}
