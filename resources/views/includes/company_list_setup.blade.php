<ul class="row profilestat">
    <li class="col-md-12 col-sm-4 col-xs-6">
        <div class="inbox"> <i class="fa fa-link" aria-hidden="true"></i>
            <h3><a href="{{route('posted.jobs')}}"></a></h3>
            <h3>
            <strong>{{__('The Site Live To convert')}}
            </strong>http://quickpresse.com</h3>
         </div>
    </li>

</ul>
<ul class="row profilestat">
    <li class="col-md-12 col-sm-4 col-xs-6">
        <div class="inbox"> <i class="fa fa-server" aria-hidden="true"></i>
            <h6><a href="{{route('posted.jobs')}}"></a></h6>
            <h4><strong>{{__('The Original OctoberCMS module')}}</strong> /var/www/quickpresse-com <h4>
        </div>
    </li>

</ul>

<ul class="row profilestat">
    <li class="col-md-12 col-sm-4 col-xs-6">
        <div class="inbox"> <i class="fa fa-server" aria-hidden="true"></i>
            <h6><a href="{{route('posted.jobs')}}"></a></h6>
            <h4><strong>{{__('The Conversion folder with Laravel')}}</strong> /var/www/quickpresse-to-laravel<h4>
        </div>
    </li>

</ul>

<ul class="row profilestat">
    <li class="col-md-12 col-sm-4 col-xs-6">
        <div class="inbox">
            <h6><a href="{{route('posted.jobs')}}"></a></h6>
            <a href="#">
                <i class="fa fa-cog" aria-hidden="true">
                </i>
            </a>

             <div class="actions">
                 @include('conversion.inc.modal_one')
                 <a href="" class="btn btn-default btn-rounded mb-4" data-toggle="modal" data-target="#modalOne">
                 <h4>Launch The Operation</h4>
                 </a>
                 </div>
        </div>
    </li>

</ul>