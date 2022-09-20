<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\AccessToken;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Agency;
use App\Models\Customer;

use Carbon\Carbon;

use DB;
use Auth;
use Image;
use Session;

class AgencyToolsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role:Agency']);
    }

    public function agency_dashboard()
    {
    	$auth = Auth::user();
    	
		$all_transactions      = Transaction::where('agency_user_id', $auth->id)->get();
		
		$latest_transactions   = Transaction::where('agency_user_id', $auth->id)->latest()->get();
		$transaction_cheque   = Transaction::where('agency_user_id', $auth->id)->where('type', 'cheque')->latest()->count();
        $transaction_wire   = Transaction::where('agency_user_id', $auth->id)->where('type', 'wire-money')->latest()->count();

        $wire_transactions   = Transaction::where('agency_user_id', $auth->id)->where('type', 'wire-money')->latest()->get();
        $cheque_transactions   = Transaction::where('agency_user_id', $auth->id)->where('type', 'cheque')->latest()->get();


    	$total_amount    = Transaction::select('*')
                                      ->where('agency_user_id', $auth->id)
                                      ->sum('amount');
        $cheque_amount  = Transaction::select('*')
                                      ->where('agency_user_id', $auth->id)
                                      ->where('type', 'cheque')
                                      ->sum('amount');
        $wire_amount = Transaction::select('*')
                                      ->where('agency_user_id', $auth->id)
                                      ->where('type', 'wire-money')
                                      ->sum('amount');
        
        return view('agency-index', compact('all_transactions', 'wire_transactions', 'cheque_transactions', 'total_amount', 'cheque_amount', 'wire_amount', 'latest_transactions', 'transaction_cheque', 'transaction_wire', 'auth'));
    }

    public function search_customer_by_phone(Request $request)
    {
    	$auth = Auth::user();
    	$customer_phone = $request->get('customer_phone');
        
        $agency = Agency::where('user_id', $auth->id)->first();
        $customer  = Customer::where('phone', $customer_phone)->where('agency_user_id', $auth->id)->first();

        if($customer){
            $customer_wire_transactions      = Transaction::where('agency_user_id', $auth->id)->where('customer_id', $customer->id)->where('type', 'wire-money')->whereMonth('created_at', Carbon::now()->month)->whereYear('created_at', Carbon::now()->year)->get();
            $total_amount = Transaction::select('*')
                          ->where('agency_user_id', $auth->id)
                          ->where('customer_id', $customer->id)
                          ->where('type', 'wire-money')
                          ->whereMonth('created_at', Carbon::now()->month)
                          ->whereYear('created_at', Carbon::now()->year)
                          ->sum('amount');

            return view('customer.search-phone', compact('customer', 'agency', 'customer_phone', 'customer_wire_transactions', 'total_amount'));
        }

        return view('customer.search-phone', compact('customer', 'agency', 'customer_phone'));
    }

    public function change_agency_logo()
    {
    	$auth = Auth::user();
    	$find_logo = Agency::where('user_id', $auth->id)->first();
    	return view('app-settings.agency-logo', compact('find_logo'));
    }

    public function upload_agency_logo(Request $request)
    {
    	$this->validate($request, [
        	'logo'  => 'required',
        ]);

        $auth = Auth::user();

    	if ($request->hasFile('logo')) {
            $image_tmp = $request->file('logo');
            if ($image_tmp->isValid()) {
                $image_name = $image_tmp->getClientOriginalName();
                $extension = $image_tmp->getClientOriginalExtension();
                $image_new_name = $image_name.'-'.rand(111,99999).'.'.$extension;

                $original_image_path = 'assets/uploads/agency-logo/'.$image_new_name;
                
                Image::make($image_tmp)->save($original_image_path);
                
                DB::table('agencies')->where('user_id', $auth->id)->update(array(
                    'logo' => $image_new_name,
				));
            }
        }

        Session::flash('success', 'Agency Logo Updated Successfully!');
        return redirect()->route('agency.index');
    }

    public function set_monthly_limit(Request $request)
    {
        $auth = Auth::user();
        $agency = Agency::where('user_id', $auth->id)->first();

        return view('app-settings.agency-monthly-limit', compact('agency'));
    }

    public function update_monthly_limit(Request $request)
    {
        $this->validate($request, [
            'monthly_limit'  => 'required',
        ]);

        $auth = Auth::user();
        $agency = Agency::where('user_id', $auth->id)->first();

        $agency->monthly_limit = $request->monthly_limit;
        $agency->save();

        Session::flash('success', 'Monthly Limit Updated Successfully!');
        return redirect()->back();
    }
}
