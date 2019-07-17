
<div class="form-group">
<label for="name" class="col-sm-4 control-label">Name</label>
{!! Form::text ('name',null,[

    'class' => 'form-control'
  
]) !!}
</div>

<div class="form-group">
<label for="governorate" class="col-sm-4 control-label">Governorate</label>

{!! Form::select('governorate_id',App\Models\Governorate::pluck('name','id'),null, [
    'placeholder' => 'Choose a governorate',
    'class' => 'form-control'
]) !!}


</div>

<div class="form-group">
<button type="submit" class="btn btn-info">submit</button>
<button type="submit" class="btn btn-default float-right">Cancel</button>
</div>

