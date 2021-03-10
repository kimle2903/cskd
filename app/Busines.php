<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Busines extends Model
{
   protected $table = 'business';

   public function typeInvestment(){
      return $this->belongsTo(TypeInvestment::class,'type_investment_id', 'id');
   }

   public function district(){
      return $this->belongsTo(District::class, 'district_id', 'id');
   }

   public function ward(){
      return $this->belongsTo(Ward::class, 'ward_id', 'id');
   }

   public function user(){
      return $this->belongsTo(User::class, 'user_id', 'id');
   }
}
