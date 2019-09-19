<div class="col-md-12">
    <div class="instoretxt">
        <div class="credit">
            <h6 style="color: maroon">
               {{__('Your account is not verified yet, please check your email inbox or spam Or Request new verification')}}
                <a href="{{route('company.email-new-verification.send')}}"
                   class="btn btn-primary ladda-button" data-style="zoom-in">
                    <span class="ladda-label">
                      <i class="fa fa-envelope"></i>{{__(' Send Me New Verification email')}}
                    </span>
                </a>
            </h6>
        </div>
    </div>
</div>