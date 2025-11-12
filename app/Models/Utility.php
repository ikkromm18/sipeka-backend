<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Utility extends Model
{
    protected $table = 'utilities';

    protected $fillable = [
        'nama_camat',
        'nip_camat',
        'nomor_admin'
    ];
}
