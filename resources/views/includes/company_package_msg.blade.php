<div class="instoretxt">
    <div class="credit">{{__('Available quota')}} :
        <strong>
            {{Auth::guard('company')->user()->availed_jobs_quota}}
        </strong> /
        <strong>{{Auth::guard('company')->user()->jobs_quota}}</strong>
    </div>
</div>
