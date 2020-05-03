<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Notifications\Notifiable;

class Pegawai extends Model
{
    use Notifiable;
    use Uuid;
}
