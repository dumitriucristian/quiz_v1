<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;



class Answer extends Model
{

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = ['body','question_id', 'correct'];

    public function question()
    {
       return  $this->belongsTo(Question::class);
    }

    public function answer(){
        return $this->hasOne(UserAnswer::class);
    }



}
