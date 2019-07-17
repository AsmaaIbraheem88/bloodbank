
<div class="form-group">
<label for="title" class="col-sm-4 control-label">Phone</label>
{!! Form::text ('phone',null,[

'class' => 'form-control',
'placeholder' => 'Phone', 
  
]) !!}
</div>

<div class="form-group">
<label for="email" class="col-sm-4 control-label">Email</label>
{!! Form::text ('email',null,[

'class' => 'form-control',
'placeholder' => 'Email', 
  
]) !!}
</div>

<div class="form-group">
<label for="about" class="col-sm-4 control-label">About</label>
{!! Form::textarea('about_msg',null, [
    'class' => 'form-control',
     'placeholder' => 'Give a Description', 
     
]) !!}
</div>


<div class="form-group">
<label class="col-sm-4 control-label">Facebook Link</label>
{!! Form::text ('facebook_link',null,[

'class' => 'form-control',
'placeholder' => 'Facebook', 
  
]) !!}
</div>

<div class="form-group">
<label class="col-sm-4 control-label">Twitter Link</label>
{!! Form::text ('twitter_link',null,[

'class' => 'form-control',
'placeholder' => 'Twitter', 
  
]) !!}
</div>

<div class="form-group">
<label class="col-sm-4 control-label">Youtube Link</label>
{!! Form::text ('youtube_link',null,[

'class' => 'form-control',
'placeholder' => 'Youtube', 
  
]) !!}
</div>

<div class="form-group">
<label class="col-sm-4 control-label">Whatsapp Link</label>
{!! Form::text ('whatsapp_link',null,[

'class' => 'form-control',
'placeholder' => 'Whatsapp', 
  
]) !!}
</div>

<div class="form-group">
<label class="col-sm-4 control-label">Instagram Link</label>
{!! Form::text ('instagram_link',null,[

'class' => 'form-control',
'placeholder' => 'Instagram', 
  
]) !!}
</div>

<div class="form-group">
<button type="submit" class="btn btn-info">submit</button>
<button type="submit" class="btn btn-default float-right">Cancel</button>
</div>

