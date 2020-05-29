<?php

namespace App;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Pegawai extends Model
{

    use Notifiable;
    use Uuid;
    // protected $fillable = [
    //     'nama', 'nik', 'tempat_lahir', 'tgl_lahir', 'tgl_masuk', 'user_id', 'photos', 'role', 'jabatan_id', 'golongan_id', 'status', 'pekerja', 'alamat'
    // ];
    protected $fillable = [
        'nama', 'nik', 'tempat_lahir', 'tgl_lahir', 'tgl_masuk', 'user_id', 'photos', 'role', 'status', 'alamat'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // public function jabatan()
    // {
    //     return $this->belongsTo(Jabatan::class);
    // }

    // public function golongan()
    // {
    //     return $this->belongsTo(Golongan::class);
    // }

    public function absensi()
    {
        return $this->hasMany(Absensi::class);
    }

    public function kinerja()
    {
        return $this->hasMany('App\Kinerja', 'karyawan_id', 'id');
    }
}
