<?php

namespace App;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;

class Disiplin_detail extends Model
{
    use Uuid;

    public function absensi()
    {
        return $this->belongsTo(Absensi::class);
    }
}
