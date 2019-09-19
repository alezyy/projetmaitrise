{!! Form::open(array('method' => 'get', 'route' => array('export.transactionPdf.companies'), 'class' => 'form')) !!}
<div class="modal fade" id="modalLoginForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h4 class="modal-title w-100 font-weight-bold">{{__('Enter Date Range')}}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body mx-3">
                <div class="row">
                    <div class="col-md-6">
                        <div class="formrow">
                            {!! Form::text('begin_date', null, array('class'=>'form-control datepicker', 'id'=>'begin_date', 'placeholder'=>__('Begin date YYYY-MM-DD'), 'autocomplete'=>'off')) !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="formrow">
                            {!! Form::text('end_date', null, array('class'=>'form-control datepicker', 'id'=>'end_date', 'placeholder'=>__('End date YYY-MM-DD'), 'autocomplete'=>'off')) !!}
                        </div>
                    </div>
                    <br>
                    <hr>
                    <div class="col-md-12">
                        <div class="formrow">
                            <button type="submit" class="btn">{{__('Submit to Export Report in PDF')}} <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<input type="file" name="image" id="image" style="display:none;" accept="image/*"/>
{!! Form::close() !!}
<hr>
@push('styles')
    <style type="text/css">
        .datepicker>div {
            display: block;
        }
    </style>
@endpush

