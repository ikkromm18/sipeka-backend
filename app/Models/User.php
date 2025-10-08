<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'nik',
        'no_kk',
        'nama_kepala_keluarga',
        'alamat',
        'desa',
        'rt',
        'rw',
        'kecamatan',
        'kabupaten',
        'provinsi',
        'kode_pos',
        'dusun',
        'nomor_hp',
        'pekerjaan',
        'tempat_lahir',
        'tgl_lahir',
        'foto_ktp',
        'foto_kk',
        'is_active'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function PengajuanSurats(): HasMany
    {
        return $this->hasMany(PengajuanSurat::class, 'nik', 'nik');
    }
}
