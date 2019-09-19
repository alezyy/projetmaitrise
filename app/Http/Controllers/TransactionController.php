<?php

namespace App\Http\Controllers;

use App\Http\Requests\Front\JobFrontFormRequest;
use Barryvdh\DomPDF\Facade as PDF;
use Hash;
use File;
use ImgUploader;
use Auth;
use DB;
use Input;
use Redirect;
use App\Package;
use App\Transaction;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use DataTables;
use App\Http\Requests\TransactionFormRequest;
use App\Http\Controllers\Controller;


class TransactionController extends Controller
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

    public function indexTransactions()
    {
        return view('admin.transaction.index');
    }

    public function companyTransactionPdf($id)
    {
        $data['transactions'] = \DB::table('transactions')
            ->where('id', '=', $id)
            ->get()->first();

        $pdf = PDF::loadView('company.receipt', $data); //load view page
        return $pdf->download('receipt.pdf'); // download pdf file
    }

    public function accountingPdfExport(Request $request)
    {
        $transactions = \DB::table('transactions')
            ->whereBetween('created_at', [$request->begin_date, $request->end_date])
            ->get();

        $data['begin_date'] = $request->begin_date;
        $data['end_date'] = $request->end_date;

        $total = 0;
        $tps = 0;
        $tvq = 0;
        $grandTotal = 0;

        foreach ($transactions as $transaction) {
            $total += $transaction->mount;
            $tps += $transaction->tps;
            $tvq += $transaction->tvq;
            $grandTotal += $transaction->total;
        }

        $data['mount'] = $total;
        $data['tps'] = $tps;
        $data['tvq'] = $tvq;
        $data['grandTotal'] = $grandTotal;

        $pdf = PDF::loadView('admin.transaction.list', $data); //load view page
        return $pdf->download('transactionList.pdf'); // download pdf file
    }

    public function fetchTransactionsData(Request $request)
    {
        $transactionContent = Transaction::select([

            'transactions.id',
            'transactions.company_name',
            'transactions.package',
            'transactions.gateway',
            'transactions.total',
            'transactions.created_at',
        ]);

        return Datatables::of($transactionContent)
            ->filter(function ($query) use ($request) {
                if ($request->has('id') && !empty($request->id)) {
                    $query->where('transactions.id', 'like', "{$request->get('id')}");
                }
                if ($request->has('company_name') && !empty($request->company_name)) {
                    $query->where('transactions.company_name', 'like', "%{$request->get('company_name')}%");
                }
                if ($request->has('package') && !empty($request->package)) {
                    $query->where('transactions.package', 'like', "%{$request->get('package')}%");
                }

                if ($request->has('gateway') && !empty($request->gateway)) {
                    $query->where('transactions.gateway', 'like', "%{$request->get('gateway')}%");
                }

                if ($request->has('created_at') && !empty($request->created_at)) {
                    $query->where('transactions.created_at', 'like', "%{$request->get('created_at')}%");
                }
            })
            ->addColumn('company_name', function ($transactionContent) {
                $company_name = str_limit($transactionContent->company_name, 100, '...');
                return '<span>' . $company_name . '</span>';
            })
            ->addColumn('package', function ($transactionContent) {
                $package = str_limit($transactionContent->package, 100, '...');
                return '<span>' . $package . '</span>';
            })

            ->addColumn('gateway', function ($transactionContent) {
                $gateway = str_limit($transactionContent->gateway, 100, '...');
                return '<span>' . $gateway . '</span>';
            })

            ->addColumn('created_at', function ($transactionContent) {
                return '<span>' . $transactionContent->created_at->format('Y-m-d') . '</span>';

            })

            ->addColumn('page_content', function ($transactionContent) {
                $page_content = str_limit($transactionContent->company_name, 100, '...');
                return '<span>' . $page_content . '</span>';
            })

            ->addColumn('action', function ($transactionContent) {
                /*                             * ************************* */
                return '
				<div class="btn-group">
					<button class="btn blue dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Action
						<i class="fa fa-angle-down"></i>
					</button>
					<ul class="dropdown-menu">
						<li>
							<a href="' . route('view.transaction.companies', ['id' => $transactionContent->id]) . '"><i class="fa fa-pencil" aria-hidden="true"></i>View</a>
						</li>																																													
					</ul>
				</div>';
            })
            ->rawColumns(['company_name', 'package', 'gateway', 'created_at', 'page_content', 'action'])
            ->setRowId(function($transactionContent) {
                return 'transaction_dt_row_' . $transactionContent->id;
            })
            ->make(true);
    }
}
