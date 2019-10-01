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

use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

use Illuminate\Support\Facades\Artisan as Artisan;

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

    /**
     * Start the conversion automation process
     */
    public function startConversion()
    {
        $this->removeDirectory();
        $this->copyLaravelVirginVersion();
        $this->copyOctoberCMSAPP();
        //$this->createMainController();
        //$this->addTextInsideMainController();

    }

    public function copyOctoberCMSAPP()
    {

        $october_app = '/var/www/quickpresse-com/plugins/logimonde/quickpresse';
        $destination_app = '/home/conversion/quickpresse/';
        $projectName = 'quickpresse';

        $script = "cp -r {$october_app} {$destination_app }";

        $process = new Process($script);
        $process->run();

        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        $consoleDisplay =  $process->getOutput();
        return view('conversion.console')->with('consoleDisplay', $consoleDisplay);


    }


    /**
     * Copy a virin Laravel version to /home/conversion folder
     * @return $this
     */
    function copyLaravelVirginVersion(){

        $laravel_Framework_path = '/var/www/laravel';
        $laravel_destination_path = '/home/conversion';
        $projectName = 'quickpresse';

        $script = "cp -r {$laravel_Framework_path} {$laravel_destination_path}/{$projectName}";

        $process = new Process($script);
        $process->run();

        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        $consoleDisplay =  $process->getOutput();
        return view('conversion.console')->with('consoleDisplay', $consoleDisplay);
    }


    public function createMainController()
    {

        //$script = "touch /home/conversion/quickpresse/app/Http/Controllers/QuickpresseController.php";

        /*$script = "php artisan cache:clear";

        $process = new Process($script);
        $process->run();

        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        $consoleDisplay =  $process->getOutput();
        return view('conversion.console')->with('consoleDisplay', $consoleDisplay);*/


        //echo shell_exec("sudo php /var/www/projetmaitrise/artisan cache:clear");



        //Artisan::call('make:controller', ['name' => 'fooController', '--path' => '/home/conversion']);

        return 'Application cache cleared';

    }


    public function addTextInsideMainController()
    {
        $script =
        "cat >> /home/conversion/quickpresse/app/Http/Controllers/QuickpresseController.php << EOF
        > text line 1
        > text line 2
        > text line 3
        > EOF";

        $process = new Process($script);
        $process->run();

        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        return  $process->getOutput();

    }

    function removeDirectory(){

        $script = "rm -rf /home/conversion/quickpresse";

        $process = new Process($script);
        $process->run();

        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        $consoleDisplay =  $process->getOutput();
        return view('conversion.console')->with('consoleDisplay', $consoleDisplay);
    }

}
