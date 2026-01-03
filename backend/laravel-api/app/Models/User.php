<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
// relacion
use App\Models\Task;
use Laravel\Sanctum\HasApiTokens;

/**
 * @method \Laravel\Sanctum\NewAccessToken createToken(string $name, array $abilities = ['*'])
 * @method \Laravel\Sanctum\PersonalAccessToken currentAccessToken()
 */
class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasApiTokens, HasFactory, Notifiable;

    // Primary Key personalizada
    protected $primaryKey = 'id_user';

    // Si no es autoincremental, habría que ponerlo en false, pero en tu caso sí lo es.
    public $incrementing = true;

    // Tipo de la PK
    protected $keyType = 'int';

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];


    protected $hidden = [
        'password',
        'remember_token',
    ];


    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Relacion
    public function tasks()
    {
        return $this->hasMany(Task::class, 'user_id', 'id_user');
    }
}
