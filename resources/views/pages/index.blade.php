@extends('layouts.base')

@section('title','ホーム')

@section('contents')
  <section>
    @if (Session::has('msg'))
      @include('components.msg')
    @endif
  </section>
  <section class="contents">
    <h1 id="top_title">新着質問</h1>
    @if (count($questionnaires)!=0)
      @foreach ($questionnaires as $questionnaire)
        @include('components.panel')
      @endforeach
    @else
      <p class="text-center">まだ質問はありません。</p>
    @endif
    {{$questionnaires->links()}}
  </section>
@endsection
