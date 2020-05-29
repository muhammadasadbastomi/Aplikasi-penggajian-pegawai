<?php

namespace App;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Gajiperiode extends Model
{
    use Notifiable;
    use Uuid;

    public function kinerja()
    {
        return $this->hasMany(Kinerja::class);
    }
}
