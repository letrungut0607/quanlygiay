<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Phanphoisanpham extends Model
{
   protected $table = 'phanphoisanpham';

   public function xuatkho()
   {
   	return $this->belongsTo('App\Models\Xuatkho');
   }

   public function sanpham()
   {
   	return $this->belongsTo('App\Models\Sanpham');
   }
}
