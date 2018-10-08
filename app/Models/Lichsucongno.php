<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lichsucongno extends Model
{
   protected $table = 'lichsucongno';

   public function xuatkho()
   {
   	return $this->belongsTo('App\Models\Xuatkho');
   }

}
