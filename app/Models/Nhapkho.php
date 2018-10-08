<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nhapkho extends Model
{
   protected $table = 'nhapkho';

   public function chitietnhapkho()
   {
   	return $this->hasMany('App\Models\Chitietnhapkho');
   }

   public function nhanvien()
   {
   	return $this->belongsTo('App\Models\Nhanvien');
   }

}
