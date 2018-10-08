<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lichsuruttien extends Model
{
   protected $table = 'lichsuruttien';

   public function tienvon()
   {
   	return $this->belongsTo('App\Models\Tienvon');
   }

   public static function tongtien_darut()
   {
   	return Lichsuruttien::sum('sotien');
   }

}
