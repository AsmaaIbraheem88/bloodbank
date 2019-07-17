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
          <h3 class="card-title"> Donation informations</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fas fa-times"></i></button>
          </div>
        </div>
        <div class="card-body">
       
            @if ($donation)

            <table class="table table-striped" style="font-size:25px">

            <tr>
              <td >Patient Name : </td>
              <td>{{$donation->patient_name}}</td>
            </tr>

            <tr>
              <td >Patient Age : </td>
              <td>{{$donation->age}}</td>
            </tr>

            <tr>
              <td >Blood Type : </td>
              <td>{{optional($donation->blood_type)->name}}</td>
            </tr>

            <tr>
              <td >Bags Num : </td>
              <td>{{$donation->bags_num}}</td>
            </tr>

            <tr>
              <td >Hospital Name : </td>
              <td>{{$donation->hospital_name}}</td>
            </tr>

            <tr>
              <td >Phone : </td>
              <td>{{$donation->phone}}</td>
            </tr>

            <tr>
              <td >City : </td>
              <td>{{optional($donation->city)->name}}</td>
            </tr>

            <tr>
              <td >Notes : </td>
              <td>{{$donation->notes}}</td>
            </tr>

            <tr>
              <td >Client : </td>
              <td>{{optional($donation->client)->name}}</td>
            </tr>

      
            </table>
           
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
