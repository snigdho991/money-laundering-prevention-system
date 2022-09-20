<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Auth;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Agency;
use App\Models\Customer;

class TransactionStatusController extends Controller
{
    public function my_cheque_transactions()
    {
    	$auth = Auth::user();
    	if ($auth->hasRole('Administrator')) {
    		$cheque_transactions  = Transaction::where('type', 'cheque')->get();

    	} elseif ($auth->hasRole('Agency')) {
    		$cheque_transactions  = Transaction::where('type', 'cheque')->where('agency_user_id', $auth->id)->get();
    	}

    	return view('transaction-status.cheque-history', compact('cheque_transactions'));
    }

    public function my_wire_transactions()
    {
        $auth = Auth::user();
        if ($auth->hasRole('Administrator')) {
            $wire_transactions  = Transaction::where('type', 'wire-money')->get();

        } elseif ($auth->hasRole('Agency')) {
            $wire_transactions  = Transaction::where('type', 'wire-money')->where('agency_user_id', $auth->id)->get();
        }

        return view('transaction-status.wire-money-history', compact('wire_transactions'));
    }

    
}
