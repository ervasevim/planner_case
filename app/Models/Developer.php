<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Developer extends Model
{
    use HasFactory;
    const WEEKLY_WORK_HOUR = 45;

    protected $fillable = [
        'name', 'level'
    ];

    public function tasks() {
        return $this->hasMany(Task::class , 'developer_id');
    }

    public function getTime($week = 0)
    {
        $time = 0;

        if ($week > 0) {
            $tasks = $this->tasks()->where('week', $week)->get();
        } else $tasks = $this->tasks;

        foreach ($tasks as $task) {
            $time += $task->size;
        }

        return $time == 0 ? $time : $time/$this->level;
    }
}
