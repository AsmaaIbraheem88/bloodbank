<?php

namespace App\Http\Controllers\Api;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Governorate;
use Mail;
use App\Mail\ResetPassword;
use App\Models\Token;


use Illuminate\Validation\Rule;

use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
     public function register(Request $request )

     {

      //return $request->all();

      $validator = validator()->make($request->all(),[

       'name' =>'required',
       'email'=>'required|unique:clients', 
       'date_of_birth'=>'required',
       'blood_type_id'=>'required', 
       'city_id'=>'required', 
       'last_donation_date'=>'required', 
       'phone'=>'required',
       'password'=>'required|confirmed', 
       

      ]);

       if($validator->fails())
      {
        $data = $validator->errors();
        return responseJson('0',$validator->errors()->first(),$data);

      }

      $request->merge(['password'=>bcrypt($request->password)]);
      $client = Client::create($request->all());
      $client->api_token = str_random('60');
      $client->save();
      return responseJson('1','you added successfully',[

       'api_token'=>$client->api_token,
       'client'=>$client

      ]);

    }


    /////////////////////////////////////////////////////////////////

    public function login(Request $request )

    {

      // return $request->all();

      $validator = validator()->make($request->all(),[

       'phone'=>'required',
       'password'=>'required', 
       

      ]);

       if($validator->fails())
      {
        $data = $validator->errors();
        return responseJson('0',$validator->errors()->first(),$data);

      }

      $client = Client::where('phone',$request->phone)->first();
      if($client)
      {
       
       if(Hash::check($request->password,$client->password))
       {

        //Check if client active or no 
        
        if( $client->is_active == 0)
        {
          return responseJson('0','you are unactive  ');
        }
        
        return responseJson('1','you are login',[

         'api_token' =>$client->api_token,
         'client' =>$client

        ]);
       }else
       {
        return responseJson('invalid data');
       }
      }else
      {
       return responseJson('0','invalid data');
      }

    }


    /////////////////////////////////////////////////////////////////

     public function resetPassword(Request $request )
     {
          $user = Client::where('phone',$request->phone)->first();

         if($user)
         {

          $code =rand('1111','9999');

          $update = $user->update(['pin_code' => $code]);

          if($update)
          {
               Mail::to($user->email)
               ->bcc('e.semsema27@yahoo.com')
               ->send(new ResetPassword($code));

               return responseJson('1','please check your phone', $user->pin_code);

          }

         }
     }

    
    /////////////////////////////////////////////////////////////////

     public function changePassword(Request $request )
     {


          $validator = validator()->make($request->all(),[

               'pin_code'=>'required',
               'phone'=>'required',
               'password'=>'required|confirmed', 
               

          ]);

          if($validator->fails())
          {
              $data = $validator->errors();
               return responseJson('0',$validator->errors()->first(),$data);

          }

          // $user = Client::where('phone',$request->phone)
          //                ->where('pin_code',$request->pin_code)
          //                ->where('pin_code','!=','0')->first();


           $user = Client::where('phone',$request->phone)
                          ->where('pin_code',$request->pin_code)
                         ->where('pin_code','!=','null')->first();

          
          if($user)

          {
               $user->password = bcrypt($request->password);
               
               $user->pin_code = null;

               $user->save();
               
               if($user->save())
               {
                     return responseJson('1','password change successfully ');
               }else
               {
                     return responseJson('0','something wrong');
               }

          }else
          {
               return responseJson('0','in valid data');
          }


     }


     /////////////////////////////////////////////////////////////////

      public function profile(Request $request )
      {
        

        $validator = validator()->make($request->all(),[
          'name' =>'required',
          'email'=>[Rule::unique('clients')->ignore($request->user()->id),'required']  ,
          'phone'=>[Rule::unique('clients')->ignore($request->user()->id),'required']  ,
          'password'=>'confirmed', 
        

        ]);

     
      if($validator->fails())
      {
          $data = $validator->errors();
          return responseJson('0',$validator->errors()->first(),$data);

      }


      $LoginUser = $request->user();

      $LoginUser->name = $request->name;
      $LoginUser->email = $request->email;
      $LoginUser->phone = $request->phone;

      $LoginUser->update($request->all());

      if($request->has('password'))
      {

        $LoginUser->password = bcrypt($request->password);

      }

      $LoginUser->save();

      $data = [

        'client' =>$request->user()->fresh()->load('city.governorate','blood_type')

      ];


       return responseJson('1','data updated successfully ',$data);



    }

/////////////////////////////////////////////////////////////////////////

    public function notificationsSettings(Request $request)
    {

     

      if($request->input('action') == 'save')

      {
        
        $validator = validator()->make($request->all(),[

          'governorates.*'=>'exists:governorates,id',
          'blood_types.*'=>'exists:blood_types,id',
         
   
        ]);
   
        if($validator->fails())
        {
             $data = $validator->errors();
             return responseJson('0',$validator->errors()->first(),$data);
   
        }

        
          $request->user()->governorates()->sync($request->governorates);
        
  
          $request->user()->blood_types()->sync($request->blood_types);
       

      }

     
      $data=[

        'governorates' => $request->user()->governorates()->pluck('governorates.id')->toArray(),
        
        'blood_types' => $request->user()->blood_types()->pluck('blood_types.id')->toArray(),


      ];

       return responseJson('1','data updated successfully',$data);

    }

    
    ////////////////////////////////////////////////////////////////

  public function registerToken(Request $request )
  {

    $validator = validator()->make($request->all(),[

      'token'=>'required',  
      'type'=>'required|in:android,ios', 

    ]);

     if($validator->fails())
      {
          $data = $validator->errors();
          return responseJson('0',$validator->errors()->first(),$data);

      }

     

      Token::where('token',$request->token)->delete();

      // Token::create([

      //   'token' => '',
      //   'type' => '',
      //   'client_id' =>  $request->user()->id

      // ]);

      $request->user()->tokens()->create($request->all());


       return responseJson('1','Token created successfully  ');


  } 
  ///////////////////////////////////////////////////////////////////// 

  public function removeToken(Request $request )
  {

    $validator = validator()->make($request->all(),[

      'token'=>'required',  
      

    ]);

     if($validator->fails())
      {
          $data = $validator->errors();
          return responseJson('0',$validator->errors()->first(),$data);

      }

     

      Token::where('token',$request->token)->delete();



       return responseJson('1','deleted successfully');


  } 

  ///////////////////////////////////////////////////////////////



}
