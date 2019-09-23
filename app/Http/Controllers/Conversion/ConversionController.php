<?php

namespace App\Http\Controllers\Conversion;

use App\Conversion;
use App\Package;
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
use App\Http\Controllers\Controller;
use App\Traits\CompanyTrait;
use App\Traits\Cron;
use Barryvdh\DomPDF\Facade as PDF;

class ConversionController extends Controller
{
    use CompanyTrait;
    use Cron;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('company', ['except' => ['companyDetail', 'sendContactForm']]);
    }

    public function index()
    {
        return view('company_home');
    }

    public function conversionSiteLive()
    {
        $conversion = Conversion::query()
;        return view('conversion.edit_site_live')
            ->with('conversion', $conversion);
    }

    public function serverParameter()
    {
        $conversion = Conversion::query()
        ;        return view('conversion.edit_server_dev')
        ->with('conversion', $conversion);
    }

    public function createDirectory()
    {

    }

    public function modalDevOne()
    {
        return view('conversion.modal_one');
    }

}
