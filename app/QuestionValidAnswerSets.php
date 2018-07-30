<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class QuestionValidAnswerSets extends Model
{
      use SoftDeletes;
      protected $dates = ['deleted_at'];
      protected $fillable = ['question_id', 'valid_answer'];

      public function question()
      {
          return $this->hasOne(Question::class);
      }
}
