@extends('layouts.default')

@section('content')
    <h1>Create a question for your quizz</h1>
    <hr>
    <form method="post" action="/questions">
        {{csrf_field()}}
        <select class="form-control form-control-sm mb-3" name="category_id">
            <option>--Choose question category--</option>
            @foreach($categories as $category)
                <option value="{{$category->id}}">{{$category->category}}</option>
            @endforeach
        </select>
        <div class="form-group mb-3">
            <label for="question">Add a new question</label>
            <textarea class="form-control" name="body" id="question" rows="3"></textarea>
        </div>


        <div class="form-group">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>

    </form>

    @include('includes.formError')
@stop