<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasAvatar;
use Filament\Panel;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable implements FilamentUser, HasAvatar
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function ijazah()
    {
        return $this->hasMany(Ijazah::class);
    }

    public function bkd()
    {
        return $this->hasMany(Bkd::class);
    }

    public function skp()
    {
        return $this->hasMany(Skp::class);
    }

    public function prestasi()
    {
        return $this->hasMany(Prestasi::class);
    }

    public function hki()
    {
        return $this->hasMany(Hki::class);
    }

    public function paten()
    {
        return $this->hasMany(Paten::class);
    }

    public function buku()
    {
        return $this->hasMany(Buku::class);
    }
    public function organisasi()
    {
        return $this->hasMany(Organisasi::class);
    }
    public function kompetensi()
    {
        return $this->hasMany(Kompetensi::class);
    }
    public function serdos()
    {
        return $this->hasMany(Serdos::class);
    }

    public function dataTendik()
    {
        return $this->hasMany(DataTendik::class);
    }

    public function jabatan_fungsional()
    {
        return $this->hasMany(JabatanFungsional::class);
    }

    public function pangkat()
    {
        return $this->hasMany(Pangkat::class);
    }


    public function getFilamentAvatarUrl(): ?string
    {
        $avatarColumn = config('filament-edit-profile.avatar_column', 'avatar_url');
        return $this->$avatarColumn ? Storage::url($this->$avatarColumn) : null;
    }
    public function canAccessPanel(Panel $panel): bool
    {
        return true;
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'name',
        'email',
        'password',
        'avatar_url',
        'role',
        'nidn'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
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
}
