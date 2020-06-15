<?php

namespace App;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Absensi extends Model
{
    use Notifiable;
    use Uuid;

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class);
    }

    public function periode()
    {
        return $this->belongsTo(Periode::class);
    }

    public function disiplin_detail()
    {
        return $this->hasOne(Disiplin_detail::class);
    }
}
