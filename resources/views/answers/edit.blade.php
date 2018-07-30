@extends('layouts.default')
@php
   $correct =( $answer->correct === 1)? 'true' : 'false';
@endphp
@section('content')
    <div class="row">
        <h3>Edit answer</h3>
    </div>
    <hr>
{{$answer->body}} {{ $correct }}


@stop