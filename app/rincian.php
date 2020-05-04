<?php

namespace App;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class rincian extends Model
{
    use Notifiable;
    use Uuid;
}
