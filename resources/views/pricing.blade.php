@extends('layouts.app')
@push('styles')
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
@endpush
@section('content')
    <!-- Header start -->
    @include('includes.header')
    <!-- Header end -->
    <!-- Inner Page Title start -->
    @include('includes.inner_page_title', ['page_title'=>__('Pricing')])
    <!-- Inner Page Title end -->

    <br/><br/><br/>

    <!-- Plans -->
    <section id="plans">
        <div class="container">
            <div class="row">

                <!-- item -->
                <div class="col-md-4 text-center">
                    <div class="panel panel-danger panel-pricing">
                        <div class="panel-heading">
                            <i class="fa fa-binoculars"></i>
                            <h3>{{__('BRONZE')}}</h3>
                            <br>
                            <h4>{{__('1 Job Posting')}}</h4>
                        </div>
                        <div class="panel-body text-center">
                            <p style="color: #a12484"><strong>$145</strong></p>
                            <br>
                            <p><strong><h5>{{__('PACKAGE INCLUDES')}}</h5></strong></p>
                        </div>

                        <ul class="list-group text-center">
                            <li class="list-group-item"><i class="fa fa-check"></i>{{__('Company logo')}}  </li>
                            <li class="list-group-item"><i class="fa fa-check"></i>{{__('Company profile page with 3 pictures')}}  </li>
                            <li class="list-group-item"><i class="fa fa-check"></i>{{__('No deadline for usage')}}  </li>
                            <li class="list-group-item"><i class="fa fa-check"></i>{{__('Receive applications through your job')}}  </li>
                            <li class="list-group-item"><i class="fa fa-check"></i>{{__('posting on Job Explorer')}}  </li>
                            <li class="list-group-item"><i class="fa fa-check"></i>{{__('4 weeks of visibility')}}  </li>
                        </ul>
                        <div class="panel-footer">
                            <a class="btn btn-lg btn-block btn-danger" href="{{route('login')}}">{{__('SELECT THIS PLAN!')}}</a>
                        </div>
                    </div>
                </div>
                <!-- /item -->

                <!-- item -->
                <div class="col-md-4 text-center">
                    <div class="panel panel-warning panel-pricing">
                        <div class="panel-heading">
                            <i class="fa fa-plane"></i>
                            <h3>{{__('PREMIUM')}} </h3>
                            <br>
                            <h4> {{__('3 Job Postings')}} </h4>
                        </div>
                        <div class="panel-body text-center">
                            <p style="color: #a12484"><strong>$350</strong></p>
                            <br>
                            <p><strong><h5>{{__('PACKAGE INCLUDES')}}</h5></strong></p>
                        </div>
                        <ul class="list-group text-center">
                            <li class="list-group-item"><i class="fa fa-check"></i>{{__('Company logo')}}  </li>
                            <li class="list-group-item"><i class="fa fa-check"></i>{{__('Company profile page with 3 pictures')}}  </li>
                            <li class="list-group-item"><i class="fa fa-check"></i>{{__('No deadline for usage')}}  </li>
                            <li class="list-group-item"><i class="fa fa-check"></i>{{__('Receive applications through your job')}}  </li>
                            <li class="list-group-item"><i class="fa fa-check"></i>{{__('posting on Job Explorer')}}  </li>
                            <li class="list-group-item"><i class="fa fa-check"></i>{{__('4 weeks of visibility')}}  </li>
                        </ul>
                        <div class="panel-footer">
                            <a class="btn btn-lg btn-block btn-warning" href="#">{{__('SELECT THIS PLAN!')}}</a>
                        </div>
                    </div>
                </div>
                <!-- /item -->

                <!-- item -->
                <div class="col-md-4 text-center">
                    <div class="panel panel-success panel-pricing">
                        <div class="panel-heading">
                            <i class="fa fa-rocket"></i>
                            <h3>{{__('PLATINUM')}} </h3>
                            <br>
                            <h4>{{__('7 Job Postings')}} </h4>
                        </div>
                        <div class="panel-body text-center">
                            <p style="color: #a12484"><strong>$700</strong></p>
                            <br>
                            <p><strong><h5>{{__('PACKAGE INCLUDES')}}</h5></strong></p>
                        </div>
                        <ul class="list-group text-center">
                            <li class="list-group-item"><i class="fa fa-check"></i>{{__('Company logo')}}  </li>
                            <li class="list-group-item"><i class="fa fa-check"></i>{{__('Company profile page with 3 pictures')}}  </li>
                            <li class="list-group-item"><i class="fa fa-check"></i>{{__('No deadline for usage')}}  </li>
                            <li class="list-group-item"><i class="fa fa-check"></i>{{__('Receive applications through your job')}}  </li>
                            <li class="list-group-item"><i class="fa fa-check"></i>{{__('posting on Job Explorer')}}  </li>
                            <li class="list-group-item"><i class="fa fa-check"></i>{{__('4 weeks of visibility')}}  </li>
                        </ul>
                        <div class="panel-footer">
                            <a class="btn btn-lg btn-block btn-success" href="#">{{__('SELECT THIS PLAN!')}}</a>
                        </div>
                    </div>
                </div>
                <!-- /item -->

            </div>
        </div>
    </section>
    <!-- /Plans -->


    @include('includes.footer')
@endsection



