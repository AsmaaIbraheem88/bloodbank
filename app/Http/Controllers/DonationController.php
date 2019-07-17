<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DonationRequest;

class DonationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $records = DonationRequest::where(function ($query) use($request){

            if(!empty($request->blood_type_id))
    
            {
        

              $query->where('blood_type_id',$request->blood_type_id);
    
            }

            if( !empty($request->phone))
    
            {
              $query->where('phone',$request->phone);
    
            }
    
            if(!empty($request->keyword))
    
            {
              $query->where(function ($query) use($request){
                $query->where('patient_name','like','%'.$request->keyword.'%');
              });
             
            }
    
          })->paginate('20');
    
        
        return view('backend.donations.index',compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $donation = DonationRequest::findOrFail($id);
      return view('backend.donations.show',compact('donation'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request )
    
    {
        
       

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $record = DonationRequest::findOrFail($id);
        $record->delete();

        flash()->success('Donation deleted successfully ');

        return redirect(route('donation.index'));
    }

    
    
}
