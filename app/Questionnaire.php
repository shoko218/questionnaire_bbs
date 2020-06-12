<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Questionnaire extends Model
{
  protected $guarded = array('id');
  public static $rules=array(
    'user_id'=>'required|numeric',
    'title'=>'required|between:5,30',
    'content'=>'required|between:10,140',
    'sentence.0'=>'required',
    'sentence.1'=>'required',
    'sentence.*'=>'max:20',//引っ掛かり
  );
  public static $submitrules=array(
    'choice'=>'required',
  );
  public $timestamps = true;
  public function user()
  {
    return $this->belongsTo('App\User');
  }
}
