@extends('layouts.default')

@section('content')

    <h2>Quiz edit</h2>
    <hr>
        <div class="col-md-12 col-sm-12">
            <form method="POST" action="/quizzes/{{$quiz->id}}/update">

              <div class="row">
                  {{csrf_field()}}
                  {{ method_field('PATCH') }}
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text ">Title</span>
                    </div>
                    <input type="text" name="title" class="form-control" value="{{ $quiz->title }}" />
                </div>
              </div>

               <div class="row">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Description</span>
                        </div>
                        <input type="text" name="description" class="form-control" value="{{ $quiz->description }}" />
                    </div>
               </div>

                <div class="row">
                    <div class="col-12">
                        <button  type="submit"      class=" btn btn-primary btn-sm float-right ml-2">Update Quiz</button>
                        <a href="/questions/create" class=" btn btn-primary btn-sm float-right">Create new question</a>
                    </div>
                </div>


            </form>
        </div>

    <div class="row">

        <div class="col-md-6 col-sm-12">
           <div class="card mt-5">
                <div class="card-header">
                    <p><strong>Current quiz questions</strong></p>
                    <hr>
                    <div class="row">
                      <div class="col-md-6 col-sm-12">
                        <label>Filter by Category</label>
                        <select class="form-control" id="exampleFormControlSelect1">
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                        </select>
                      </div>
                      <div class="form-group col-md-6 col-sm-12 ml-auto mt-3 pt-3">
                          <input class="form-control mr-sm-2  mr-0" type="search" placeholder="Search question" aria-label="Search">
                      </div>
                    </div>
                </div>

                <div class="card-body">
                    @foreach($currentQuestions as $question)
                    <form method="post" action="/quizzes/question/detach">
                        {{csrf_field()}}
                        <input type="hidden" name="question_id" value="{{$question->id}}">
                        <input type="hidden" name="id" value="{{$quiz->id}}" />
                        <div>
                            <label class="col-md-8 col-sm-12 col-xs-12">{{$question->body}}</label>
                            <span class="col-md-2 col-sm-12 col-xs-12">
                                <a href="/questions/{{$question->id}}/edit" class="btn-primary btn btn-sm mb-lg-0"><i class="fas fa-pencil-alt"></i></a>
                                <button type="submit" class="btn-primary btn btn-sm  mb-lg-0"><i class="fas fa-minus-circle"></i></button>
                            </span>
                        </div>
                    </form>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="col-md-6 col-sm-12">
            <div class="card mt-5">
                <div class="card-header">
                    <p><strong>Available questions</strong></p>
                    <hr>
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <label>Filter by Category</label>
                            <select class="form-control" id="exampleFormControlSelect1">
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                            </select>
                        </div>
                        <div class=" col-md-6 col-sm-12 ml-auto mt-3 pt-3">
                            <input class="form-control mr-sm-2  mr-0" type="search" placeholder="Search question" aria-label="Search">
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    @foreach($availableQuestions as $question)
                        <form method="post" action="/quizzes/question/attach">
                            {{csrf_field()}}
                            <input type="hidden" name="question_id" value="{{$question->id}}">
                            <input type="hidden" name="id" value="{{$quiz->id}}" />
                            <div >
                                <label class="col-md-8 col-sm-12 col-xs-12">{{$question->body}}</label>
                                <span class="col-md-2 col-sm-12 col-xs-12">
                                        <a href="/questions/{{$question->id}}/edit" class="btn-primary btn btn-sm  mb-lg-0"><i class="fas fa-pencil-alt"></i></a>
                                        <button type="submit" class="btn-primary btn btn-sm  mb-lg-0"><i class="fas fa-plus-circle"></i></button>
                                </span>

                            </div>
                        </form>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@stop