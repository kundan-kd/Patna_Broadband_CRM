<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use HasFactory,SoftDeletes;
    public function customFields(){
        return $this->hasMany(TaskCustomField::class);
    }
    public function userData(){
        return $this->belongsTo(User::class,'assign_to');
    }
}
