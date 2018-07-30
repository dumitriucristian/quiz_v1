<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDelete;

class Quiz extends Model
{

    protected $dates = ['deleted_at'];
    protected $fillable = ['title', 'description'];


    public function questions()
    {
        return $this->belongsToMany(Question::class )->withTimestamps();
    }


}
