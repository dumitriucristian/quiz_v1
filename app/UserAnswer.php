<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserAnswer extends Model
{
    protected $fillable = [ 'session_id', 'user_id', 'quiz_id','question_id','answer_id','answer_value','is_valid_answer'];


    public function userAnswerSets()
    {
        return $this->belongsTo(UserAnswerSets::class);
    }

    public function answer()
    {
        return $this->belongsTo(Answer::class);
    }

    public static function setUserAnswer()
    {

    }
}

