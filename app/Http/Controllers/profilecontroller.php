<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\profile;

class profilecontroller extends Controller
{

    public function profile()
    {
    return view('user.index');

    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $profiles=profile::all();
        return view('user.index', compact('profiles'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $profiles=profile::all();
        // return view('user.index');// compact('profiles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $profile = new profile;
          $this->validate($request,[
        'name'=>'required:profiles',
        'surname'=>'required:profiles',
        'age'=>'required:profiles',
        'department'=>'required:profiles',
        'description'=>'required:profiles',

            
        

          ]);
        
        $profile->name=$request->name;
        $profile->surname=$request->surname;
        $profile->age=$request->age;
        $profile->department=$request->department;
        $profile->description=$request->description;
        $profile->save();
        // return redirect('user');
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
        $item = profile::find($id);
        return view('user.edit', compact('item'));
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
        $profile = profile::find($id);
        $profile = new profile;
          $this->validate($request,[
         'name'=>'required:profiles',
         'surname'=>'required:profiles',
         'age'=>'required:profiles',
         'department'=>'required:profiles',
         'description'=>'required:profiles',
         'image'=>'required:profiles',

            
        

          ]);
        
        $profile->name=$request->name;
         $profile->surname=$request->surname;
         $profile->age=$request->age;
         $profile->department=$request->department;
         $profile->description=$request->description;
         if ($request->hasfile('image')){
            $file=$request->file('image');
            $extension=$file->getClientOriginalExtension();
            $filename=time(). '.' . $extension;
            $file->move('public/images/',$filename);
            $profile->image=$filename;
        }
        else{
            return $request;
            $profile->image='';
        }
        $profile->save();

            return view('/user');

     }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
