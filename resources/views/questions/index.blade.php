@extends('layouts.default')

    @section('content')
        <div class="content">
            <div class="row">
                <h1>Question list</h1>
            </div>
        @foreach($questions as $question)
            <div class="row mb-1">
                <span class="m5">{{$question->id}}. </span>
                <span class="col-9"> {{$question->body}}</span>
                <span class="col-2">
                     <a class="btn btn-primary btn-sm mr-1" href="/questions/{{$question->id}}/edit"><i class="fas fa-pencil-alt"></i></a>
                     <a class="btn btn-primary btn-sm" href="/questions/{{$question->id}}/delete"><i class="fas fa-trash"></i></a>
                </span>

            </div>
        @endforeach
            <div class="row">
                <a href="/questions/create" class=" btn-primary btn-sm ">New question</a>
            </div>

        </div>
    @stop



