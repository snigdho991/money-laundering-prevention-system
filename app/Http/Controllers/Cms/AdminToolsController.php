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

use Illuminate\Support\Facades\Mail;

use DB;
use Session;
use Auth;
use Image;

class AdminToolsController extends Controller
{
	
	public function __construct()
    {
        $this->middleware(['role:Administrator']);
    }

    public function dashboard()
    {
        $all_transactions      = Transaction::all();
        
        $transaction_cheque    = Transaction::where('type', 'cheque')->latest()->count();
        $transaction_wire      = Transaction::where('type', 'wire-money')->latest()->count();

        $wire_transactions     = Transaction::where('type', 'wire-money')->latest()->get();
        $cheque_transactions   = Transaction::where('type', 'cheque')->latest()->get();


        $total_amount   = Transaction::select('*')
                                      ->sum('amount');
        $cheque_amount  = Transaction::select('*')
                                      ->where('type', 'cheque')
                                      ->sum('amount');
        $wire_amount    = Transaction::select('*')
                                      ->where('type', 'wire-money')
                                      ->sum('amount');
        
        return view('index', compact('all_transactions', 'wire_transactions', 'cheque_transactions', 'total_amount', 'cheque_amount', 'wire_amount', 'transaction_cheque', 'transaction_wire'));
    }

    public function apps_settings()
    {
    	$find_logo = DB::table('site_settings')->find(1);
    	return view('app-settings.settings', compact('find_logo'));
    }

    public function upload_logo(Request $request)
    {
    	$this->validate($request, [
        	'logo'  => 'required',
        ]);

    	if ($request->hasFile('logo')) {
            $image_tmp = $request->file('logo');
            if ($image_tmp->isValid()) {
                $image_name = $image_tmp->getClientOriginalName();
                $extension = $image_tmp->getClientOriginalExtension();
                $image_new_name = $image_name.'-'.rand(111,99999).'.'.$extension;

                $original_image_path = 'assets/uploads/logo/'.$image_new_name;
                
                Image::make($image_tmp)->save($original_image_path);
                
                DB::table('site_settings')->where('id', 1)->update(array(
                    'logo' => $image_new_name,
				));
            }
        }

        Session::flash('success', 'Logo Updated Successfully!');
        return redirect()->route('apps.settings');
    }

    public function ban_user(Request $request, $id)
    {
        $user = User::find($id);
        // ban for days
        if($request->banned_until == 0){
            $user->banned_until = 0;
        } else {
            $user->banned_until = Carbon::now()->addDays($request->banned_until);
        }

        $user->banned_reason = $request->banned_reason;
        $user->save();

        sleep(2);
        Session::flash('warning', 'Agency Deactivated Successfully !');
        return redirect()->back();
    }

    public function unban_user(Request $request, $id)
    {
        $user = User::find($id);
        $user->banned_until  = null;
        $user->banned_reason = null;
        $user->save();

        Session::flash('success', 'Agency Activated Again Successfully !');
        return redirect()->back();
    }

    public function send_email()
    {
        return view('app-settings.send-email-all');
    }

    public function email_to_agencies(Request $request)
    {
        $this->validate($request, [
            'email_subject'  => 'required',
            'email_body'     => 'required',
        ]);

        $details = [
            'title' => $request->email_subject,
            'body' => $request->email_body,
        ];

        $recipients = [];

        $agencies = User::where('role', 'Agency')->get();

        foreach ($agencies as $agency) {
            $recipients[] = $agency->email;
        }

        foreach ($recipients as $recipient) {
            Mail::to($recipient)->send(new \App\Mail\EmailAgency($details));
        }

        Session::flash('success', 'Email Sent Successfully!');
        return redirect()->route('dashboard');
    }
}
