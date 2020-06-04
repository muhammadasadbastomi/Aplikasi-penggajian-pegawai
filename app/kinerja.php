<?php

namespace App;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Kinerja extends Model
{

    use Notifiable;
    use Uuid;
    protected $fillable = [
        'pegawai_id',
    ];
    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class);
    }

    public function gajiperiode()
    {
        return $this->belongsTo(Gajiperiode::class);
    }

    public function disiplin_detail()
    {
        return $this->hasOne(Disiplin_detail::class);
    }
}
