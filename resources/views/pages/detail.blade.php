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
    @if($isYour)
    <div class="text-center">
      <form action="/delete" method="POST">
        @csrf
        <input type="hidden" value="{{ $targetQ->id }}" name="id">
        <button type="submit" class="btn" style="background-color:#ff0000; margin-top:20px; color:white; width:100%; max-width:200px">この質問を削除する</button>
      </form>
    </div>
    @endif
  </section>
@endsection
