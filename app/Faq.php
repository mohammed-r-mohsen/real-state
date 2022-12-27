<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Faq extends Model
{
    use HasTranslations;

    protected $fillable=['question','answer','status'];


    public $translatable = ['question','answer'];
    protected $appends = ['item_question','item_answer'];

    public function getItemQuestionAttribute($value)
    {
        return @$this->question;
    }

    public function getItemAnswerAttribute($value)
    {
        return @$this->answer;
    }
}
