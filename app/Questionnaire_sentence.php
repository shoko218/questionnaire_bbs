<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Questionnaire_sentence extends Model
{
  protected $guarded = array('id');
  public static $rules=array(
    'user_id'=>'required|numeric',
    'title'=>'required|between:5,30',
    'content'=>'between:10,140',
    'sentence.0'=>'required|max:20',
    'sentence.1'=>'required|max:20',
    'sentence.*'=>'max:20',
  );
  public function user()
  {
    return $this->belongsTo('App\User');
  }

  public function answer_sentences()
  {
    return $this->hasMany('App\Answer_sentence');
  }

  public function answer_logs()
  {
    return $this->hasMany('App\Answer_log');
  }
}
