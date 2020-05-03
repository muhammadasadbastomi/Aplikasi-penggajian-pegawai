<?php

namespace App;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Jabatan extends Model
{
    use Notifiable;
    use Uuid;

    // public function members()
    // {
    //     return $this->hasMany(Member::class);
    // }

}
