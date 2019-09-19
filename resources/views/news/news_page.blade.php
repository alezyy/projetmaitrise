@extends('layouts.app')
@section('content')
<!-- Header start -->
@include('includes.header')
<!-- Header end -->
<!-- Inner Page Title start -->
@include('includes.inner_page_title', ['page_title'=>__('News')])
<!-- Inner Page Title end -->
<style type="text/css">
    .bg {
        background-repeat: repeat;
        background-size: cover;
        background-position: center center;
        padding: 126px 70px;
    }

    hr {

        border-top: 1px solid  #e47575;
    }

    .bg-left {
        background-color: {{$newsContent->bg_text}};
    }


    .col-1, .col-2, .col-3, .col-4, .col-5, .col-6, .col-7, .col-8, .col-9, .col-10, .col-11, .col-12, .col, .col-auto, .col-sm-1, .col-sm-2, .col-sm-3, .col-sm-4, .col-sm-5, .col-sm-6, .col-sm-7, .col-sm-8, .col-sm-9, .col-sm-10, .col-sm-11, .col-sm-12, .col-sm, .col-sm-auto, .col-md-1, .col-md-2, .col-md-3, .col-md-4, .col-md-5, .col-md-6, .col-md-7, .col-md-8, .col-md-9, .col-md-10, .col-md-11, .col-md-12, .col-md, .col-md-auto, .col-lg-1, .col-lg-2, .col-lg-3, .col-lg-4, .col-lg-5, .col-lg-6, .col-lg-7, .col-lg-8, .col-lg-9, .col-lg-10, .col-lg-11, .col-lg-12, .col-lg, .col-lg-auto, .col-xl-1, .col-xl-2, .col-xl-3, .col-xl-4, .col-xl-5, .col-xl-6, .col-xl-7, .col-xl-8, .col-xl-9, .col-xl-10, .col-xl-11, .col-xl-12, .col-xl, .col-xl-auto {
        padding-left: 0px;
        padding-right: 0px;
    }

    .about-wraper {
        padding: 50px 0;
    }

</style>
<div class="about-wraper">
    <div class="container">
        <div class="row row-eq-height">
            <div class="col-xs-12 col-md-12">
                <div class="jumbotron">
                    <h3 class="text-center text-info">
                        {{$newsContent->page_title}}
                    </h3>
                </div>
            </div>
        </div>
        <div class="row row-eq-height">
            <div class="col-xs-12 col-md-4">
                <div class="bg bg-left">
                    <ul class="list-inline">
                        <li class="list-inline-item px-0 px-xl-3 d-none d-md-inline-block">
                            <a class="underline text-secondary" href="">
                                Jobs
                            </a>&nbsp;
                        </li>
                        <li class="list-inline-item px-0 px-xl-3">
                            <small>
                                <i class="fa fa-clock"></i>{{$newsContent->created_at}}
                            </small>
                        </li>
                    </ul>
                    <hr id="paxnews">
                    <div class="share-links bold">
                        <div><h6>{{__('SHARE ON')}}</h6></div>
                        <br>
                        <a class="text-secondary d-inline-block px-1 px-lg-2" href="https://www.facebook.com/sharer/sharer.php?u=" target="_blank">
                            <i class="fa fa-facebook-f fa-lg"></i>
                        </a>&nbsp;
                        <a class="text-secondary d-inline-block px-1 px-lg-2" target="_blank" href="https://www.linkedin.com/shareArticle?mini=true&amp;url=&amp;title=">
                            <i class="fa fa-linkedin fa-lg"></i>
                        </a>&nbsp;
                        <a class="text-secondary d-inline-block px-1 px-lg-2" target="_blank" href="http://twitter.com/share?text=Job%20Offer:%20&amp;url=&amp;hashtags=paxtraveljobs,travel,pax,jobs">
                            <i class="fa fa-twitter  fa-lg"></i>
                        </a>&nbsp;
                        <a class="text-secondary d-inline-block px-1 px-lg-2" href="javascript:;" data-toggle="modal" data-target="#modal-share-email">
                            <i class="fa fa-envelope  fa-lg"></i>
                        </a>

                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-md-8">
                <img src="/news_images/{{$newsContent->image_banner}}"  height="400px" width="800px" alt="Smiley face">
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <p>{!! $newsContent->page_content !!}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3"></div>

            <div class="col-md-3"></div>
        </div>
    </div>
</div>
@include('includes.footer')
@endsection





