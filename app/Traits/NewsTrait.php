<?php

namespace App\Traits;

use DB;
use File;
use ImgUploader;
use App\News;
use App\NewsContent;

trait NewsTrait
{

    private function deleteNewsContentLogo($id)
    {
        try {
            $company = NewsContent::findOrFail($id);
            $image = $company->logo;
            if (!empty($image)) {
                File::delete(ImgUploader::real_public_path() . 'company_logos/thumb/' . $image);
                File::delete(ImgUploader::real_public_path() . 'company_logos/mid/' . $image);
                File::delete(ImgUploader::real_public_path() . 'company_logos/' . $image);
            }
            return 'ok';
        } catch (ModelNotFoundException $e) {
            return 'notok';
        }
    }

    private function getSEO($news)
    {
       //
    }

}
