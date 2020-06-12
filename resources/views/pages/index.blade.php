@extends('layouts.base')

@section('title','ホーム')

@section('contents')
  <section>
    @if (Session::has('msg'))
      @include('components.msg')
    @endif
    @if (Auth::check())
      <p class="text-center">こんにちは、{{$user->name}}さん</p>
    @endif
  </section>
  <section class="contents">
    @if (Auth::check())
      @if (count($questionnaires)!=0)
        @foreach ($questionnaires as $questionnaire)
          @include('components.panel')
        @endforeach
      @else
        <p class="text-center">まだ質問はありません。</p>
      @endif
    @else
      @include('components.fornotuser')
    @endif
  </section>
    {{$questionnaires->links()}}
@endsection
