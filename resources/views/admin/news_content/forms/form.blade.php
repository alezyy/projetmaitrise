<?php
$lang = config('default_lang');
if (isset($newsContent))
    $lang = $newsContent->lang;
$lang = MiscHelper::getLang($lang);
$direction = MiscHelper::getLangDirection($lang);
$queryString = MiscHelper::getLangQueryStr();
?>
<div class="row">
    <div class="col-md-6">
        <div class="form-group {!! APFrmErrHelp::hasError($errors, 'logo') !!}">
            <div class="fileinput fileinput-new" data-provides="fileinput">
                <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;"> <img src="{{ asset('/') }}admin_assets/no-image.png" alt="" /> </div>
                <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>
                <div> <span class="btn default btn-file"> <span class="fileinput-new"> Select Main Image </span> <span class="fileinput-exists"> Change </span> {!! Form::file('logo', null, array('id'=>'logo')) !!} </span> <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Remove </a> </div>
            </div>
            {!! APFrmErrHelp::showErrors($errors, 'image') !!} </div>
    </div>
    @if(isset($newsContent))
        <div class="col-md-6">
            {{ ImgUploader::print_image("news_images/$newsContent->image_head") }}
        </div>
    @endif
</div>
{!! APFrmErrHelp::showErrorsNotice($errors) !!}
<div class="form-body">	
    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'lang') !!}">
        {!! Form::label('lang', 'Language', ['class' => 'bold']) !!}                    
        {!! Form::select('lang', ['' => 'Select Language']+$languages, $lang, array('class'=>'form-control', 'id'=>'lang', 'onchange'=>'setLang(this.value)')) !!}
        {!! APFrmErrHelp::showErrors($errors, 'lang') !!}                                       
    </div>
    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'page_id') !!}">
        {!! Form::label('page_id', 'NEWS Page', ['class' => 'bold']) !!}
        {!! Form::select('page_id', ['' => 'Select page']+$newsPages, null, array('class'=>'form-control', 'id'=>'page_id')) !!}
        {!! APFrmErrHelp::showErrors($errors, 'page_id') !!}                                       
    </div>    
    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'page_title') !!}">
        {!! Form::label('page_title', 'Page Title', ['class' => 'bold']) !!}                    
        {!! Form::text('page_title', null, array('class'=>'form-control', 'id'=>'page_title', 'placeholder'=>'Page Title', 'dir'=>$direction)) !!}
        {!! APFrmErrHelp::showErrors($errors, 'page_title') !!}                                       
    </div>    
    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'page_content') !!}">
        {!! Form::label('page_content', 'Page Content', ['class' => 'bold']) !!}                    
        {!! Form::textarea('page_content', null, array('class'=>'form-control', 'id'=>'page_content', 'placeholder'=>'Page Content')) !!}
        {!! APFrmErrHelp::showErrors($errors, 'page_content') !!}                                       
    </div>
    <input type="file" name="image" id="image" style="display:none;" accept="image/*"/>
</div>
@push('scripts')
<script type="text/javascript">
    function setLang(lang) {
        window.location.href = "<?php echo url(Request::url()) . $queryString; ?>" + lang;
    }
</script>
@include('admin.shared.news_form_tinyMCE', array($lang, $direction))
@endpush