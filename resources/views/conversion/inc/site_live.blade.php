<h5>{{__('Site OctoberCMS in production Live Url')}}</h5>
{!! Form::model($conversion, array('method' => 'put', 'route' => array('update.company.profile'), 'class' => 'form', 'files'=>true)) !!}


<div class="row">
    <div class="col-md-4">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'name') !!}"> {!! Form::text('name', null, array('class'=>'form-control', 'id'=>'name', 'placeholder'=>__('Site Name'))) !!}
            {!! APFrmErrHelp::showErrors($errors, 'name') !!} </div>
    </div>

    <div class="col-md-4">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'url') !!}"> {!! Form::text('url', null, array('class'=>'form-control', 'id'=>'url', 'placeholder'=>__('Site Url'))) !!}
            {!! APFrmErrHelp::showErrors($errors, 'url') !!} </div>
    </div>

    <div class="col-md-12">
        <div class="formrow">
            <button type="submit" class="btn">{{__('Update Site Live URL and Save')}} <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></button>
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
@push('scripts')
    @include('includes.tinyMCEFront')
    <script type="text/javascript">
        $(document).ready(function () {
            $('#country_id').on('change', function (e) {
                e.preventDefault();
                filterLangStates(0);
            });
            $(document).on('change', '#state_id', function (e) {
                e.preventDefault();
                filterLangCities(0);
            });
            filterLangStates(<?php echo old('state_id', (isset($company)) ? $company->state_id : 0); ?>);

            /*******************************/
            var fileInput = document.getElementById("logo");
            fileInput.addEventListener("change", function (e) {
                var files = this.files
                showThumbnail(files)
            }, false)
        });

        function showThumbnail(files) {
            $('#thumbnail').html('');
            for (var i = 0; i < files.length; i++) {
                var file = files[i]
                var imageType = /image.*/
                if (!file.type.match(imageType)) {
                    console.log("Not an Image");
                    continue;
                }
                var reader = new FileReader()
                reader.onload = (function (theFile) {
                    return function (e) {
                        $('#thumbnail').append('<div class="fileattached"><img height="100px" src="' + e.target.result + '" > <div>' + theFile.name + '</div><div class="clearfix"></div></div>');
                    };
                }(file))
                var ret = reader.readAsDataURL(file);
            }
        }


        function filterLangStates(state_id)
        {
            var country_id = $('#country_id').val();
            if (country_id != '') {
                $.post("{{ route('filter.lang.states.dropdown') }}", {country_id: country_id, state_id: state_id, _method: 'POST', _token: '{{ csrf_token() }}'})
                    .done(function (response) {
                        $('#default_state_dd').html(response);
                        filterLangCities(<?php echo old('city_id', (isset($company)) ? $company->city_id : 0); ?>);
                    });
            }
        }
        function filterLangCities(city_id)
        {
            var state_id = $('#state_id').val();
            if (state_id != '') {
                $.post("{{ route('filter.lang.cities.dropdown') }}", {state_id: state_id, city_id: city_id, _method: 'POST', _token: '{{ csrf_token() }}'})
                    .done(function (response) {
                        $('#default_city_dd').html(response);
                    });
            }
        }
    </script>
@endpush