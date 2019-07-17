
 <div class="col-md-12" style="margin-bottom:20px"> 
    {{ Form::open(['action' => 'ContactController@index', 'class'=>'form width88', 'role'=>'search', 'method' => 'GET']) }} 
    
    {{ Form::text('keyword', null,[
        'class' => 'typeahead form-group form-control', 'placeholder' => 'Search by  name & email'
    ]) }}

    {{ Form::text('phone', null,[
        'class' => 'form-group form-control', 'placeholder' => 'Search by phone '
    ]) }}

    


    {{ Form::submit('Search',['class' => 'btn btn-default search-bar-btn']) }}
    {{ Form::close() }} 
</div>
           
 