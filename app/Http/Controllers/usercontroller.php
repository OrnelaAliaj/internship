<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\user;


class usercontroller extends Controller
{

    public function __construct()
    {
         $this->middleware('auth');
    }

    public function user()
    {
        return view('user.index');
    }

    
    /**
     * Display a listing of the resource.
     * 
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
    return view('user.index')->with(['user' => $user]);
        
        // $users = User::findOrFail($id);
        // return view('user.index', compact('users'));

        
    //     $auth = Auth::user()->id;
    // $users=\App\users::all()->whereNotIn('id',$auth);
    // $user = Users::find($id);
    // return view('user.index', compact('users')); 
        // $users = \App\User::all();
        // return view('user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    
    }

    **
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     public function store(Request $request)
    {
    //     $user = new user();
    //     $user->name=$request->name;
    //     $user->lastname=$request->lastname;
    //     $user->age=$request->age;
    //     $user->department=$request->department;
    //     $user->description=$request->description;
    //     if ($request->hasfile('image')){
    //         $file=$request->file('image');
    //         $extension=$file->getClientOriginalExtension();
    //         $filename=time(). '.' . $extension;
    //         $file->move('public/images',$filename);
    //         $user->image=$filename;
    //     }
    //     else{
    //         return $request;
    //         $user->image='';
    //     }
    //     $user->save();

    //         return view('/user');

     }
      
    //     $this->validate($request,[
    //    'name'=>'required:uses',
    //    'surname'=>'required:uses',
    //    'age'=>'required:uses',
    //    'department'=>'required:uses',
    //    'description'=>'required:uses',
    //    'image'=>'required:uses',

          
      

    //     ]);
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    //     $user = User::findOrFail($id);
    // return view ('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)

    {
         
        $item = user::find($id);
        
        
        //     if (auth()->user()->role_id !== 3) {
        //         return view('login');
        //     }
        // else{
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
        $user = user::find($id);
          $this->validate($request,[
         'name'=>'required:users',
         'lastname'=>'required:users',
         'age'=>'required:users',
         'department'=>'required:users',
         'description'=>'required:users',
         'image'=>'required:users'
        
            
        

          ]);
        
        $user->name=$request->name;
         $user->lastname=$request->lastname;
         $user->age=$request->age;
         $user->department=$request->department;
         $user->description=$request->description;
         $user->image=$request->image;
         if ($request->hasfile('image')){
            $file=$request->file('image');
            $extension=$file->getClientOriginalExtension();
            $filename=time(). '.' . $extension;
            $file->move('uploads/user/',$filename);
            $user->image=$filename;
        }
        // else{
        //     return $request;
        //     $user->image='';
        // }
        
         $user->save();
         session()->flash('message','Updated Succesfully');
        return redirect('user')->with('user', $user);
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
