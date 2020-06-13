@extends('layouts.base')

@section('title','ホーム')

@section('contents')

  <section>
    @if (Session::has('msg'))
      @include('components.msg')
    @endif
    @if ($errors->any())
      @include('components.errmsg')
    @endif
  </section>

  <section>
    <h1 class="target_title">{{$targetQ->title}}</h1>
    <p class="target_content">{{$targetQ->sentence}}</p>
    @if (count($targetQ->answer_logs)==0)
      <p class="text-center">まだ回答がありません。</p>
    @else
      @include('components.chart')
    @endif
  </section>
  <section class="contents">
    @if (Auth::check())
    @if($isYour)
      @component('components.detailmsg')
        @slot('title')
          あなたが作成した質問です。
        @endslot
        @slot('msg')
        @endslot
        @slot('list')
          @each('components.detailmsg_li', $targetQ->answer_sentences, 'choice')
        @endslot
      @endcomponent
    @else
      @isset($A_sentence)
        @component('components.detailmsg')
          @slot('title')
            ご回答ありがとうございました。
          @endslot
          @slot('msg')
            あなたの回答:{{$A_sentence}}
          @endslot
          @slot('list')
            @each('components.detailmsg_li', $targetQ->answer_sentences, 'choice')
          @endslot
        @endcomponent
      @else
        @include('components.submitform')
      @endisset
    @endisset
    @else
        @component('components.detailmsg')
          @slot('title')
          会員登録すると<br>質問や回答ができるようになります。
          @endslot
          @slot('msg')
          <div class="text-center">
            <a href="/register"  class="btn" style="background-color:rgb(24,162,183); margin-top:20px; color:white; width:35%; margin-right:15px;">新規登録</a>
            <a href="/login"  class="btn" style="background-color:white; margin-top:20px; color:rgb(24,162,183); width:35%; border:1px solid rgb(24,162,183);">ログイン</a>
          </div>
          @endslot
          @slot('list')
            @each('components.detailmsg_li', $targetQ->answer_sentences, 'choice')
          @endslot
        @endcomponent
    @endif

    @if($isYour)
      <div class="text-center">
        <form action="/delete" method="POST">
          @csrf
          <input type="hidden" value="{{ $targetQ->id }}" name="id">
          <button type="submit" class="btn" style="background-color:#ff0000; margin-top:20px; color:white; width:100%; max-width:200px">この質問を削除する</button>
        </form>
      </div>
    @else
      <div class="text-center">
        <button type="submit" class="btn text-center" style="background-color:rgb(24,162,183); margin-top:20px; color:white; width:100%; max-width:200px" onclick="location.href='/'">トップに戻る</button>
      </div>
    @endif
  </section>
@endsection
