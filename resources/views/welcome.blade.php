@extends('layouts.app')
@section('content')
@include('includes.header')
@include('includes.search')
@include('includes.how_it_works')
@include('includes.video')
@include('includes.subscribe')
@include('includes.footer')
@endsection
@push('scripts') 
<script>
    $(document).ready(function ($) {
        $("form").submit(function () {
            $(this).find(":input").filter(function () {
                return !this.value;
            }).attr("disabled", "disabled");
            return true;
        });
        $("form").find(":input").prop("disabled", false);
    });
</script>
@include('includes.country_state_city_js')
@endpush
