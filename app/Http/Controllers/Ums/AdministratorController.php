<?php

namespace App\Http\Controllers\Ums;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use App\Models\User;
use App\Models\Customer;
use Session;
use Auth;
use Image;


class AdministratorController extends Controller
{

    public function __construct()
    {
        $this->middleware(['role:Administrator']);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('role', 'Administrator')->get();
        return view('administrator.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('administrator.create');
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
        	'name'  => 'required',
            'email' => 'required|email|unique:users',
            'photo' => 'required',
        ]);

        $user = new User();
       	$user->name     = $request->name;
        $user->email    = $request->email;
        $user->role     = 'Administrator';
        $user->password = bcrypt($request->password);

        if($request->hasFile('photo')){
        	$image_tmp = $request->file('photo');
            if ($image_tmp->isValid()) {
                $image_name = $image_tmp->getClientOriginalName();
                $extension = $image_tmp->getClientOriginalExtension();
                $image_new_name = $image_name.'-'.rand(111,99999).'.'.$extension;

                $original_image_path = 'assets/uploads/administrators/'.$image_new_name;
                
                Image::make($image_tmp)->save($original_image_path);
                
                $user->profile_photo_path = $image_new_name;
            }
        }

        $user->save(); 
        $user->assignRole('Administrator');       

        Session::flash('success', 'Administrator Added Successfully !');
        return redirect()->route('administrator.index');
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
        $user = User::find($id);
        return view('administrator.edit', compact('user'));
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
        	'name'  => 'required',
            'email' => 'required|email',
        ]);

        if(Auth::user()->id == 1 && Auth::user()->role == 'Administrator'){
            $check_user = User::where('email', $request->email)->first();
        
            if ($check_user) {

                $user = User::find($check_user->id);
           		$user->name = $request->name;
            	
                if($request->hasFile('photo')){
    	            $image_tmp = $request->file('photo');
    	            if ($image_tmp->isValid()) {
    	                $image_name = $image_tmp->getClientOriginalName();
    	                $extension = $image_tmp->getClientOriginalExtension();
    	                $image_new_name = $image_name.'-'.rand(111,99999).'.'.$extension;

    	                $original_image_path = 'assets/uploads/users/'.$image_new_name;
    	                
    	                Image::make($image_tmp)->save($original_image_path);
    	                
    	                $user->profile_photo_path = $image_new_name;
    	            }
    	        }

                $user->save();

                Session::flash('info', 'E-mail already exists. Other stuffs updated.');
                return redirect()->route('administrator.index');
            } else {

                $user = User::find($id);
           		$user->name     = $request->name;
           		$user->email    = $request->email;
            	
                if($request->hasFile('photo')){
    	            $image_tmp = $request->file('photo');
    	            if ($image_tmp->isValid()) {
    	                $image_name = $image_tmp->getClientOriginalName();
    	                $extension = $image_tmp->getClientOriginalExtension();
    	                $image_new_name = $image_name.'-'.rand(111,99999).'.'.$extension;

    	                $original_image_path = 'assets/uploads/users/'.$image_new_name;
    	                
    	                Image::make($image_tmp)->save($original_image_path);
    	                
    	                $user->profile_photo_path = $image_new_name;
    	            }
    	        }

                $user->save();

                Session::flash('info', 'Administrator Stuffs Updated Successfully !');
                return redirect()->route('administrator.index');
            }
        } else {
            abort(403);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        $user->delete();

        Session::flash('error', 'Administrator Deleted Successfully !');
        return redirect()->route('administrator.index');
    }

    /* public function ban_user(Request $request,$id)
    {
        $user = User::find($id);
        if($user->hasRole('Administrator')){
            $process_ban = $request->banned_until;
            $insert_ban = date('Y-m-d H:i:s', strtotime(' +'. $process_ban . ' day'));
            $user->banned_until  = $insert_ban;
            $user->banned_reason = $request->banned_reason;

            $user->save();

            Session::flash('error', 'User Deactivated Successfully !');
            return redirect()->route('administrator.index');
        } else {
            abort(403);
        }
    } */
}
