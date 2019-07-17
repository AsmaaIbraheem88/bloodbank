
@inject('roles','App\Models\Role')

<div class="form-group">
<label for="name" class="col-sm-4 control-label">Name</label>
{!! Form::text ('name',null,[

'class' => 'form-control'
  
]) !!}
</div>

<div class="form-group">
<label for="email" class="col-sm-4 control-label">Email</label>
{!! Form::text ('email',null,[

'class' => 'form-control'
  
]) !!}
</div>

<div class="form-group">
<label for="password" class="col-sm-4 control-label">Password</label>
{!! Form::password ('password',[

'class' => 'form-control'
  
]) !!}
</div>

<div class="form-group">
<label for="password_confirmation" class="col-sm-4 control-label">Password Confirmation</label>
{!! Form::password ('password_confirmation',[

'class' => 'form-control'
  
]) !!}
</div>


<div class="form-group"> 
<label for="name" class="col-sm-4 control-label">Roles</label>
<br>
<input id="select_all" type="checkbox"> <label class="form-check-label" for="select_all">Select All</label>


    <div class="row">
        @foreach($roles->all() as $role )

        <div class="col-sm-3">
            <div class="form-check">
              
                <input class="form-check-input" type="checkbox" id="defaultCheck1" name="roles_list[]" value="{{$role->id}}"
                
                @if($model->hasRole($role->name))

                    checked

                @endif
                >
                <label class="form-check-label" for="defaultCheck1">
                 {{$role->display_name}}
                </label>
            
            </div>
        </div>

        @endforeach
    </div>
</div>

<div class="form-group">
<button type="submit" class="btn btn-info">submit</button>
<button type="submit" class="btn btn-default float-right">Cancel</button>
</div>

@push('scripts')

<script>
   
    // Select all
    $("#select_all").click( function() {
        $("input[type='checkbox']").prop('checked',$(this).prop('checked'));
    });  
   
</script>

@endpush