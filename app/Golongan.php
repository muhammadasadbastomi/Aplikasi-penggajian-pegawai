<?php

namespace App;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Golongan extends Model
{
    use Notifiable;
    use Uuid;

    // public function member()
    // {
    //     return $this->BelongsTo(Member::class);
    // }

}