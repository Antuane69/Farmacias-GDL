<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $table = "task";

    protected $fillable =  [
        'title',
        'descripcion',
        'isCompleted',
        'dueDate',
        'user_id',
        'priority',
        'tags',
        'subtask_id',
    ];

    public function SubTasks(){
        return $this->hasMany(SubTask::class, 'task_id', 'id');
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
}
