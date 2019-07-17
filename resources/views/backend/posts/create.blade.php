@extends('layouts.app')

@inject('model','App\Models\Post')

@section('title')
 Create Posts
@endsection


@section('content')

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Create Posts</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fas fa-times"></i></button>
          </div>
        </div>
        <div class="card-body">

       

        {!! Form::model ($model,[

        'action' => 'PostController@store',
        'enctype' => 'multipart/form-data',
        'method' => 'POST',
          
        ]) !!}
        @include('partials.validation_errors')

        @include('backend.posts.form')

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
