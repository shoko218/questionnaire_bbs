<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static $rules=array(
      'number_of_point'=>'required|numeric',
    );
    protected $attributes = [
        // 定数を設定
        'number_of_point' => 200,
    ];

    public function questionnaire_sentences()
    {
      return $this->hasMany('App\Questionnaire_sentence');
    }
    public function answer_logs()
    {
      return $this->hasMany('App\Answer_log');
    }
  }
