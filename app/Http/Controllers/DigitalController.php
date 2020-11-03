<?php

namespace App\Http\Controllers;
use App\Digital; //connection to Digital model
use Illuminate\Http\Request;

class DigitalController extends Controller
{

    public function __construct()
    {
        $this->middleware('role:administrator'); //functions of this controller are accessed only by user with admin role
        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $digitals =new digital;


        if(request()->has('position')){
        $digitals=$digitals->where('position',request('position'));
        }
        if(request()->has('sort')){        
        $digitals=$digitals->orderBy('name',request('sort'));
        }
        $digitals=$digitals->paginate(5)->appends([
        'position'=> request('position'),
        'sort' => request('sort'),
        ]);
         return view('digital.home')->with('digitals', $digitals); //filtering and sorting
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('digital.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $digital = new digital;
        $this->validate($request,[
            'name'=>'required|unique:digitals',
            'surname'=>'required:digitals',
            'age'=>'required:digitals',
            'position'=>'required:digitals',
            
                                                //stores the data that user enters when creting new employee
                                                //and in the end redirects to home page

        ]);
        $digital->id=$request->id;
        $digital->name=$request->name;
        $digital->surname=$request->surname;
        $digital->age=$request->age;
        $digital->position=$request->position;
        $digital->save();
        return redirect('digital');
    

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = digital::find($id);
        return view('digital.edit', compact('item'));   //takes user to edit page to edit the chosen object by id

        
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
        $digital = digital::find($id);
        $this->validate($request,[
            'name'=>'required:digitals',
            'surname'=>'required:digitals',
            'age'=>'required:digitals',
            'position'=>'required:digitals',
            
        
        ]);                                     //takes the data from edit page and updates it in database, then
                                                //prints it in home of digital view
     
        $digital->name=$request->name;
        $digital->surname=$request->surname;
        $digital->age=$request->age;
        $digital->position=$request->position;
        $digital->save();
        session()->flash('message','Updated Succesfully');
        return redirect('digital');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item=digital::find($id);
        $item->delete();
        session()->flash('message','Deleted Successfully');
        return redirect('/digital');
                                                //deletes the data taken by it's id
    }
}
