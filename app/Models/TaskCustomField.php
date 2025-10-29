<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TaskCustomField extends Model
{
    use HasFactory,SoftDeletes;
    public function task(){
        return $this->belongsTo(Task::class);
    }

}
