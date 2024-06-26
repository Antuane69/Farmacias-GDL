<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubTask extends Model
{
    use HasFactory;

    protected $table = "sub_task";

    protected $fillable =  [
        'title',
        'isCompleted',
        'task_id',
    ];

    public function Tasks(){
        return $this->belongsTo(Task::class, 'id', 'task_id');
    }
}
