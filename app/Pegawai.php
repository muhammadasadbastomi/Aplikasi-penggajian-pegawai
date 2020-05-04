<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Notifications\Notifiable;

class Pegawai extends Model
{
    use Notifiable;
    use Uuid;
    protected $fillable = [
        'nama', 'nik', 'tempat_lahir', 'tgl_lahir', 'tgl_masuk', 'user_id', 'photos', 'role', 'jabatan_id'
    ];

    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class);
    }

    public function absensi()
    {
        return $this->hasOne(Absensi::class);
    }
}
