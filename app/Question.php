<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Question extends Model
{
   use SoftDeletes;

   protected $dates = ['deleted_at'];
   protected $fillable = ['body','category_id'];


   public function answers()
   {
       return $this->hasMany(Answer::class);
   }


    public function category()
    {

        return $this->belongsTo(Category::class);
    }

    public function quizzes()
    {
        return $this->belongsToMany(Quiz::class )->withTimestamps();
    }

    public function validAnswerSets()
    {
        return $this->hasOne(QuestionValidAnswerSets::class);
    }

    public function userAnswers()
    {
        return $this->hasMany(UserAnswer::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function($questions) {
            foreach ($questions->answers()->get() as $question) {
                $question->delete();
            }
        });
    }


}
