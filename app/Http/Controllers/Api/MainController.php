<?php

namespace App\Http\Controllers\Api;
use Mail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Governorate;
use App\Models\City;
use App\Models\BloodType;
use App\Models\Post;
use App\Models\Setting;
use App\Models\Contact;
use App\Models\Category;
use App\Models\Notification;
use App\Mail\ContactUs;
use App\Models\Client;
use App\Models\DonationRequest;
use App\Models\Token;
use Illuminate\Support\Facades\Auth;

class MainController extends Controller
{
   
 

    public function governorates()
    {

     $governorates = Governorate::all();

     return responseJson('1','success',$governorates);

    }

    /////////////////////////////////////////////////////////

     public function categories()
    {

      $categories = Category::all();

      return responseJson('1','success',$categories);

    }

    /////////////////////////////////////////////////////////

      public function cities(Request $request )
    {

     $cities = City::where(function ($query) use($request){

      if($request->has('governorate_id'))

      {
       $query->where('governorate_id',$request->governorate_id);

      }

     })->get();

     return responseJson('1','success',$cities);

    }


    /////////////////////////////////////////////////////////

     public function bloodTypes()
    {

     $blood_types = BloodType::all();

     return responseJson('1','success',$blood_types);

    }

    /////////////////////////////////////////////////////////

     public function post(Request $request)
    {

     $post = Post::with('category')->find($request->id);

     return responseJson('1','success',$post);

    }

    /////////////////////////////////////////////////////////

     public function posts(Request $request )
    {

      $posts = Post::with('category')->where(function ($query) use($request){

        if(!empty($request->category_id))

        {
          $query->where('category_id',$request->category_id);

        }

        if(!empty($request->keyword))

        {
          $query->where(function ($query) use($request){
            $query->where('title','like','%'.$request->keyword.'%')
                  ->orWhere('body','like','%'.$request->keyword.'%');
          });
         
        }

      })->latest()->paginate('20');

      return responseJson('1','success',$posts);



    }

    //////////////////////////////////////////////////////////////

     public function myFavourites(Request $request)
    {

      $posts =$request->user()->posts()->with('category')->latest()->paginate('20');

      return responseJson('1','loaded....',$posts);

    }



     public function postToggleFavourite(Request $request)
    {

      $validator = validator()->make($request->all(),[

        'post_id' =>'required|exists:posts,id',
        
      ]);

     if($validator->fails())
      {
        $data = $validator->errors();
        return responseJson('0',$validator->errors()->first(),$data);

      }


      $toggle = $request->user()->posts()->toggle($request->post_id);

      return responseJson('1','success',$toggle);

    }

    /////////////////////////////////////////////////////////

      public function settings()
    {

     $settings = Setting::find(1);

     return responseJson('1','success',$settings);

    }

    /////////////////////////////////////////////////////////

   public function contactSaveData(Request $request)
   {


       $validator = validator()->make($request->all(),[
        'name' => 'required',
        'subject' => 'required',
        'phone' => 'required',
        'email' => 'required|email',
        'message' => 'required'
        ]);
 
       if($validator->fails())
      {
        $data = $validator->errors();
        return responseJson('0',$validator->errors()->first(),$data);

      }


      Contact::create($request->all()); 

      $data = array(
            'name' => $request->name,
           'email' => $request->email,
            'phone' => $request->phone,
           'subject' => $request->subject,
           'message' => $request->message
      );

      Mail::to('laravelemail2019@gmail.com')
               ->bcc('e.semsema27@yahoo.com')
               ->send(new ContactUs($data));

               return responseJson('1','Thanks for contacting us!');



    }

   /////////////////////////////////////////////////////////


   
  public function notifications(Request $request)
  {

    $notifications = $request->user()->notifications()->latest()->paginate(10);

    return responseJson('1','success',$notifications);

  }


   /////////////////////////////////////////////////////////


  public function  donationRequestCreate (Request $request)
  {
    $validator = validator()->make($request->all(),[

        'patient_name' =>'required',
        'age'=>'required', 
        'bags_num'=>'required',
        'hospital_name'=>'required',
        'phone'=>'required', 
        'city_id'=>'required',
        'notes'=>'required',
        'hospital_address'=>'required',
        'blood_type_id'=>'required',
        
      ]);

     if($validator->fails())
      {
        $data = $validator->errors();
        return responseJson('0',$validator->errors()->first(),$data);

      }

      $donationRequest = $request->user()->donation_requests()->create($request->all());


      //find clients to this order

      $clientsIds = $donationRequest->city->governorate
      ->clients()->whereHas('blood_types',function($query) use ($request,$donationRequest)
      {

          $query->where('blood_types.id',$donationRequest->blood_type_id);

      })->pluck('clients.id')->toArray();


    // dd($clientsIds);

    if(count($clientsIds))
    {
      //create notification on database

      $notifications = $donationRequest->notification()->create([

        'title' => 'there is donation request near you ',
        'content' =>$donationRequest->blood_type->name .' there is a blood type  that needs donation',

      ]);

      //attach clients to this notification 
      
      $notifications->clients()->attach($clientsIds);


      //get tokens for FCM(push notification using Firebase cloud)

      $tokens = Token::whereIn('client_id',$clientsIds)->where('token','!=','null')->pluck('token')->toArray();
     

      if(count($tokens))
      {
        $title = $notifications->title;
        $body = $notifications->content;
        $data =[

          'donation_request_id'=>$donationRequest->id,

        ];

        $send = notifyByFirebase($title,$body,$tokens,$data);

        
      }

    }

    return responseJson('1','Donation created successfully', compact('donationRequest'));

  }

  /////////////////////////////////////////////////////////////////////
  
  public function  donationRequests (Request $request)
  {


    $donationRequests = DonationRequest::where(function ($query) use($request){

        if(!empty($request->blood_type_id))

        {
          $query->where('blood_type_id',$request->blood_type_id);

        }

        if(!empty($request->city_id))

        {
          $query->where('city_id',$request->city_id);

        }

      })->latest()->paginate(10);

      return responseJson('1','success',$donationRequests);

    
  }

  ////////////////////////////////////////////////////////

    public function donationRequest(Request $request )
    {

      $donationRequest = DonationRequest::with('city','client','blood_type')->find($request->donation_id);
      //  dd($donationRequest);

      if(!$donationRequest)
      {
        return responseJson('0','404 no donation found');
      }

    
      if($request->user()->notifications()->where('donation_request_id',$donationRequest->id)->first())
      {

        $request->user()->notifications()->updateExistingPivot($donationRequest->notification->id,[

        'is_read' => '1'

        ]);

      }

      
      return responseJson('1','success',$donationRequest);

      
    }
  ///////////////////////////////////////////////////////////////////


  public function notificationsCount(Request $request)
  {
    
    $count = $request->user()->notifications()->where(function($query) use ($request){

      $query->where('is_read','0');

    })->count();

    return responseJson('1','loaded....',[

     'notifications-count' => $count,

    ]);

  }

  ////////////////////////////////////////////////////////////////




}


