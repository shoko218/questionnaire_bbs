<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer_sentence extends Model
{
  protected $guarded = array('id');
  public static $rules=array(
    'user_id'=>'required|numeric',
    'title'=>'required|between:5,30',
    'content'=>'max:140',
    'sentence.0'=>'required|max:20',
    'sentence.1'=>'required|max:20',
    'sentence.*'=>'max:20',
  );

  public function questionnaire_sentence()
  {
    return $this->belongsTo('App\User');
  }

  public function answer_logs()
  {
    return $this->hasMany('App\Answer_log');
  }
}
