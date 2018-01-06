<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class vote extends Model
{
    public function CandidateId() {
        return $this -> hasOne('App\candidate');
    }
}
