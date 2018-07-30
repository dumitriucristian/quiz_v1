<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [ 'category' ];



    public function question()
    {
        return $this->belongsToMany(Question::class);
    }


}
