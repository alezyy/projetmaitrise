<?php

namespace App\Http\Controllers;

use Auth;
use App\Http\Requests;
use Illuminate\Http\Request;
use Validator;
use URL;
use Session;
use Redirect;
use Input;
use Config;
use App\Package;
use App\User;
use Carbon\Carbon;
use Cake\Chronos\Chronos;
use App\Traits\CompanyPackageTrait;
use App\Traits\JobSeekerPackageTrait;
use App\Traits\TransactionTrait;
use App\Traits\JobTrait;

/** All Stripe Details class * */
use Stripe\Stripe;
use Stripe\Charge;

class StripeOrderController extends Controller
{

    use CompanyPackageTrait;
    use JobSeekerPackageTrait;
    use TransactionTrait;
    use JobTrait;

    private $redirectTo = 'home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        /*         * ****************************************** */
        $this->middleware(function ($request, $next) {
            if (Auth::guard('company')->check()) {
                $this->redirectTo = 'company.home';
            }
            return $next($request);
        });
        /*         * ****************************************** */
    }

    public function stripeOrderForm($package_id, $new_or_upgrade)
    {
        $package = Package::findOrFail($package_id);
        return view('order.pay_with_stripe')
                        ->with('package', $package)
                        ->with('package_id', $package_id)
                        ->with('new_or_upgrade', $new_or_upgrade);
    }

    public function stripeOrderPremiumForm($package_id, $new_or_upgrade, $jobId)
    {
        $package = Package::findOrFail($package_id);

        return view('order.premium_pay_with_stripe')
            ->with('package', $package)
            ->with('package_id', $package_id)
            ->with('new_or_upgrade', $new_or_upgrade)
            ->with('jobId', $jobId);
    }

    /**
     * Store a details of payment with paypal.
     *
     * @param IlluminateHttpRequest $request
     * @return IlluminateHttpResponse
     */
    public function stripeOrderPackage(Request $request)
    {
        $package = Package::findOrFail($request->package_id);
        $gateway = 'Stripe';
        $order_amount = number_format($package->package_price + $package->package_price * env('TPS') + $package->package_price * env('TVQ'), 2,'.', '');

        /*         * ************************ */
        $buyer_id = '';
        $buyer_name = '';
        if (Auth::guard('company')->check()) {
            $buyer_id = Auth::guard('company')->user()->id;
            $buyer_name = Auth::guard('company')->user()->name . '(' . Auth::guard('company')->user()->email . ')';
        }
        if (Auth::check()) {
            $buyer_id = Auth::user()->id;
            $buyer_name = Auth::user()->getName() . '(' . Auth::user()->email . ')';
        }
        $package_for = ($package->package_for == 'employer') ? __('Employer') : __('Job Seeker');
        $description = $package_for . ' ' . $buyer_name . ' - ' . $buyer_id . ' ' . __('Package') . ':' . $package->package_title;
        /*         * ************************ */
        Stripe::setApiKey(Config::get('stripe.stripe_secret'));
        try {
            $charge = Charge::create(array(
                        "amount" => $order_amount * 100,
                        "currency" => "CAD",
                        "source" => $request->input('stripeToken'), // obtained with Stripe.js
                        "description" => $description
            ));
            if ($charge['status'] == 'succeeded') {
                /**
                 * Write Here Your Database insert logic.
                 */
                if (Auth::guard('company')->check()) {
                    $company = Auth::guard('company')->user();
                    $this->addCompanyPackage($company, $package);
                    $this->addTransaction($company, $package, $gateway);

                }
                if (Auth::check()) {
                    $user = Auth::user();
                    $this->addJobSeekerPackage($user, $package);
                }

                flash(__('You have successfully subscribed to selected package'))->success();
                return Redirect::route($this->redirectTo);
            } else {
                flash(__('Package subscription failed'));
                return Redirect::route($this->redirectTo);
            }
        } catch (Exception $e) {
            flash($e->getMessage());
            return Redirect::route($this->redirectTo);
        }
    }

    public function StripeOrderUpgradePackage(Request $request)
    {

        $gateway = 'Stripe';
        $package = Package::findOrFail($request->package_id);
        $order_amount = $package->package_price + $package->package_price * env('TPS') + $package->package_price * env('TVQ');

        /*         * ************************ */
        $buyer_id = '';
        $buyer_name = '';
        if (Auth::guard('company')->check()) {
            $buyer_id = Auth::guard('company')->user()->id;
            $buyer_name = Auth::guard('company')->user()->name . '(' . Auth::guard('company')->user()->email . ')';
        }
        if (Auth::check()) {
            $buyer_id = Auth::user()->id;
            $buyer_name = Auth::user()->getName() . '(' . Auth::user()->email . ')';
        }
        /*         * ************************* */

        $package_for = ($package->package_for == 'employer') ? __('Employer') : __('Job Seeker');
        $description = $package_for . ' ' . $buyer_name . ' - ' . $buyer_id . ' ' . __('Upgrade Package') . ':' . $package->package_title;
        /*         * ************************ */
        Stripe::setApiKey(Config::get('stripe.stripe_secret'));
        try {
            $charge = Charge::create(array(
                        "amount" => $order_amount * 100,
                        "currency" => "CAD",
                        "source" => $request->input('stripeToken'), // obtained with Stripe.js
                        "description" => $description
            ));
            if ($charge['status'] == 'succeeded') {
                /**
                 * Write Here Your Database insert logic.
                 */
                if (Auth::guard('company')->check()) {
                    $company = Auth::guard('company')->user();
                    $this->updateCompanyPackage($company, $package);
                    $this->addTransaction($company, $package, $gateway);
                }
                if (Auth::check()) {
                    $user = Auth::user();
                    $this->updateJobSeekerPackage($user, $package);
                }

                flash(__('You have successfully subscribed to selected package'))->success();
                return Redirect::route($this->redirectTo);
            } else {
                flash(__('Package subscription failed'));
                return Redirect::route($this->redirectTo);
            }
        } catch (Exception $e) {
            flash($e->getMessage());
            return Redirect::route($this->redirectTo);
        }
    }


    /**
     * Store a details of payment with paypal.
     *
     * @param IlluminateHttpRequest $request
     * @return IlluminateHttpResponse
     */
    public function stripeOrderPremiumPackage(Request $request)
    {
        $package = Package::findOrFail($request->package_id);
        $jobId = $request->job_id;
        $gateway = 'Stripe';
        $order_amount = number_format($package->package_price + $package->package_price * env('TPS') + $package->package_price * env('TVQ'), 2);

        /*         * ************************ */
        $buyer_id = '';
        $buyer_name = '';
        if (Auth::guard('company')->check()) {
            $buyer_id = Auth::guard('company')->user()->id;
            $buyer_name = Auth::guard('company')->user()->name . '(' . Auth::guard('company')->user()->email . ')';
        }
        if (Auth::check()) {
            $buyer_id = Auth::user()->id;
            $buyer_name = Auth::user()->getName() . '(' . Auth::user()->email . ')';
        }
        $package_for = ($package->package_for == 'employer') ? __('Employer') : __('Job Seeker');
        $description = $package_for . ' ' . $buyer_name . ' - ' . $buyer_id . ' ' . __('Package') . ':' . $package->package_title;
        /*         * ************************ */
        Stripe::setApiKey(Config::get('stripe.stripe_secret'));
        try {
            $charge = Charge::create(array(
                "amount" => $order_amount * 100,
                "currency" => "CAD",
                "source" => $request->input('stripeToken'), // obtained with Stripe.js
                "description" => $description
            ));
            if ($charge['status'] == 'succeeded') {
                /**
                 * Write Here Your Database insert logic.
                 */
                if (Auth::guard('company')->check()) {
                    $company = Auth::guard('company')->user();
                    $this->addCompanyPackage($company, $package);
                    $this->addTransaction($company, $package, $gateway);
                    $this->premiumFrontJob($jobId);
                }
                if (Auth::check()) {
                    $user = Auth::user();
                    $this->addJobSeekerPackage($user, $package);
                }

                flash(__('You have successfully subscribed to selected package'))->success();
                return Redirect::route('edit.front.job', array($jobId));
            } else {
                flash(__('Package subscription failed'));
                return Redirect::route('edit.front.job', array($jobId));
            }
        } catch (Exception $e) {
            flash($e->getMessage());
            return Redirect::route('edit.front.job', array($jobId));
        }
    }

}
