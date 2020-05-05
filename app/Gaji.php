<?php

namespace App;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Gaji extends Model
{
    use Notifiable;
    use Uuid;

    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class);
    }
    public function golongan()
    {
        return $this->belongsTo(Golongan::class);
    }
    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class);
    }
}
