@extends('layouts.app')

@section('title')
Donations
@endsection


@section('content')

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">List  of Donations</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fas fa-times"></i></button>
          </div>
        </div>
        <div class="card-body">
            
            @include('flash::message')

            @include('backend.donations.search-form')

            @if (count($records))

            <div class="table-responsive">

              <table class="table table-bordered ">
                    <thead>
                        <tr>

                            <th>#</th>
                            <th>Patient Name</th>
                            <th>Age</th>
                            <th>Blood Type</th>
                            <th>Bags Number</th>
                            <th>City</th>
                            <th>Hospital Name</th>
                            <th>Phone</th>
                            <th>Latitude</th>
                            <th>Longitude</th>
                            <th>Client</th>
                            <th>Hospital Address</th>
                            <th>Notes</th>
                           
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($records as $record)
                      
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$record->patient_name}}</td>
                                <td>{{$record->age}}</td>
                                <td>{{optional($record->blood_type)->name}}</td>
                                <td>{{$record->bags_num}}</td>
                                <td>{{optional($record->city)->name}}</td>
                                <td>{{$record->hospital_name}}</td>
                                <td>{{$record->phone}}</td>
                                <td>{{$record->latitude}}</td>
                                <td>{{$record->longitude}}</td>
                                <td>{{optional($record->Client)->name}}</td>
                                <td>{{$record->hospital_address}}</td>
                                <td>{{$record->notes}}</td>
                               

                               
                               
                                <td class="text-center">
                                {!! Form::open ([

                                'action' => ['DonationController@destroy', $record->id],
                                'method' =>'delete'
                                
                                ]) !!}

                                <a href="{{url(route('donation.show',$record->id))}}" class="btn btn-info  btn-sm">Show</a>
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
