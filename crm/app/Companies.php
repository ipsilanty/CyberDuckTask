<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Companies extends Model
{
    /**
     * Establish relationship between company and employees(One to many)
     */
    public function employees()
    {
        return $this->hasMany('App\Employees','company','id');
    }
}
