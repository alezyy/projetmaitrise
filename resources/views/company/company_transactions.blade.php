@extends('layouts.app')
@section('content') 
<!-- Header start --> 
@include('includes.header') 
<!-- Header end --> 
<!-- Inner Page Title start --> 
@include('includes.inner_page_title', ['page_title'=>__('Company Transactions')])
<!-- Inner Page Title end -->
<div class="listpgWraper">
    <div class="container">
        <div class="row">
            @include('includes.company_dashboard_menu')
            <div class="col-md-9 col-sm-8">
                <h3>{{__('Company Transactions')}}</h3>
                <br>
                <br>
                    <!--<div class="searchform">
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <div class="col-sm-3 control-label">
                                        <label for="startdate" class="control-label">StartDate</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <div class="input-group date" id="startdate">
                                            <input type="text" class="form-control" />
                                            <span class="input-group-addon">
                                    <span class="glyphicon-calendar glyphicon">
                                    </span>
                                    </span>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <div class="col-sm-3 control-label">
                                        <label for="enddate">EndDate</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <div class="input-group date" id="enddate">
                                            <input type="text" class="form-control" />
                                            <span class="input-group-addon">
                                    <span class="glyphicon-calendar glyphicon"></span>
                                </span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-1">
                                <button type="submit" class="btn"><i class="fa fa-search" aria-hidden="true"></i></button>
                            </div>
                        </div>
                    </div>-->
                <br>
                <br>
                 <ul class="searchList">
                    @foreach($transactions as $transaction)
                    <li id="job_li_{{$transaction->id}}">
                        <div class="row">
                            <div class="col-md-8 col-sm-8">
                                <div class="jobimg"></div>
                                <div class="jobinfo">
                                    <h3><a>{{__('Package : ')}}</a> {{$transaction->package}}</h3>
                                    <br>
                                    <div class="companyName"><h4><a>{{__('Mount Total : ')}}</a>{{__('$')}}{{$transaction->mount}}</h4></div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="col-md-4 col-sm-4">
                                <div class="listbtn"><a href="{{route('company.receipt', [$transaction->id])}}">{{__('Receipt')}}</a></div>
                            </div>
                        </div>
                        <p>{{__('No Transaction  : ')}}{{($transaction->id)}}</p>
                        <p>{{__('Date Transaction  : ')}}{{($transaction->created_at)}}</p>
                    </li>
                    @endforeach
                </ul>
                <div class="pagiWrap">
                    {{ $transactions->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@include('includes.footer')
@endsection

