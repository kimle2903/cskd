<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Violate extends Model
{
    protected $table = 'violates';

    public function user(){
        return $this->belongsTo(User::class, 'user_decision_id');
    }
    public function user1(){
        return $this->belongsTo(User::class, 'user_handler_id');
    }

    public function errorViolate(){
        return $this->belongsTo(ErrorViolate::class, 'error_violate_id');
    }

    public function formViolate(){
        return $this->belongsTo(FormViolate::class, 'form_violate_id');
    }

    public function typeInvestment(){
        return $this->belongsTo(TypeInvestment::class, 'type_investment_id');
    }

    public function processLevel(){
        return $this->belongsTo(ProcessingLevel::class, 'process_level_id');
    }
    public function busines(){
        return $this->belongsTo(Busines::class,'busines_id');
    }
}
