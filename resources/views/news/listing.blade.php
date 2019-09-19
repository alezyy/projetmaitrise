@extends('layouts.app')
@section('content') 
<!-- Header start --> 
@include('includes.header') 
<!-- Header end --> 
<!-- Inner Page Title start --> 
@include('includes.inner_page_title', ['page_title'=>__('NEWS')])
<!-- Inner Page Title end -->
<div class="listpgWraper">
<div class="container">
    <ul class="row compnaieslist">
        @if($news)
        @foreach($news as $oneNews)
        <li class="col-md-3 col-sm-6">
            <div class="compint">
            <div class="imgwrap">
                <a href="{{ route('news', $oneNews->page_slug) }}">
                    <img src="/news_images/{{$oneNews->image_head}}" data-toggle="tooltip"  data-placement="bottom" title="{{ $oneNews->page_title }}" alt="paxtravel">
                </a>
            </div>
                <h3><a href="{{ route('news', $oneNews->page_slug) }}">{{str_limit(strip_tags($oneNews->page_title), 35, '..')}}</a></h3>
            <div class="curentopen"><i class="fa fa-clock-o" aria-hidden="true"></i>{{$oneNews->created_at}}</div>
            </div>
        </li>
        @endforeach
        @endif

    </ul>
    <div class="pagiWrap">
        {{ $news->links() }}
    </div>
</div>
</div>

@include('includes.footer')
@endsection
@push('styles')
<style type="text/css">
    .formrow iframe {
        height: 78px;
    }
</style>
@endpush
@push('scripts') 
<script type="text/javascript">
    $(document).ready(function () {
        $(document).on('click', '#send_company_message', function () {
            var postData = $('#send-company-message-form').serialize();
            $.ajax({
                type: 'POST',
                url: "{{ route('contact.company.message.send') }}",
                data: postData,
                //dataType: 'json',
                success: function (data)
                {
                    response = JSON.parse(data);
                    var res = response.success;
                    if (res == 'success')
                    {
                        var errorString = '<div role="alert" class="alert alert-success">' + response.message + '</div>';
                        $('#alert_messages').html(errorString);
                        $('#send-company-message-form').hide('slow');
                        $(document).scrollTo('.alert', 2000);
                    } else
                    {
                        var errorString = '<div class="alert alert-danger" role="alert"><ul>';
                        response = JSON.parse(data);
                        $.each(response, function (index, value)
                        {
                            errorString += '<li>' + value + '</li>';
                        });
                        errorString += '</ul></div>';
                        $('#alert_messages').html(errorString);
                        $(document).scrollTo('.alert', 2000);
                    }
                },
            });
        });
    });
</script>
@endpush
