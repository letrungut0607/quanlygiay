<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tienvon extends Model
{
   protected $table = 'tienvon';

   public function lichsuruttien()
   {
   	return $this->hasMany('App\Models\Lichsuruttien');
   }

   public static function tongso_tienvon()
   {
   	return Tienvon::sum('sotien');
   }

}
