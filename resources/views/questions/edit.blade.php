@extends('layouts.default')

@section('content')

    @if (Session::has('message'))
        <div class="alert alert-success mt-3">
           {{ session('message' )}}
        </div>

    @endif
    <div class="row">
        <h5 class=" mt-4">Update question  <a href="/questions/create" class="btn btn-primary btn-sm">Add new Question</a>
        </h5>
    </div>


    <form method="POST" action="/questions/{{$question->id}}/update" >
        <div class="form-group">
            {{csrf_field()}}
            @method('PATCH')
    <div class="row">

        <label>Category </label>
    </div>
    <div class="row">
        <select class="form-control form-control-sm mb-2" name="category_id">
            <option value="{{$question->category_id}}">    {{$question->category->category}}</option>
            @foreach($categoriesOptions as $option)

                <option value="{{$option->id}}">{{$option->category}}</option>
            @endforeach
        </select>
    </div>
    <div class="row">
        <textarea class="form-control mb-2" name="body" rows="3"> {{$question->body}}</textarea>
    </div>

    <div class="row">
        <button type="submit" class="btn btn-primary ml-auto btn-sm">Update Question Text</button>
    </div>




        </div>
    </form>

    <div class="row mt-5 mb-4">
        <div class="col-12" >
            <form method="POST" action="/quizzes/{{$question->id}}/setAnswer">

                {{csrf_field()}}
                <div class="input-group input-group-sm">
                    <input type="text" name="body" class="form-control" placeholder="This question answer is">

                    <select name="correct" class="custom-select col-2" >
                        <option value="" selected>Choose..</option>
                        <option value="1">Correct Answer</option>
                        <option value="0">Incorrect Answer</option>
                    </select>

                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">Add answer</button>
                    </div>
                 </div>
            </form>
        </div>
    </div>
    @if(count($question->answers) > 0)

        @foreach($question->answers as $answer)

        <form method="POST" action="/answers/{{$answer->id}}/update">
            <div class="row mb-1">
            {{csrf_field()}}
             @method('PATCH')
              <div class="col-12">
                  <div class="input-group">
                      <div class="input-group-append">
                          <button type="submit" class="btn btn-primary float-right">Edit Answer</button>
                      </div>

                      <select name="correct" class="custom-select col-2" >
                         <option value="{{$answer->correct}}" selected>{{$answer->correct_text}}</option>
                         <option value="{{ $answer->option['id'] }}">{{$answer->option["text"]}}</option>
                      </select>
                      <input type="text"  class="form-control" name="body"  value="{{$answer->body}}" />

                      <a href="/answers/{{$answer->id}}/delete" class="btn btn-primary ml-1"><i class="fas fa-trash"></i></a>

                  </div>
                 </div>
              </div>
          </form>
          @endforeach
    @endif

@include('includes/formError')
@stop