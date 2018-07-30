<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserAnswerSets extends Model
{
     protected $fillable = [ 'session_id', 'user_id', 'quiz_id','question_id','user_answer_set','is_valid_answer_set'];

     public function question(){
         return $this->belongsTo(Question::class);
     }

     public function userAnswers()
     {
         return $this->hasMany(UserAnswer::class);
     }

     public static function saveUserAnswerDataSet( $answerCredentials , $answerData)
     {
         return self::updateOrCreate( $answerCredentials , $answerData);

     }



}
