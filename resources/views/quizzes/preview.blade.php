@extends('layouts.default')

@section('content')
    <p>{{$quiz->title}} -  {{$quiz->description}}</p>

    <div id="question" class="mb-5">
        <form method="POST" action="/userAnswer">


            <p><strong>{{$question->body}}</strong></p>
            {{ csrf_field() }}
            <input type="hidden" name="question_id" value="{{$question->id}}"/>
            <input type="hidden" name="quiz_id" value="{{$quiz->id}}" />
            <input type="hidden" name="nextQuestion" value="{{$nextQuestionId}}" />

        @foreach($answers as $answer)
        <div>
            <input type="hidden" name="answer[{{$answer->id}}]" value="0"/>
            <input type="checkbox" name="answer[{{$answer->id}}]" value="1"/>
            <span>{{ $answer->body }}</span>
        </div>


        @endforeach
        @if( isset($previousQuestionId) )
            <a href="/quizzes/{{$quiz->id}}/preview/{{$previousQuestionId}}">Previous Question</a>
        @endif

        @if( isset($nextQuestionId) )
            <a href="/quizzes/{{$quiz->id}}/preview/{{$nextQuestionId}}">Next Question</a>
        @endif

             <input type="submit" value="send" />
        </form>
    </div>


    @include('includes/formError')

@stop

@section('pagescript')
    <script>
/*

        $(document).ready(function(){

            $.ajax({
                method:"GET",
                url:"/quizzes/getQuestion",
                dataType : 'json',
                data: data


            }).done(function(data) {
                console.log(data);
                var container = $("#question");
                var question = data.question;
                var answers  = data.answers;
                var questionHtml = '<div>'+question.body+'</div>';
               container.append(questionHtml);
                var answersHtml ='';
               $.each(answers, function(key, values){
                    answersHtml += '<div><input type="checkbox" values='+values.id+' name="answer"><label>'+values.body+'</label></div>';
                });

               container.append(answersHtml);


               console.log('done');
            });

        });
*/
    </script>
@stop
