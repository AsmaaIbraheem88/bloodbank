<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use App\User;
use Hash;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        $records = User::paginate(20);
        return view('backend.users.index',compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    
        $this->validate($request, [
            'name' =>'required',
            'email'=>'required|unique:users', 
            'password'=>'required|confirmed', 
            // 'roles_list'=>'required',
        ]);


        $request->merge(['password'=>bcrypt($request->password)]);
 
        $record = User::create($request->except('roles_list'));

        $record->roles()->attach($request->roles_list);

        flash()->success('User created successfully');

        // return back();
        return redirect(route('user.index'));
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
        $model = User::findOrFail($id);

        return view('backend.users.edit',compact('model'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' =>'required',
            'email' => [
                'required',
                 Rule::unique('users')->ignore($id),
            ],
            'password'=>'confirmed', 
            // 'roles_list'=>'required',
        ]);

        $record = User::findOrFail($id);

        $record->name = $request->name;
        $record->email = $request->email;


        if(!empty($request->password))
        {

            $record->password = bcrypt($request->password);

        }

        $record->roles()->sync((array)$request->roles_list);

        $record->save();

        flash()->success('User updated successfully');

        return redirect(route('user.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $record = User::findOrFail($id);
        $record->delete();

        flash()->success('User deleted successfully');

        return redirect(route('user.index'));
    }

    public function changePassword()
    {
        $model = auth()->user();

        return view('backend.users.change_password',compact('model'));
    }

    public function changePasswordSave(Request $request)
    {
        $this->validate($request, [
            'password'=>'required|confirmed', 
            'old_password'=>'required',
        ]);

        
        $user =auth()->user();

        if(Hash::check($request->input('old_password') , $user->password))
        {

            $user->password = bcrypt($request->password);
               
            $user->save();

            flash()->success('password changed ');

            return back();

        }else{

            flash()->error('password not valid');

            return back();
        }

       

       
      

       

        // return redirect(route('user.index'));
    }




}
