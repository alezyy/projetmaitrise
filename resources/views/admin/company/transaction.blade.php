<?php
$lang = config('default_lang');
$direction = MiscHelper::getLangDirection($lang);
?>
@extends('admin.layouts.admin_layout')

<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
        <!-- BEGIN PAGE BAR -->
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li> <a href="{{ route('admin.home') }}">Home</a> <i class="fa fa-circle"></i> </li>
                <li> <span>Edit Site Setting</span> </li>
            </ul>
        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <!--<h3 class="page-title">Edit User <small>Users</small> </h3>-->
        <!-- END PAGE TITLE-->
        <!-- END PAGE HEADER-->
        <br />
        @include('flash::message')
        <div class="row">
            <div class="col-md-12">
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption font-red-sunglo"> <i class="icon-settings font-red-sunglo"></i> <span class="caption-subject bold uppercase">Transactions Report</span> </div>
                    </div>
                    <div class="portlet-body form">
                        <ul class="nav nav-tabs">
                            <li class="active"> <a href="#site" data-toggle="tab" aria-expanded="false">{{__('All Transactions Reports')}}</a> </li>
                            <li class=""> <a href="#email" data-toggle="tab" aria-expanded="false"> {{__('Transactions Chart')}} </a> </li>
                        </ul>
                        <div class="tab-content">
                            <br>
                            <div class="tab-pane fade active in" id="site">@include('admin.company.report')</div>
                            <div class="tab-pane fade" id="email">{{__('Transactions Chart')}}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
 
@push('scripts')
    @include('admin.shared.tinyMCE')
@endpush