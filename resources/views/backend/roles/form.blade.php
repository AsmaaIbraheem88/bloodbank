
@inject('perm','App\Models\Permission')

<div class="form-group">
<label for="name" class="col-sm-4 control-label">Name</label>
{!! Form::text ('name',null,[

'class' => 'form-control'
  
]) !!}
</div>

<div class="form-group">
<label for="display_name" class="col-sm-4 control-label">Display Name</label>
{!! Form::text ('display_name',null,[

'class' => 'form-control'
  
]) !!}
</div>


<div class="form-group">
<label for="description" class="col-sm-4 control-label">Description</label>
{!! Form::textarea ('description',null,[

'class' => 'form-control'
  
]) !!}
</div>


<div class="form-group"> 
<label for="name" class="col-sm-4 control-label">Permissions</label>
<br>
<input id="select_all" type="checkbox"> <label class="form-check-label" for="select_all">Select All</label>


    <div class="row">
        @foreach($perm->all() as $permission )

        <div class="col-sm-3">
            <div class="form-check">
              
                <input class="form-check-input" type="checkbox" id="defaultCheck1" name="permissions_list[]" value="{{$permission->id}}"
                
                @if($model->hasPermission($permission->name))

                    checked

                @endif
                >
                <label class="form-check-label" for="defaultCheck1">
                 {{$permission->display_name}}
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