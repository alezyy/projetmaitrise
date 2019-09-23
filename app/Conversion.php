<?php

namespace App;

use Auth;
use App;
use Carbon\Carbon;
use App\Traits\Active;
use App\Traits\Featured;
use App\Traits\JobTrait;
use App\Traits\CountryStateCity;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Notifications\CompanyResetPassword;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Conversion extends Authenticatable
{
    use Active;
    use Featured;
    use Notifiable;
    use JobTrait;
    use CountryStateCity;

    protected $table = 'conversion';
    public $timestamps = true;
    protected $guarded = ['id'];
    //protected $dateFormat = 'U';

}
