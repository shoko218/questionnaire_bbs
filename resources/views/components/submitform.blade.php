<div class="card card-default submitForm">
    <form action="/submit" method="post" id="submit-form" class="card-body">
        @foreach ($targetQ->answer_sentences as $answer)
          <div class="custom-control custom-radio">
            <input type="radio" class="custom-control-input" name="answer_sentence_id" form="submit-form" value="{{$answer->id}}" id="choice_{{$answer->id}}">
            <label for="choice_{{$answer->id}}" class="custom-control-label" form="submit-form">{{$answer->sentence}}</label>
          </div>
        @endforeach
      {{csrf_field()}}
      <input type="hidden" name="user_id" value="{{$user->id}}">
      <input type="hidden" name="questionnaire_sentence_id" value="{{$targetQ->id}}">
      <button type="submit" class="btn" style="background-color:rgb(24,162,183); margin-top:20px; color:white; width:100%;">投票！</button>
    </form>
</div>
