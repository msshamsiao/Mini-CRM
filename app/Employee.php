<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use SoftDeletes;
    
    protected $dates = ['deleted_at'];
    
    protected $table = "table_employees";

    protected $fillable = [
        'firstname',
        'lastname',
        'company',
        'email',
        'phone'
    ];

    public function companies(){
        return $this->belongsTo('App\Company', 'company');
    }
}
