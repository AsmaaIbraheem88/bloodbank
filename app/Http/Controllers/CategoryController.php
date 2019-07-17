<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records = Category::paginate(20);
        return view('backend.categories.index',compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.categories.create');
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
            'name'=>'required'
        ];

        $message = [
            'name.required'=>' Name Is Required'
        ];

        $this->validate($request, $rules,$message);

        $record = Category::create($request->all());

        flash()->success(' Category created successfully');

        // return back();
        return redirect(route('category.index'));
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
        $model = Category::findOrFail($id);

        if(!$model)
        {
            flash()->error('There Is No Data  ');
        }

        return view('backend.categories.edit',compact('model'));
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
            'name'=>'required'
        ];

        $message = [
            'name.required'=>' Name Is Required'
        ];

        $this->validate($request, $rules,$message);

        $record = Category::findOrFail($id);
        
        $record->update($request->all());

        flash()->success('Category updated successfully');

        return redirect(route('category.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $record = Category::findOrFail($id);

      
        if($record->posts()->count())
        {
          flash()->error('This Category Has posts  ');
        }
        $record->delete();

        flash()->success('Category deleted successfully');

        return redirect(route('category.index'));
    }
}
