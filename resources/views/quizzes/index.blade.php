@extends('layouts.default')

@section('content')
 @if( isset($quizzes))
     <h4 class="mt-5">Current quizzes</h4>
     <ul class="list-group ">
     @foreach($quizzes as $quiz)


             <li class="list-group-item ">
                 <div class="row">
                     <span class="col-md">{{$quiz->title}}</span>
                     <span class="col-md" >{{$quiz->description}}</span>
                     <span class="col-md">


                     @if( auth::user()->role == 'admin')
                         <a class="btn btn-primary bnt-sm mr-1 float-right" href="/quizzes/{{$quiz->id}}/delete"><i class="fas fa-trash"></i></a>
                         <a class="btn btn-primary bnt-sm mr-1 float-right" href="/quizzes/{{$quiz->id}}/edit"><i class="fas fa-pencil-alt"></i></a>
                     @endif
                       <a class="btn btn-primary bnt-sm mr-1 float-right" href="/quizzes/{{$quiz->id}}/preview"><i class="fas fa-binoculars"></i></a>

                 </span>
                 </div>

             </li>
     @endforeach
     </ul>
    {{ $quizzes->links() }}
  @else
     <div class="card mt-5" style="width: 35rem;">
         <div class="card-body">
             <h5 class="card-title mt-2">Your first quizz</h5>

             <h6 class="card-subtitle mt-4">There are no quizzes in this moment</h6>
             <p class="card-text">Start building your first quiz by creating a
                 new quiz category <a href="/categories" class="card-link" ><strong>  HERE </strong></a>
             </p>
             <strong>Thank you</strong>
         </div>
     </div>


  @endif
@stop
