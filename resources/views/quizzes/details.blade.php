@extends('layouts.default')

@section('content')
    {{$quiz->title}} {{$quiz->description}}

    @foreach($questions as $question)
      <br />  {{$question->body}}
        @foreach($question->answers as $answer)
            <b>{{$answer->body}}</b>
        @endforeach
    @endforeach
@stop