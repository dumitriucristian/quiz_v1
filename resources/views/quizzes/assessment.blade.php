@extends('layouts.default')

@section('content')

    <h1> {{$quiz->title}} </h1>
    <div>You solved with succes {{$validAnswers}} of  {{$totalAnswers}} questions - your average is {{$averageResult}}%</div>

    @foreach($userAnswerSet as $data)
        <strong>{{$data->question->body}}</strong>

        @foreach($data->question->userAnswers->where('session_id',$sessionId) as $userAnswer)

           @if($userAnswer->is_valid_answer)
            <div style="color:green;">{{$userAnswer->answer->body}}<span>OK</span></div>
           @else
            <div style="color:red;">{{$userAnswer->answer->body}}<span>X</span></div>
           @endif

        @endforeach

        @if($data->is_valid_answer_set)
            <p>Good Answer</p>
        @else
            <p>Wrong Answer</p>
        @endif
    @endforeach

@stop