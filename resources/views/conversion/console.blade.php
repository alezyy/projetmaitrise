@extends('layouts.app')
@section('content')
    <!-- Header start -->
    @include('includes.header')
    <!-- Header end -->
    <!-- Inner Page Title start -->
    @include('includes.inner_page_title', ['page_title'=>__('Console Operation')])
    <!-- Inner Page Title end -->
    <div class="listpgWraper">
        <div class="container">
            <div class="row">
                @include('includes.company_dashboard_menu')

                <div class="col-md-9 col-sm-8">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="userccount" style="background-color: black; height: 400px"  >
                                <div class="formpanel"> @include('flash::message')
                                <!-- Personal Information -->
                                    <p>Wait please be patient While,</p>
                                    <p>The system analyze the origin platform!</p>
                                    <p>Some Questions will be display after ..............</p>
                                    <p> Take a cup of coffee while ...........................................</p>

                                     {{ $consoleDisplay }}

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('includes.footer')
@endsection
@push('styles')
    <style type="text/css">
        .userccount p{ text-align:left !important;}
    </style>
@endpush