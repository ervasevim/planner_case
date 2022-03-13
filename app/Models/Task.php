<?php

namespace App\Models;

use App\Http\Resources\TaskResource;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    public $timestamps = false;


    protected $fillable = [
        'task_id', 'duration', 'level', 'developer_id', 'week'
    ];

    public function getSizeAttribute()
    {
        return $this->level * $this->duration;
    }

    public function developer()
    {
        return $this->belongsTo(Developer::class, 'developer_id');
    }

    public function toArray(): TaskResource
    {
        return new TaskResource($this);
    }

}
