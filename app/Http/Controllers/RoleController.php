<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use App\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records = Role::paginate(20);
        return view('backend.roles.index',compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.roles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $rules = [
            'name'=>'required|unique:roles',
            'display_name'=>'required',
            'permissions_list'=>'required',
            
        ];

        $message = [
            'name.required'=>' Name Is Required',
            'name.unique'=>'This Name Exist',
            'display_name.required'=>' Display Name Is Required',
            'permissions_list.required'=>' permissions_list Is Required',
            
        ];

        $this->validate($request, $rules,$message);

        $record = Role::create($request->all());

        $record->permissions()->attach($request->permissions_list);

        flash()->success('Role created successfully');

        // return back();
        return redirect(route('role.index'));
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
        $model = Role::findOrFail($id);

        return view('backend.roles.edit',compact('model'));
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
        $rules = [

            'name' => [
                'required',
                 Rule::unique('roles')->ignore($id),
            ],
            'display_name'=>'required',
            'permissions_list'=>'required',
            
        ];

        $message = [
            'name.required'=>' Name Is Required',
            'name.unique'=>'This Name Exist',
            'display_name.required'=>' Display Name Is Required',
            'permissions_list.required'=>' permissions_list Is Required',
            
        ];

        $this->validate($request, $rules,$message);

        $record = Role::findOrFail($id);

        $record->update($request->all());

        $record->permissions()->sync($request->permissions_list);

        flash()->success('Role updated successfully');

        return redirect(route('role.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $record = Role::findOrFail($id);

       
        if($record->users()->count())
        {
          flash()->error('This Role Has users  ');
        }
        $record->delete();

        flash()->success('Role deleted successfully');

        return redirect(route('role.index'));
    }
}
