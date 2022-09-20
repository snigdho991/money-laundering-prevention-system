<?php

namespace App\Http\Controllers\Ums;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Customer;
use Session;
use Auth;
use Image;

class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role:Agency']);
    }

	public function index()
    {
        $customers = Customer::where('agency_user_id', Auth::id())->get();
        return view('customer.index', compact('customers'));
    }

    public function create()
    {
        return view('customer.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name'             => 'required',
            'email'            => 'email|unique:customers',
            'phone'            => 'required|numeric|min:5',
            'id1'              => 'required',
            'id2'              => 'required',
            'id3'              => 'required',
        ]);


        $customer = new Customer();
       	$customer->agency_user_id   = Auth::id();
        $customer->name             = $request->name;
        $customer->email            = $request->email;
        $customer->address          = $request->address;
        $customer->phone            = $request->phone;
        $customer->customer_company = $request->customer_company;

        if($request->hasFile('photo')){
        	$image_tmp = $request->file('photo');
            if ($image_tmp->isValid()) {
                $image_name = $image_tmp->getClientOriginalName();
                $extension = $image_tmp->getClientOriginalExtension();
                $image_new_name = $image_name.'-'.rand(111,99999).'.'.$extension;

                $original_image_path = 'assets/uploads/customer/'.$image_new_name;
                
                Image::make($image_tmp)->save($original_image_path);
                
                $customer->photo = $image_new_name;
            }
        }

        if($request->hasFile('id1')){
            $image_tmp = $request->file('id1');
            if ($image_tmp->isValid()) {
                $image_name = $image_tmp->getClientOriginalName();
                $extension = $image_tmp->getClientOriginalExtension();
                $image_new_name = $image_name.'-'.rand(111,99999).'.'.$extension;

                $original_image_path = 'assets/uploads/customer/id1/'.$image_new_name;
                
                Image::make($image_tmp)->save($original_image_path);
                
                $customer->id1 = $image_new_name;
            }
        }

        if($request->hasFile('id2')){
            $image_tmp = $request->file('id2');
            if ($image_tmp->isValid()) {
                $image_name = $image_tmp->getClientOriginalName();
                $extension = $image_tmp->getClientOriginalExtension();
                $image_new_name_two = $image_name.'-'.rand(111,99999).'.'.$extension;

                $original_image_path = 'assets/uploads/customer/id2/'.$image_new_name_two;
                
                Image::make($image_tmp)->save($original_image_path);
                
                $customer->id2 = $image_new_name_two;
            }
        }

        if($request->hasFile('id3')){
            $image_tmp = $request->file('id3');
            if ($image_tmp->isValid()) {
                $image_name = $image_tmp->getClientOriginalName();
                $extension = $image_tmp->getClientOriginalExtension();
                $image_new_name_three = $image_name.'-'.rand(111,99999).'.'.$extension;

                $original_image_path = 'assets/uploads/customer/id3/'.$image_new_name_three;
                
                Image::make($image_tmp)->save($original_image_path);
                
                $customer->id3 = $image_new_name_three;
            }
        }

        $customer->save();        

        Session::flash('success', 'Customer Added Successfully !');
        return redirect()->route('customer.index');
    }

    public function edit($id)
    {
        $auth = Auth::user();
        $customer = Customer::find($id);

        if($customer) {
            if($auth->id == $customer->agency_user_id){
                return view('customer.edit', compact('customer'));
            } else {
                abort(403);
            }
        } else {
            abort(403);
        }
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name'             => 'required',
            'email'            => 'email',
            'phone'            => 'required|numeric|min:5',
        ]);

        $check_customer = Customer::where('email', $request->email)->first();
        
        if ($check_customer) {

            $customer = Customer::find($check_customer->id);
       		$customer->name             = $request->name;
	        $customer->address          = $request->address;
	        $customer->phone            = $request->phone;
	        $customer->customer_company = $request->customer_company;
        	
            if($request->hasFile('photo')){
	            $image_tmp = $request->file('photo');
	            if ($image_tmp->isValid()) {
	                $image_name = $image_tmp->getClientOriginalName();
	                $extension = $image_tmp->getClientOriginalExtension();
	                $image_new_name = $image_name.'-'.rand(111,99999).'.'.$extension;

	                $original_image_path = 'assets/uploads/customer/'.$image_new_name;
	                
	                Image::make($image_tmp)->save($original_image_path);
	                
	                $customer->photo = $image_new_name;
	            }
	        }

            if($request->hasFile('id1')){
                $image_tmp = $request->file('id1');
                if ($image_tmp->isValid()) {
                    $image_name = $image_tmp->getClientOriginalName();
                    $extension = $image_tmp->getClientOriginalExtension();
                    $image_new_name = $image_name.'-'.rand(111,99999).'.'.$extension;

                    $original_image_path = 'assets/uploads/customer/id1/'.$image_new_name;
                    
                    Image::make($image_tmp)->save($original_image_path);
                    
                    $customer->id1 = $image_new_name;
                }
            }

            if($request->hasFile('id2')){
                $image_tmp = $request->file('id2');
                if ($image_tmp->isValid()) {
                    $image_name = $image_tmp->getClientOriginalName();
                    $extension = $image_tmp->getClientOriginalExtension();
                    $image_new_name_two = $image_name.'-'.rand(111,99999).'.'.$extension;

                    $original_image_path = 'assets/uploads/customer/id2/'.$image_new_name_two;
                    
                    Image::make($image_tmp)->save($original_image_path);
                    
                    $customer->id2 = $image_new_name_two;
                }
            }

            if($request->hasFile('id3')){
                $image_tmp = $request->file('id3');
                if ($image_tmp->isValid()) {
                    $image_name = $image_tmp->getClientOriginalName();
                    $extension = $image_tmp->getClientOriginalExtension();
                    $image_new_name_three = $image_name.'-'.rand(111,99999).'.'.$extension;

                    $original_image_path = 'assets/uploads/customer/id3/'.$image_new_name_three;
                    
                    Image::make($image_tmp)->save($original_image_path);
                    
                    $customer->id3 = $image_new_name_three;
                }
            }
            
            $customer->save();

            Session::flash('info', 'E-mail is already used! Other stuffs updated.');
            return redirect()->route('customer.index');

        } else {

            $customer = Customer::find($id);
       		$customer->name             = $request->name;
	        $customer->email            = $request->email;
	        $customer->address          = $request->address;
	        $customer->phone            = $request->phone;
	        $customer->customer_company = $request->customer_company;
        	
            if ($request->hasFile('photo')) {
	            $image_tmp = $request->file('photo');
	            if ($image_tmp->isValid()) {
	                $image_name = $image_tmp->getClientOriginalName();
	                $extension = $image_tmp->getClientOriginalExtension();
	                $image_new_name = $image_name.'-'.rand(111,99999).'.'.$extension;

	                $original_image_path = 'assets/uploads/customer/'.$image_new_name;
	                
	                Image::make($image_tmp)->save($original_image_path);
	                
	                $customer->photo = $image_new_name;
	            }
	        }

            if($request->hasFile('id1')){
                $image_tmp = $request->file('id1');
                if ($image_tmp->isValid()) {
                    $image_name = $image_tmp->getClientOriginalName();
                    $extension = $image_tmp->getClientOriginalExtension();
                    $image_new_name = $image_name.'-'.rand(111,99999).'.'.$extension;

                    $original_image_path = 'assets/uploads/customer/id1/'.$image_new_name;
                    
                    Image::make($image_tmp)->save($original_image_path);
                    
                    $customer->id1 = $image_new_name;
                }
            }

            if($request->hasFile('id2')){
                $image_tmp = $request->file('id2');
                if ($image_tmp->isValid()) {
                    $image_name = $image_tmp->getClientOriginalName();
                    $extension = $image_tmp->getClientOriginalExtension();
                    $image_new_name_two = $image_name.'-'.rand(111,99999).'.'.$extension;

                    $original_image_path = 'assets/uploads/customer/id2/'.$image_new_name_two;
                    
                    Image::make($image_tmp)->save($original_image_path);
                    
                    $customer->id2 = $image_new_name_two;
                }
            }

            if($request->hasFile('id3')){
                $image_tmp = $request->file('id3');
                if ($image_tmp->isValid()) {
                    $image_name = $image_tmp->getClientOriginalName();
                    $extension = $image_tmp->getClientOriginalExtension();
                    $image_new_name_three = $image_name.'-'.rand(111,99999).'.'.$extension;

                    $original_image_path = 'assets/uploads/customer/id3/'.$image_new_name_three;
                    
                    Image::make($image_tmp)->save($original_image_path);
                    
                    $customer->id3 = $image_new_name_three;
                }
            }

            $customer->save();

            Session::flash('info', 'Customer Stuffs Updated Successfully !');
            return redirect()->route('customer.index');
        }
    }

    public function destroy($id)
    {
        
        $customer = Customer::findOrFail($id);
        $customer->delete();

        Session::flash('error', 'Customer Deleted Successfully !');
        return redirect()->route('customer.index');

    }
}
