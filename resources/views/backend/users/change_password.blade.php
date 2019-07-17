@extends('layouts.app')

@section('title')
 Change Password
@endsection


@section('content')

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Change Password</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fas fa-times"></i></button>
          </div>
        </div>
        <div class="card-body">

        

        {!! Form::model ($model,[

        'action' => 'UserController@changePasswordSave',
        'method' =>'POST'
          
        ]) !!}

        
        @include('flash::message')

        @include('partials.validation_errors')

        <div class="form-group">
        <label for="old_password" class="col-sm-4 control-label">Old Password</label>
        {!! Form::password ('old_password',[

        'class' => 'form-control'
        
        ]) !!}
        </div>

        <div class="form-group">
        <label for="password" class="col-sm-4 control-label">New Password</label>
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
        <button type="submit" class="btn btn-info">submit</button>
        <button type="submit" class="btn btn-default float-right">Cancel</button>
        </div>        

        {!! Form::close() !!}

        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          <!-- Footer -->
        </div>
        <!-- /.card-footer-->
      </div>
      <!-- /.card -->

    </section>

   
    

@endsection
