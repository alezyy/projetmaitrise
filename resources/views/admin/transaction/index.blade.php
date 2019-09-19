@extends('admin.layouts.admin_layout')
@section('content')
    <style type="text/css">
        .table td, .table th {
            font-size: 12px;
            line-height: 2.42857 !important;
        }
    </style>
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <!-- BEGIN PAGE HEADER-->
            <!-- BEGIN PAGE BAR -->
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li> <a href="{{ route('admin.home') }}">Home</a> <i class="fa fa-circle"></i> </li>
                    <li> <span>TRANSACTIONS REPORT</span> </li>
                </ul>
            </div>
            <!-- END PAGE BAR -->
            <!-- BEGIN PAGE TITLE-->
            <h3 class="page-title">Transactions Report<small>  Reporting</small> </h3>
            <!-- END PAGE TITLE-->
            <!-- END PAGE HEADER-->
            <div class="row">
                <div class="col-md-12">
                    <!-- Begin: life time stats -->
                    <div class="portlet light portlet-fit portlet-datatable bordered">
                        <div class="portlet-title">
                            <div class="caption"> <i class="icon-settings font-dark"></i> <span class="caption-subject font-dark sbold uppercase">Reporting Tx</span> </div>
                            <div class="actions">
                                @include('admin.transaction.inc.modal')
                                <a href="" class="btn btn-default btn-rounded mb-4" data-toggle="modal" data-target="#modalLoginForm">Launch
                                    Modal Login Form</a>
                            </div>

                            <div class="actions">
                                <a href="{{ route('export.transactionPdf.companies') }}" class="btn btn-xs btn-succes"><i class="fa fa-download"></i> {{__('Export Report in PDF')}} </a>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div class="table-container">
                                <form method="post" role="form" id="transaction-search-form">
                                    <table class="table table-striped table-bordered table-hover"  id="transaction_datatable_ajax">
                                        <thead>
                                        <tr role="row" class="filter">
                                            <td><input type="text" class="form-control" name="id" id="id" autocomplete="off"></td>
                                            <td><input type="text" class="form-control" name="company_name" id="company_name" autocomplete="off"></td>
                                            <td><input type="text" class="form-control" name="package" id="package" autocomplete="off"></td>
                                            <td><input type="text" class="form-control" name="gateway" id="gateway" autocomplete="off"></td>
                                            <td><input type="text" class="form-control" name="total" id="total" autocomplete="off"></td>
                                            <td><input type="text" class="form-control" name="created_at" id="created_at" autocomplete="off"></td>

                                            <td></td>
                                        </tr>
                                        <tr role="row" class="heading">
                                            <th>Tx Id</th>
                                            <th>Company Name</th>
                                            <th>Package</th>
                                            <th>Payment Mode</th>
                                            <th>Total</th>
                                            <th>Date Tx</th>
                                            <th>Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table></form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END CONTENT BODY -->
    </div>
@endsection
@push('scripts')
    <script>
        $(function () {
            var oTable = $('#transaction_datatable_ajax').DataTable({
                procesing: true,
                serverSide: true,
                stateSave: true,
                searching: false,
                "order": [[0, "desc"]],
                /*
                 paging: true,
                 info: true,
                 */
                ajax: {
                    url: '{!! route('fetch.transaction.companies') !!}',
                    data: function (d) {
                        d.id = $('input[name=id]').val();
                        d.company_name = $('input[name=company_name]').val();
                        d.package = $('input[name=package]').val();
                        d.gateway = $('input[name=gateway]').val();
                        d.total = $('input[name=total]').val();
                        d.created_at = $('input[name=created_at]').val();
                    }
                }, columns: [
                    /*{data: 'id_checkbox', name: 'id_checkbox', orderable: false, searchable: false},*/
                    {data: 'id', name: 'id'},
                    {data: 'company_name', name: 'company_name'},
                    {data: 'package', name: 'package'},
                    {data: 'gateway', name: 'gateway'},
                    {data: 'total', name: 'total'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'action', name: 'action', orderable: false, searchable: false}
                ]
            });
            $('#transaction-search-form').on('submit', function (e) {
                oTable.draw();
                e.preventDefault();
            });
            $('#id').on('keyup', function (e) {
                oTable.draw();
                e.preventDefault();
            });
            $('#company_name').on('keyup', function (e) {
                oTable.draw();
                e.preventDefault();
            });
            $('#package').on('keyup', function (e) {
                oTable.draw();
                e.preventDefault();
            });

            $('#gateway').on('keyup', function (e) {
                oTable.draw();
                e.preventDefault();
            });

            $('#created_at').on('keyup', function (e) {
                oTable.draw();
                e.preventDefault();
            });
        });
        function delete_newsContent(id) {
            if (confirm('Are you sure! you want to delete?')) {
                $.post("{{ route('delete.newsContent') }}", {id: id, _method: 'DELETE', _token: '{{ csrf_token() }}'})
                    .done(function (response) {
                        if (response == 'ok')
                        {
                            var table = $('#transaction_datatable_ajax').DataTable();
                            table.row('transaction_dt_row_' + id).remove().draw(false);
                        } else
                        {
                            alert('Request Failed!');
                        }
                    });
            }
        }
    </script>
@endpush