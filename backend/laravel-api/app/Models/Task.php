<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\StateTask;
use App\Models\Category;

class Task extends Model
{
    use HasFactory;

    // Aqui definimos la llave primaria ya que cambia por id_task
    protected $primaryKey = 'id_task';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'user_id',
        'state_id',
        'category_id',
        'title',
        'description',
        'metadata',
        'due_date',
    ];

    protected $casts = [
        'metadata' => 'array',
        'due_date' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id_user');
    }

    public function stateTask()
    {
        return $this->belongsTo(StateTask::class, 'state_id', 'id_state');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id_category');
    }
}
