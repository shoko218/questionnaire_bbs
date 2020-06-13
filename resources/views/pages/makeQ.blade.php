@extends('layouts.base')

@section('title','質問作成')

@section('contents')
<section>
  @if ($errors->any())
    @include('components.errmsg')
  @endif
</section>
<section>
  @if ($errors->any())
    <div class="alert alert-danger">{{$errors}}</div>
     <!-- /.alert -->
  @endif
  <form action="/sendQ" method="post" class="contents">
    {{csrf_field()}}
    <input type="hidden" value="{{$user->id}}" name="user_id">
    <div class="form-group">
      <label for="title">タイトル</label>
      <input type="text" name="title" placeholder="5文字以上、30文字以内" class="form-control" value="{{old('title')}}">
    </div>
    <!-- /.form-group -->
    <div class="form-group">
      <label for="content">質問内容</label>
      <textarea name="content" placeholder="10文字以上、140文字以内" rows="4" class="form-control">{{old('content')}}</textarea>
    </div>
    <!-- /.form-group -->
      @for ($i=0; $i < App\Consts\QuesConst::MAX_NUM_OF_CHOICE; $i++)
        <div class="form-group">
          <label for="sentence[]">回答{{$i+1}}</label>
          <input type="text" name="sentence[]" placeholder="20文字以内@if($i<2)(必須)@endif" class="form-control" value="{{old('sentence.'.$i)}}">
        </div>
      @endfor
    <button type="submit" class="btn btn-primary mx-auto d-block submit-btn my-5">送信</button>
  </form>
</section>
@endsection
