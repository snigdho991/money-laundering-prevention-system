<?php

namespace App\Http\Controllers\Ums;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use App\Models\User;
use App\Models\Agency;
use Session;
use Auth;

class AgencyController extends Controller
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
        $agencies = Agency::all();
        return view('agency.index', compact('agencies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('agency.create');
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
            'agency_name'  => 'required',
            'email'        => 'required|email|unique:users',
            'address'      => 'required',
            'city'         => 'required',
            'zip'          => 'required',
            'phone'        => 'required',
            'password'     => 'required',
        ]);

        $user = User::create([
            'name'     => $request->agency_name,
            'email'    => $request->email,
            'role'     => 'Agency',
            'password' => bcrypt($request->password),
        ]);

        $finduser = User::find($user->id);
        $finduser->assignRole('Agency');

        $agency = Agency::create([
            'user_id'          => $user->id,
            'administrator_id' => Auth::id(),
            'address'          => $request->address,
            'city'             => $request->city,
            'zip'              => $request->zip,
            'phone'            => $request->phone,
        ]);

        Session::flash('success', 'Agency Added Successfully !');
        return redirect()->route('agency.index');
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
        // $auth = Auth::user();
        $agency = Agency::find($id);

        /* if($agency) {
            if($auth->id == $agency->administrator_id){
                return view('agency.edit', compact('agency'));
            } else {
                abort(403);
            }
        } else {
            abort(403);
        } */

        return view('agency.edit', compact('agency'));

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
            'agency_name'  => 'required',
            'email'        => 'required|email',
            'address'      => 'required',
            'city'         => 'required',
            'zip'          => 'required',
            'phone'        => 'required',
        ]);

        $find_user = $request->email;
        $check_user = User::where('email', $find_user)->first();
        
        if ($check_user) {

            $agency = Agency::find($id);

            $check_user->name     = $request->agency_name;
            
            $agency->address = $request->address;
            $agency->city    = $request->city;
            $agency->zip     = $request->zip;
            $agency->phone   = $request->phone;

            $check_user->save();
            $agency->save();

            Session::flash('info', 'E-mail already exists. Other stuffs updated.');
            return redirect()->route('agency.index');

        } else {

            $agency_new = Agency::find($id);
            $up_user = User::find($agency_new->user_id);

            $up_user->name     = $request->agency_name;
            $up_user->email    = $request->email;
            
            $agency_new->address = $request->address;
            $agency_new->city    = $request->city;
            $agency_new->zip     = $request->zip;
            $agency_new->phone   = $request->phone;

            $up_user->save();
            $agency_new->save();

            Session::flash('info', 'Agency Stuffs Updated Successfully !');
            return redirect()->route('agency.index');
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
        
        $agency = Agency::findOrFail($id);
        $user_agency = User::findOrFail($agency->user_id);

        $user_agency->delete();
        $agency->delete();

        Session::flash('error', 'Agency Deleted Successfully !');
        return redirect()->route('agency.index');

    }
}
