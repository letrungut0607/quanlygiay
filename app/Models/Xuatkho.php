<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Xuatkho extends Model
{
   protected $table = 'xuatkho';

   public function phanphoisanpham()
   {
   	return $this->hasMany('App\Models\Phanphoisanpham');
   }

   public function nhaphanphoi()
   {
   	return $this->belongsTo('App\Models\Nhaphanphoi');
   }

   public function lichsucongno()
   {
   	return $this->hasMany('App\Models\Lichsucongno');
   }

}
