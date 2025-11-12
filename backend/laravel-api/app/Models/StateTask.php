<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Task;

class StateTask extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_state';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'state',
        'level',
    ];

    public function tasks()
    {
        return $this->hasMany(Task::class, 'state_id', 'id_state');
    }
}
