<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\District;

class Ward extends Model
{
    protected $table = 'wards';

    public function district(){
        return $this->belongsTo(District::class, 'district_id', 'id');
    }
}
