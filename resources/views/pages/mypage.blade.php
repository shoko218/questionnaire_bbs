@extends('layouts.base')

@section('title','マイページ')

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
    <h1 class="text-center">{{$user->name}}さんのマイページ</h1>
    <section style="margin-top: 15px;" class="contents">
      <h2 class="text-center">あなたの作成した質問一覧</h2>
      @if (count($questionnaires)!=0)
        @foreach ($questionnaires as $questionnaire)
          @include('components.panel')
        @endforeach
      @else
        <p class="text-center" style="margin:40px 0 0;">あなたが作成した質問はまだありません。</p>
      @endif
      {{$questionnaires->links()}}
    </section>
</section>
@endsection
