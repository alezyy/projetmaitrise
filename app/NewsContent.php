<?php

namespace App;

use App;
use App\News;
use App\Traits\Lang;
use App\Traits\Active;
use Illuminate\Database\Eloquent\Model;

class NewsContent extends Model
{

    use Lang;
    use Active;

    protected $table = 'news_content';
    public $timestamps = true;
    protected $guarded = ['id'];
    //protected $dateFormat = 'U';
    protected $dates = ['created_at', 'updated_at'];

    public function page()
    {
        return $this->belongsTo('App\News', 'page_id', 'id');
    }

    public static function getContentByPageId($id)
    {
        $newsContent = self::where('page_id', '=', $id)->where('lang', 'like', \App::getLocale())->first();
        if (null === $newsContent) {
            $newsContent = self::where('page_id', '=', $id)->first();
        }

        return $newsContent;
    }

    public static function getContentBySlug($slug)
    {
        $news = News::where('page_slug', 'like', $slug)->first();
        $newsContent = self::where('page_id', '=', $news->id)->where('lang', 'like', \App::getLocale())->first();
        if (null === $newsContent) {
            $newsContent = self::where('page_id', '=', $news->id)->first();
        }

        return $newsContent;
    }

}
