<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Notifications\Notifiable;

class Absensi extends Model
{
    use Notifiable;
    use Uuid;

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class);
    }
}
