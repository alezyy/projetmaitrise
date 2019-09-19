<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanyTransaction extends Model
{

    protected $table = 'transactions';
    public $timestamps = true;
    protected $guarded = ['id'];
    //protected $dateFormat = 'U';
    protected $dates = ['created_at', 'updated_at'];

}
