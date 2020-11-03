<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\employee;



class employeecontroller extends Controller
{
    public function __construct()
    {
        $this->middleware('role:administrator');
    }
    
    public function employee()
    {

        return view('employee.home');
    }     

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    // public function __construct()
    // {
    //     $this->middleware('role:administrator');
        
    // }
    public function index()
    
    {
        
         $employees =new employee;


        if(request()->has('position')){
        $employees=$employees->where('position',request('position'));
        }
        if(request()->has('sort')){        
        $employees=$employees->orderBy('name',request('sort'));
        }
        $employees=$employees->paginate(5)->appends([
        'position'=> request('position'),
        'sort' => request('sort'),
        ]);
         return view('employee.home') ->with('employees', $employees);
    }

    //      if(request()->has('position')){
    //         $employees=employee::where('position', request('position'))
    //          ->paginate(5)->appends('position', request('position'));
        
    //      }
    //      else if (request()->has('sort')) {

    //         $employees=employee::orderBy('name' ,request('sort'))->paginate(5)
    //         ->appends('sort', request('sort'));;

    //      }
    //      else



    //     $employees=employee::paginate(5);
        
        
    //        return view('employee.home')->with('employees', $employees);
            
    
    // }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('employee.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $employee = new employee;
        $this->validate($request,[
            'name'=>'required|unique:employees',
            'surname'=>'required:employees',
            'age'=>'required:employees',
            'position'=>'required:employees',
            
        

        ]);
        $employee->id=$request->id;
        $employee->name=$request->name;
        $employee->surname=$request->surname;
        $employee->age=$request->age;
        $employee->position=$request->position;
        $employee->save();
        session()->flash('message','Created Succesfully');
        return redirect('employee');
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
        $item = employee::find($id);
        return view('employee.edit', compact('item'));
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
        $employee = employee::find($id);
        $this->validate($request,[
            'name'=>'required:employees',
            'surname'=>'required:employees',
            'age'=>'required:employees',
            'position'=>'required:employees',
            
        
        ]);
       // $employee->id=$request->id;
        $employee->name=$request->name;
        $employee->surname=$request->surname;
        $employee->age=$request->age;
        $employee->position=$request->position;
        $employee->save();
        session()->flash('message','Updated Succesfully');
        return redirect('employee');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item=employee::find($id);
        $item->delete();
        session()->flash('message','Deleted Successfully');
        return redirect('/employee');
    }
}
