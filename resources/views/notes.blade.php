<h1>TDD - notes laracast</h1>

use database transaction<br/>
create a test database<br/>
use factory to fake data into database<br/>
    create a model factory /database/factories<br/>

when you create model test describe the model in your tests. What property has, what methods perform, and condition of them
use saveMany() for collections , many to be saved<br/>
use ternary operator to switch between save and saveMany - neat trick<br/>
regression testing <br/><br/>

polimorphic relations trate can be used- tags , type is defined in the db as class path \App\<type> [code]get_class(<type>)[/code]<br/>
cast to boolean !! <br />
return instance to coninue chaining <br />
you can use parent testCase class to provide inheritance to all the testcase; <br/>
        you can include magic methods in a function for function readability <br />


@php
    echo "this is some code for tdd";
@endphp
