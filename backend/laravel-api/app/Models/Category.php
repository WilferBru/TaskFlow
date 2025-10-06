<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Task;

class Category extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_category';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = ['category'];

    public function tasks()
    {
        return $this->hasMany(Task::class, 'category_id', 'id_category');
    }
}
