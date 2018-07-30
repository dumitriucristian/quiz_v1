@extends('layouts.default')

@section('content')
<form method="post" action="/quizzes">

    <div class="form-group">
        {{csrf_field()}}
        <label for="title">Title</label>
        <input name="title" type="text" class="form-control"/>
    </div>
     <div class="form-group">
        <label for="description">Description</label>
        <textarea class="form-control" name="description"></textarea>
     </div>
        <input type="submit"  class="btn btn-primary mb-2">
</form>

@include('includes.formError')
@stop
