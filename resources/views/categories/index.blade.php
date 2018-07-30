@extends('layouts.default')

    @section('content')
         <div class="row">
            <h1>Categories
                @if(count($categories))
                        <a class=" btn btn-primary btn-sm ml-2" href="/quizzes/create">Create a new Quiz</a>
                 @endif
            </h1>

        </div>
        <div class="row">
            <div class="col-12">
            <form method="post" action="/categories">
                {{  csrf_field() }}
                <div class="input-group mb-3">

                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">New Category</button>
                    </div>
                    <input type="text" class="form-control" placeholder="Category name" aria-label="Category name" name ="category">

                </div>
            </form>
            </div>
        </div>

        @foreach($categories as $category)
            <div class="row mb-1">
                <form class="col-12">
                    {{ csrf_field() }}
                    <div class="input-group">
                        <input type="text"  class="form-control" value="{{  $category->category }}" name="category" >
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="button">Button</button>
                        </div>
                        <a class="btn btn-primary btn-sm ml-1" href="/categories/{{ $category->id }}/delete"><i class="fas fa-trash"></i></a>
                     </div>
                </form>
            </div>
        @endforeach

        @include('includes/formError')

    @stop



