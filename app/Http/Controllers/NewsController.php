<?php


namespace App\Http\Controllers;

use Mail;
use Hash;
use File;
use ImgUploader;
use Auth;
use Validator;
use DB;
use Input;
use Redirect;
use App\Subscription;
use Newsletter;
use App\User;
use App\Company;
use App\FavouriteCompany;
use App\FavouriteApplicant;
use App\OwnershipType;
use App\JobApply;
use Carbon\Carbon;
use App\Helpers\MiscHelper;
use App\Helpers\DataArrayHelper;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Requests\Front\CompanyFrontFormRequest;
use App\Http\Controllers\Controller;
use App\Traits\CompanyTrait;
use App\Traits\Cron;
use App\News;
use App\NewsContent;

class NewsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function index()
    {
        return view('news_home');
    }

    public function news_listing()
    {
        $data['news'] = \DB::table('news')
            ->join('news_content', 'news.id', '=', 'news_content.page_id')
            ->where('news_content.lang', '=', app()->getLocale())
            ->select('news_content.*', 'news.page_slug')
            ->orderBy('id', 'DESC')
            ->paginate(16);

        return view('news.listing')->with($data);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function getPage($slug)
    {
        $news = News::where('page_slug', 'like', $slug)->first();
        if (null === $newsContent = NewsContent::getContentByPageId($news->id)) {
            echo 'No Content';
            exit;
        }

        $seo = (object) array(
            'seo_title' => $news->seo_title,
            'seo_description' => $news->seo_description,
            'seo_keywords' => $news->seo_keywords,
            'seo_other' => $news->seo_other
        );

        return view('news.news_page')
            ->with('newsContent', $newsContent)
            ->with('seo', $seo);
    }

    public function printNewsImage($width = 0, $height = 0)
    {
        $logo = (string) $this->image_head;
        $logo = (!empty($logo)) ? $logo : 'no-no-image.gif';
        return \ImgUploader::print_image("news_images/$logo", $width, $height, '/admin_assets/no-image.png', $this->page_title);
    }

}
