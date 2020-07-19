<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{

    protected $date = ['deleted_at'];
    
    protected $table = "table_employees";

    protected $fillable = [
        'firstname',
        'lastname',
        'company',
        'email',
        'phone'
    ];

    public function employee(){
        return $this->hasMany('App\Employee', 'company', 'id');
    }
}
