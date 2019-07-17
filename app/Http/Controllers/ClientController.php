<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\bloodType;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       
      
        $records = Client::where(function ($query) use($request){

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
                $query->where('name','like','%'.$request->keyword.'%')
                      ->orWhere('email','like','%'.$request->keyword.'%');
              });
             
            }
    
          })->paginate('20');
    
        
        return view('backend.clients.index',compact('records'));
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
        //
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
    public function update(Request $request, $id )
    
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
        $record = Client::findOrFail($id);

        if($record->donation_requests()->count())
        {
          flash()->error('This Client Has donation equests  ');
        }
        $record->delete();

        flash()->success('Client deleted successfully');

        return redirect(route('client.index'));
    }





    public function toggleActivation($id)
    
    {
        
        $record = Client::findOrFail($id);

        if($record->is_active =='1'){

            $record->update(['is_active' => '0']);
            $msg ="de-activate successfully";
            

        }else if($record->is_active =='0'){

            $record->update(['is_active' => '1']);
            $msg ="activate successfully";

        }

        flash()->success($msg);

        return redirect(route('client.index'));

    }

    
    
}

