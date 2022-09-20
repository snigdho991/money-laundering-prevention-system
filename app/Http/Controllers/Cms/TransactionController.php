<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\AccessToken;
use App\Models\Customer;
use App\Models\Transaction;
use App\Models\User;

use Auth;
use Image;
use Session;

class TransactionController extends Controller
{

	public function __construct()
    {
        $this->middleware(['role:Agency'])->except(['manage_transaction']);
    }

    public function getstarted($id)
    {
    	$customer = Customer::find($id);
    	if($customer){

    		$auth = Auth::id();

	        // CHECK
	        $find_token = AccessToken::where('user_id', Auth::id())->where('type', 'cheque')->where('customer_id', $id)->where('status', 0)->latest()->first();
	        if (!$find_token) {

	            $key = md5(rand(1, 10) . microtime()) . $auth;        
	            AccessToken::create([
	                'user_id'      => Auth::id(),
	                'customer_id'  => $id,
	                'access_token' => $key,
	                'type'         => 'cheque',
	                'status'       => 0,
	            ]);

	        } else {
	            $key = $find_token->access_token;
	        }
	        // END CHECK


	        // WIRE MONEY
	        $find_wiretoken = AccessToken::where('user_id', Auth::id())->where('type', 'wire-money')->where('customer_id', $id)->where('status', 0)->latest()->first();
	        if(!$find_wiretoken){

	            $wire_key = $auth . md5(rand(1, 10) . microtime());
	            AccessToken::create([
	                'user_id'      => Auth::id(),
	                'customer_id'  => $id,
	                'access_token' => $wire_key,
	                'type'         => 'wire-money',
	                'status'       => 0,
	            ]);

	        } else {
	            $wire_key = $find_wiretoken->access_token;
	        }
	        // END WIRE MONEY

	    	return view('transaction.get-started', compact('key', 'wire_key', 'id', 'customer'));
	    } else {
	    	abort(404);
	    }
    }

    public function cheque(Request $request, $id)
    {
        $find_token = $request->get('accessToken');
        
        if(url()->full() != url('transaction/'.$id.'/cheque?accessToken='.$find_token)){
            abort('403');
        } else {
            $find_security = AccessToken::where('user_id', Auth::id())->where('type', 'cheque')->where('customer_id', $id)->where('status', 0)->where('access_token', $find_token)->first();
            if(!$find_security){
                abort('404');
            } else {
                $find_security->status = 1;
                $find_security->save();
                return view('transaction.cheque', compact('id'));
            }
        }
    }

    public function wire_money(Request $request, $id)
    {
        $find_token = $request->get('securityToken');
        
        if(url()->full() != url('transaction/'.$id.'/wire-money?securityToken='.$find_token)){
            abort('403');
        } else {
            $find_security = AccessToken::where('user_id', Auth::id())->where('type', 'wire-money')->where('customer_id', $id)->where('status', 0)->where('access_token', $find_token)->first();
            if(!$find_security){
                abort('404');
            } else {
                $find_security->status = 1;
                $find_security->save();
                return view('transaction.wire-money', compact('id'));
            }
        }
    }

    public function send_wiremoney(Request $request)
    {
        $key = mt_rand(10000,99999);
        $transactionKey = $key . Auth::id();

        $transaction = new Transaction();

        $transaction->transaction_id = $transactionKey;
        $transaction->company_id     = $request->company_id;
        $transaction->type           = 'wire-money';
        $transaction->beneficiary    = $request->beneficiary;
        $transaction->agency_user_id = Auth::id();
        $transaction->customer_id    = $request->customer_id;
        $transaction->amount         = $request->amount;
        $transaction->status         = 'Confirmed By Agency';

        $transaction->save();

        Session::flash('success', 'Transaction Completed Successfully !');
        return redirect()->route('transaction.manage', $transaction->transaction_id);
    }

    public function send_cheque(Request $request)
    {
        $key = mt_rand(10000,99999);
        $transactionKey = $key . Auth::id();

        $transaction = new Transaction();

        $transaction->transaction_id = $transactionKey;
        $transaction->type           = 'cheque';
        $transaction->agency_user_id = Auth::id();
        $transaction->customer_id    = $request->customer_id;
        $transaction->amount         = $request->amount;
        $transaction->fee            = $request->fee;
        $transaction->status         = 'Confirmed By Agency';

        if($request->hasFile('file')){
            $image_tmp = $request->file('file');
            if ($image_tmp->isValid()) {
                $image_name = $image_tmp->getClientOriginalName();
                $extension = $image_tmp->getClientOriginalExtension();
                $image_new_name = $image_name.'-'.rand(111,99999).'.'.$extension;

                $original_image_path = 'assets/uploads/cheque-transaction/successful/'.$image_new_name;
                
                Image::make($image_tmp)->save($original_image_path);
                
                $transaction->photo = $image_new_name;
            }
        }

        $transaction->save();

        Session::flash('success', 'Transaction Completed Successfully !');
        return redirect()->route('transaction.manage', $transaction->transaction_id);
    }

    public function manage_transaction($transaction_id)
    {
        $transaction = Transaction::where('transaction_id', $transaction_id)->first();

        $agency = User::find($transaction->agency_user_id);
        return view('transaction.transaction', compact('transaction', 'agency'));
    }
}
