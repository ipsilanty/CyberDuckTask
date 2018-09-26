<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employees extends Model
{
    /**
     * Establish relationship between employee and his company(One To Many (Inverse))
     */
    public function companies()
    {
        return $this->belongsTo('App\Companies', 'company','id');
    }
}
