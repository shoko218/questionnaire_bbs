<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer_log extends Model
{
  protected $guarded = array('id');
  public static $rules=array(
    'questionnaire_sentence_id'=>'required|numeric',
    'user_id'=>'required|numeric',
    'answer_sentence_id'=>'required|numeric',
  );
  public function user()
  {
    return $this->belongsTo('App\User');
  }

  public function questionnaire_sentence()
  {
    return $this->belongsTo('App\Questionnaire_sentence');
  }

  public function answer_sentence()
  {
    return $this->belongsTo('App\Answer_sentence');
  }

  public static function didAnswer($q_id,$user_id)
  {
    return Answer_log::where('questionnaire_sentence_id',$q_id)->where('user_id',$user_id)->first();
  }
}
