<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{

    protected $table = 'news';
    public $timestamps = true;
    protected $guarded = ['id'];
    //protected $dateFormat = 'U';
    protected $dates = ['created_at', 'updated_at'];

    public function newsPages()
    {
        return $this->hasMany('App\NewsPages', 'page_id', 'id')
                        ->orderBy('lang', 'ASC');
    }
    
}
