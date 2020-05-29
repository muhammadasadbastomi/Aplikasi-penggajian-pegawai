<?php

namespace App;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Kinerja extends Model
{

    use Notifiable;
    use Uuid;

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class);
    }

    public function gajiperiode()
    {
        return $this->belongsTo(Gajiperiode::class);
    }
}
