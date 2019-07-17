@extends('layouts.app')

@section('title')
Settings
@endsection


@section('content')

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">List  of Settings</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fas fa-times"></i></button>
          </div>
        </div>
        <div class="card-body">
            
            @include('flash::message')

            <div class="table-responsive">

              <table class="table table-bordered ">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>About Message</th>
                            <th>Facebook_link</th>
                            <th>Twitter_link</th>
                            <th>Youtube_link</th>
                            <th>Whatsapp_link</th>
                            <th>Instagram_link</th>
                            
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                       
                            <tr>
                                <td>1</td>
                                <td>{{$record->phone}}</td>
                                <td>{{$record->email}}</td>
                                <td>{!!$record->about_msg!!}</td>
                                <td>{{$record->facebook_link}}</td>
                                <td>{{$record->twitter_link}}</td>
                                <td>{{$record->youtube_link}}</td>
                                <td>{{$record->whatsapp_link}}</td>
                                <td>{{$record->instagram_link}}</td>
                               
                                <td class="text-center"> <a href="{{url(route('setting.edit',$record->id))}}" class="btn btn-success  btn-sm">Update</a></td>
                                
                            </tr>
                       
                    </tfoot>
                </table>
              </div>

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
