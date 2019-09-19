<?php
/**
 * Created by PhpStorm.
 * User: franceneralezy
 * Date: 2019-09-07
 * Time: 7:58 AM
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Company;
use App\Job;

class SitemapController extends Controller
{
    public function index()
    {
        $companies = Company::all()->first();
        $jobs = Job::all()->first();
        return response()->view('sitemap.index', [
            'companies' => $companies,
            'jobs' => $jobs

        ])->header('Content-Type', 'text/xml');
    }

    public function companies()
    {
        $companies = Company::latest()->get();
        return response()->view('sitemap.companies', [
            'companies' => $companies,
        ])->header('Content-Type', 'text/xml');
    }

    public function jobs()
    {
        $jobs = Job::latest()->get();
        return response()->view('sitemap.jobs', [
            'jobs' => $jobs,
        ])->header('Content-Type', 'text/xml');
    }
}
