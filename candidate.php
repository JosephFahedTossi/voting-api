<?php

namespace App;
use App\vote;
use Illuminate\Database\Eloquent\Model;

class candidate extends Model
{
    public function VoteId(){
        return $this -> hasMany('App\vote');
    }
}
