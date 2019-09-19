<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link href="maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <!------ Include the above in your HEAD tag ---------->
    <style>

        .text-danger strong {
            color: #9f181c;
        }

        table, th, td {
            border: 1px solid black;
        }

        .receipt-main {
            background: #ffffff none repeat scroll 0 0;
            border-bottom: 12px solid #333333;
            border-top: 12px solid #9f181c;
            margin-top: 50px;
            margin-bottom: 50px;
            padding: 40px 30px !important;
            position: relative;
            box-shadow: 0 1px 21px #acacac;
            color: #333333;
            font-family: open sans;
        }
        .receipt-main p {
            color: #333333;
            font-family: open sans;
            line-height: 1.42857;
        }
        .receipt-footer h1 {
            font-size: 15px;
            font-weight: 400 !important;
            margin: 0 !important;
        }
        .receipt-main::after {
            background: #414143 none repeat scroll 0 0;
            content: "";
            height: 5px;
            left: 0;
            position: absolute;
            right: 0;
            top: -13px;
        }
        .receipt-main thead {
            background: #414143 none repeat scroll 0 0;
        }
        .receipt-main thead th {
            color:#fff;
        }
        .receipt-right h5 {
            font-size: 12px;
            font-weight: bold;
            margin: 0 0 1px 0;
        }
        .receipt-right p {
            font-size: 12px;
            margin: 0px;
        }
        .receipt-right p i {
            text-align: center;
            width: 12px;
        }
        .receipt-main td {
            padding: 9px 20px !important;
        }
        .receipt-main th {
            padding: 13px 20px !important;
        }
        .receipt-main td {
            font-size: 13px;
            font-weight: initial !important;
        }
        .receipt-main td p:last-child {
            margin: 0;
            padding: 0;
        }
        .receipt-main td h2 {
            font-size: 20px;
            font-weight: 900;
            margin: 0;
            text-transform: uppercase;
        }
        .receipt-header-mid .receipt-left h1 {
            font-weight: 100;
            margin: 34px 0 0;
            text-align: right;
            text-transform: uppercase;
        }
        .receipt-header-mid {
            margin: 14px 0;
            overflow: hidden;
        }

        #container {
            background-color: #dcdcdc;
        }

    </style>
</head>

<body>

<div class="container">
    @foreach($transactions as $transaction)
    <div class="row">
        <div class="receipt-main col-xs-10 col-sm-10 col-md-8 col-xs-offset-1 col-sm-offset-1 col-md-offset-3">
            <div class="row">
                <div class="col-md-4">
                    <div class="col-xs-3 col-sm-3 col-md-2">
                        <div class="receipt-left">
                            <img class="img-responsive" alt="iamgurdeeposahan" src="https://jobexplorer.ca/sitesetting_images/thumb/pax-travel-jobs-1565375946-608.png" style="width: 180px; border-radius: 3px;">
                        </div>
                    </div>
                    <div class="col-xs-3 col-sm-3 col-md-2 text-right">
                        <div class="receipt-right">
                            <h5></h5>
                            <p>3131 Boul. St-Martin O. office 140 <i class="fa fa-phone"></i></p>
                            <p>info@paxtraveljobs.com <i class="fa fa-envelope-o"></i></p>
                            <p>Qc, Canada <i class="fa fa-location-arrow"></i></p>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="receipt-header receipt-header-mid">
                    <div class="col-xs-8 col-sm-8 col-md-8 text-left">
                        <div class="receipt-right">
                            <h5>{{$transaction->company_name}}<small></small></h5>
                            <p><b>{{__('Phone')}} :</b> {{ $transaction->phone }}</p>
                            <p><b>{{__('Email')}} :</b> {{ $transaction->email }}</p>
                            <p>
                                <b>{{__('Address')}} :</b>
                                {{ $transaction->location }}, {{ $city }},
                                {{ $state }}, {{ $country }}
                            </p>
                        </div>
                    </div>
                    <div class="col-xs-4 col-sm-4 col-md-4">
                        <div class="receipt-left">
                            <h1>{{__('Receipt')}}</h1>
                            <h4>No.: {{$tx_id}}</h4>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <table style="width:100%">
                    <thead>
                    <tr>
                        <th>{{__('Description')}}</th>
                        <th>{{__('Amount')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td width="70%"> {{__('Payment for package')}} : {{$transaction->package}}</td>
                        <td width="30%"><i class="fa fa-inr"></i> $ {{ $transaction->mount}}</td>
                    </tr>
                    <tr>
                        <td class="text-right">
                            <p>
                                <strong>Total: </strong>
                            </p>
                            <p>
                                <strong>TPS: </strong>
                            </p>
                            <p>
                                <strong>TVQ: </strong>
                            </p>
                        </td>
                        <td>
                            <p>
                                <strong><i class="fa fa-inr"></i>  $ {{ $transaction->mount}}</strong>
                            </p>
                            <p>
                                <strong><i class="fa fa-inr"></i> $ {{ $transaction->tps}}</strong>
                            </p>
                            <p>
                                <strong><i class="fa fa-inr"></i> $ {{ $transaction->tvq}}</strong>
                            </p>

                        </td>
                    </tr>
                    <tr>

                        <td class="text-right"><h2><strong>Total: </strong></h2></td>
                        <td class="text-left text-danger"><h2><strong><i class="fa fa-inr"></i>$ {{ $transaction->total }}</strong></h2></td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="row">
                <div class="receipt-header receipt-header-mid receipt-footer">
                    <div class="col-xs-8 col-sm-8 col-md-8 text-left">
                        <div class="receipt-right">
                            <p><b>Date :</b> {{ $transaction->created_at}}</p>
                            <h5 style="color: rgb(140, 140, 140);">{{__('Thank you for your business!')}}</h5>
                        </div>
                    </div>
                    <div class="col-xs-4 col-sm-4 col-md-4">
                        <div class="receipt-left">
                            <h1>Signature : ______________</h1>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    @endforeach
</div>
</body>
</html>
