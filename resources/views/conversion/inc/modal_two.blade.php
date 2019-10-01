@php
$appFolders = array('1' => 'quickpresse');
@endphp

{!! Form::open(array('method' => 'get', 'route' => array('export.transactionPdf.companies'), 'class' => 'form')) !!}
<div class="modal fade" id="modalTwo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h4 class="modal-title w-100 font-weight-bold">{{__('STEP 1 : Choose the App')}}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body mx-3">
                <div class="row">

                    <div class="col-md-4">
                        <div class="formrow"> <span id="default_state_dd"> {!! Form::select('app_id', ['' => __('Select AppFolder')]+$appFolders, null, array('class'=>'form-control', 'id'=>'state_id')) !!} </span></div>
                    </div>

                    <br>
                    <hr>
                    <div class="col-md-12">
                        <div class="formrow">
                            <button type="submit" class="btn">{{__('STEP 3 : continue and analysis')}} <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></button>
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

