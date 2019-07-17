
 <div class="col-md-12" style="margin-bottom:20px"> 
    {{ Form::open(['action' => 'DonationController@index', 'class'=>'form width88', 'role'=>'search', 'method' => 'GET']) }} 
    
    {{ Form::text('keyword', null,[
        'class' => 'typeahead form-group form-control', 'placeholder' => 'Search by patient name'
    ]) }}

    {{ Form::text('phone', null,[
        'class' => 'form-group form-control', 'placeholder' => 'Search by phone '
    ]) }}

    {{ Form::select('blood_type_id',App\Models\bloodType::pluck('name','id'),null,[
        'class' => 'form-group form-control', 'placeholder' => 'Search by blood Type '
        ]) }}

    


    {{ Form::submit('Search',['class' => 'btn btn-default search-bar-btn']) }}
    {{ Form::close() }} 
</div>
           
 