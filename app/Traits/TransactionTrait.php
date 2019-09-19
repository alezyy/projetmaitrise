<?php

namespace App\Traits;

use App\News;
use DB;
use Carbon\Carbon;
use App\Transaction;

trait TransactionTrait
{

    public function addTransaction($company, $package, $gateway)
    {
        $now = Carbon::now();

        $transaction = new Transaction();
        $transaction->user_id = 1;
        $transaction->company_id = $company->id;
        $transaction->company_name = $company->name;
        $transaction->package = $package->package_title;
        $transaction->mount = $package->package_price;
        $transaction->tps = number_format(env('TPS') * $package->package_price, 3);
        $transaction->tvq = number_format(env('TVQ') * $package->package_price, 3);
        $transaction->total = number_format($transaction->mount + $transaction->tps + $transaction->tvq, 3, '.', '');
        $transaction->gateway = $gateway;
        $transaction->description = 'NA';
        $transaction->save();
    }

}

