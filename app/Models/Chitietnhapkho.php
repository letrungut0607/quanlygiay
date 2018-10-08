<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chitietnhapkho extends Model
{
   protected $table = 'chitietnhapkho';

   public function nhapkho()
   {
   	return $this->belongsTo('App\Models\Nhapkho');
   }

   public function nguyenlieu()
   {
   	return $this->belongsTo('App\Models\Nguyenlieu');
   }
}
