<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Answer_log as A_log;
use App\Answer_sentence as A_sentence;
use App\Questionnaire_sentence as Q_sentence;
use App\User;
use App\Consts\QuesConst;

class pagesController extends Controller
{
  public function index(Request $request){
    $user=Auth::user();
    $questionnaires=Q_sentence::orderBy('id','desc')->simplePaginate(20);
    $param=['user'=>$user,'questionnaires'=>$questionnaires];
    return view('pages.index',$param);
  }

  public function makeQ(Request $request){
    $user=Auth::user();
    $param=['user'=>$user];
    return view('pages.makeQ',$param);
  }

  public function mypage(Request $request){
    $user=Auth::user();
    $questionnaires=Q_sentence::where('user_id',$user->id)->orderBy('id','desc')->simplePaginate(20);
    $param=['user'=>$user,'questionnaires'=>$questionnaires];
    return view('pages.mypage',$param);
  }

  public function canlogin(Request $request)
  {
    return redirect('/')->with('msg', 'ログインしました。');
  }
  public function logout(Request $request)
  {
    Auth::logout();
    return redirect('/')->with('msg', 'ログアウトしました。');
  }

  public function sendQ(Request $request)
  {
    $this->validate($request,Q_sentence::$rules);
    $ques=new Q_sentence;
    $ques->user_id=$request->user_id;
    $ques->title=$request->title;
    $ques->sentence=$request->content;
    $ques->save();
    for ($i=0; $i < QuesConst::MAX_NUM_OF_CHOICE; $i++) {
      if($request->sentence[$i]==null) break;
      $answer=new A_sentence;
      $answer->questionnaire_sentence_id=$ques->id;
      $answer->sentence=$request->sentence[$i];
      $answer->save();
    }
    return redirect('/')->with('msg', '送信しました。');
  }

  public function detail(Request $request)
  {
    $user=Auth::user();
    $id=$request->input('id');
    $targetQ=Q_sentence::find($id);
    if(Auth::check()){
      $user_id=$user->id;
    }else{
      $user_id=-1;
    }
    $isYour=($targetQ->user_id==$user_id);
    $param=['targetQ'=>$targetQ,'user'=>$user,'isYour'=>$isYour];
    if(A_log::didAnswer($targetQ->id,$user_id)){
      $didAnswer=A_log::didAnswer($targetQ->id,$user_id)->answer_sentence_id;
      $A_sentence=A_sentence::find($didAnswer)->sentence;
      $param['A_sentence']=$A_sentence;
    }
    return view('pages.detail',$param);
  }

  public function submit(Request $request)
  {
    $this->validate($request,A_log::$rules);
    $answer=new A_log;
    $form=$request->all();
    unset($form['_token']);
    $answer->fill($form)->save();
    return redirect('/detail?id='.$request->questionnaire_sentence_id)->with('msg', '送信しました。');
  }

  public function delete(Request $request)
  {
    $delete = Q_sentence::find($request->id);
    $delete->delete();
    return redirect('/')->with('msg', '削除しました。');
  }

  public function welcome()
  {
    return redirect('/')->with('msg', 'ログインしました。');
  }

  public function register_complete()
  {
    return redirect('/')->with('msg', '登録が完了しました。');
  }
}
