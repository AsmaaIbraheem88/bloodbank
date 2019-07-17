@extends('layouts.app')

@section('title')
Contact
@endsection


@section('content')

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">List  of Contact</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fas fa-times"></i></button>
          </div>
        </div>
        <div class="card-body">
            
            @include('flash::message')

            @include('backend.contact.search-form')

            @if (count($records))

            <div class="table-responsive">

              <table class="table table-bordered ">
                    <thead>
                        <tr>
                        
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Subject</th>
                            <th>Message</th>
                            
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($records as $record)
                       
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$record->name}}</td>
                                <td>{{$record->email}}</td>
                                <td>{{$record->phone}}</td>
                                <td>{{$record->subject}}</td>
                                <td>{{$record->message}}</td>
                               

                                <td class="text-center">
                                {!! Form::open ([

                                'action' => ['ContactController@destroy', $record->id],
                                'method' =>'delete'
                                
                                ]) !!}

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
