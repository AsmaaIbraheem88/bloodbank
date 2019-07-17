
<div class="form-group">
<label for="title" class="col-sm-4 control-label">Title</label>
{!! Form::text ('title',null,[

'class' => 'form-control',
'placeholder' => 'Title', 
  
]) !!}
</div>

<div class="form-group">
<label for="body" class="col-sm-4 control-label">Body</label>
{!! Form::textarea('body',null, [
    'class' => 'form-control',
     'placeholder' => 'Give a Description', 
     'id' => 'body'
]) !!}
</div>


<div class="form-group">
<label for="image" class="col-sm-4 control-label">Image</label>
{!! Form::file('image',[
    'class' => 'form-control'
]) !!}
</div>


<div class="form-group">
<label for="category" class="col-sm-4 control-label">Category</label>

{!! Form::select('category_id',App\Models\Category::pluck('name','id'),null, [
    'placeholder' => 'Choose a category',
    'class' => 'form-control'
]) !!}


</div>

<div class="form-group">
<button type="submit" class="btn btn-info">submit</button>
<button type="submit" class="btn btn-default float-right">Cancel</button>
</div>

