@extends('layouts.app')


@section('title')
  Governorates
@endsection


@section('content')

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">List  of  Governorates</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fas fa-times"></i></button>
          </div>
        </div>
        <div class="card-body">

            <a href="{{url(route('governorate.create'))}}" class="btn btn-primary"><i class="fas fa-plus"></i>  New Governorate</a>
            
            @include('flash::message')

            @if (count($records))

            <div class="table-responsive">

              <table class="table table-bordered ">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th class="text-center">Action</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($records as $record)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$record->name}}</td>
                            
                                <td class="text-center">
                                {!! Form::open ([

                                'action' => ['GovernorateController@destroy', $record->id],
                                'method' =>'delete'
                                
                                ]) !!}

                                <a href="{{url(route('governorate.edit',$record->id))}}" class="btn btn-success  btn-sm">Update</i></a>

                                <button type="submit" class="btn btn-danger btn-sm confirm">Delete</button>

                                {!! Form::close() !!}

                                </td>
                            </tr>
                        @endforeach
                    </tfoot>
                </table>
                {{$records->links()}}
                </div>
    
                @else
                <div class="alert alert-danger" role="alert">
                   There is no data
                </div>
            @endif

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
