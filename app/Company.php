<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    protected $date = ['deleted_at'];

    protected $table = "table_companies";
    
    protected $fillable = [
        'name',
        'email',
        'logo',
        'website'
    ];
}
