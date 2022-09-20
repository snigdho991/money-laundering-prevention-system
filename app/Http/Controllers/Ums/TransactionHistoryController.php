<?php

namespace App\Http\Controllers\Ums;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\AccessToken;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Agency;
use App\Models\Customer;

use Carbon\Carbon;

use Auth;
use Image;
use Session;

class TransactionHistoryController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role:Administrator|Agency']);
    }

    public function this_month()
    {
    	$auth = Auth::user();

    	if ($auth->hasRole('Agency')) {
    		$all_transactions      = Transaction::where('agency_user_id', $auth->id)->whereMonth('created_at', Carbon::now()->month)->whereYear('created_at', Carbon::now()->year)->get();
    		
    		$latest_transactions   = Transaction::where('agency_user_id', $auth->id)->whereMonth('created_at', Carbon::now()->month)->whereYear('created_at', Carbon::now()->year)->latest()->get();
    		$transaction_cheque   = Transaction::where('agency_user_id', $auth->id)->where('type', 'cheque')->latest()->whereMonth('created_at', Carbon::now()->month)->whereYear('created_at', Carbon::now()->year)->count();
            $transaction_wire   = Transaction::where('agency_user_id', $auth->id)->where('type', 'wire-money')->latest()->whereMonth('created_at', Carbon::now()->month)->whereYear('created_at', Carbon::now()->year)->count();

            $wire_transactions   = Transaction::where('agency_user_id', $auth->id)->where('type', 'wire-money')->latest()->whereMonth('created_at', Carbon::now()->month)->whereYear('created_at', Carbon::now()->year)->get();
            $cheque_transactions   = Transaction::where('agency_user_id', $auth->id)->where('type', 'cheque')->latest()->whereMonth('created_at', Carbon::now()->month)->whereYear('created_at', Carbon::now()->year)->get();


        	$total_amount    = Transaction::select('*')
                                          ->where('agency_user_id', $auth->id)
                                          ->whereMonth('created_at', Carbon::now()->month)
                                          ->whereYear('created_at', Carbon::now()->year)
                                          ->sum('amount');
            $cheque_amount  = Transaction::select('*')
                                          ->where('agency_user_id', $auth->id)
                                          ->where('type', 'cheque')
                                          ->whereMonth('created_at', Carbon::now()->month)
                                          ->whereYear('created_at', Carbon::now()->year)
                                          ->sum('amount');
            $wire_amount = Transaction::select('*')
                                          ->where('agency_user_id', $auth->id)
                                          ->where('type', 'wire-money')
                                          ->whereMonth('created_at', Carbon::now()->month)
                                          ->whereYear('created_at', Carbon::now()->year)
                                          ->sum('amount');
            
            return view('transaction-history.this-month', compact('all_transactions', 'wire_transactions', 'cheque_transactions', 'total_amount', 'cheque_amount', 'wire_amount', 'latest_transactions', 'transaction_cheque', 'transaction_wire', 'auth'));
    	} elseif ($auth->hasRole('Administrator')) {
        	
    		$all_transactions      = Transaction::whereMonth('created_at', Carbon::now()->month)->whereYear('created_at', Carbon::now()->year)->get();
    		
    		$latest_transactions   = Transaction::whereMonth('created_at', Carbon::now()->month)->whereYear('created_at', Carbon::now()->year)->latest()->get();
    		$transaction_cheque   = Transaction::where('type', 'cheque')->latest()->whereMonth('created_at', Carbon::now()->month)->whereYear('created_at', Carbon::now()->year)->count();
            $transaction_wire   = Transaction::where('type', 'wire-money')->latest()->whereMonth('created_at', Carbon::now()->month)->whereYear('created_at', Carbon::now()->year)->count();

            $wire_transactions   = Transaction::where('type', 'wire-money')->latest()->whereMonth('created_at', Carbon::now()->month)->whereYear('created_at', Carbon::now()->year)->get();
            $cheque_transactions   = Transaction::where('type', 'cheque')->latest()->whereMonth('created_at', Carbon::now()->month)->whereYear('created_at', Carbon::now()->year)->get();


        	$total_amount    = Transaction::select('*')
                                          ->whereMonth('created_at', Carbon::now()->month)
                                          ->whereYear('created_at', Carbon::now()->year)
                                          ->sum('amount');
            $cheque_amount  = Transaction::select('*')
                                          ->where('type', 'cheque')
                                          ->whereMonth('created_at', Carbon::now()->month)
                                          ->whereYear('created_at', Carbon::now()->year)
                                          ->sum('amount');
            $wire_amount = Transaction::select('*')
                                          ->where('type', 'wire-money')
                                          ->whereMonth('created_at', Carbon::now()->month)
                                          ->whereYear('created_at', Carbon::now()->year)
                                          ->sum('amount');
            
            return view('transaction-history.this-month', compact('all_transactions', 'wire_transactions', 'cheque_transactions', 'total_amount', 'cheque_amount', 'wire_amount', 'latest_transactions', 'transaction_cheque', 'transaction_wire', 'auth'));
    	}
    }

    public function this_week()
    {
      Carbon::setWeekStartsAt(Carbon::SUNDAY);
      Carbon::setWeekEndsAt(Carbon::SATURDAY);

      $auth = Auth::user();

      if ($auth->hasRole('Agency')) {
      		$all_transactions      = Transaction::where('agency_user_id', $auth->id)->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();
    		
    		$latest_transactions   = Transaction::where('agency_user_id', $auth->id)->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->latest()->get();
    		$transaction_cheque   = Transaction::where('agency_user_id', $auth->id)->where('type', 'cheque')->latest()->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count();
            $transaction_wire   = Transaction::where('agency_user_id', $auth->id)->where('type', 'wire-money')->latest()->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count();

            $wire_transactions   = Transaction::where('agency_user_id', $auth->id)->where('type', 'wire-money')->latest()->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();
            $cheque_transactions   = Transaction::where('agency_user_id', $auth->id)->where('type', 'cheque')->latest()->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();


        	$total_amount    = Transaction::select('*')
                                          ->where('agency_user_id', $auth->id)
                                          ->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
                                          ->sum('amount');
            $cheque_amount  = Transaction::select('*')
                                          ->where('agency_user_id', $auth->id)
                                          ->where('type', 'cheque')
                                          ->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
                                          ->sum('amount');
            $wire_amount = Transaction::select('*')
                                          ->where('agency_user_id', $auth->id)
                                          ->where('type', 'wire-money')
                                          ->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
                                          ->sum('amount');

            
            return view('transaction-history.this-week', compact('all_transactions', 'wire_transactions', 'cheque_transactions', 'total_amount', 'cheque_amount', 'wire_amount', 'latest_transactions', 'transaction_cheque', 'transaction_wire', 'auth'));
      } elseif ($auth->hasRole('Administrator')) {

      		$all_transactions      = Transaction::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();
    		
    		$latest_transactions   = Transaction::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->latest()->get();
    		$transaction_cheque   = Transaction::where('type', 'cheque')->latest()->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count();
            $transaction_wire   = Transaction::where('type', 'wire-money')->latest()->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count();

            $wire_transactions   = Transaction::where('type', 'wire-money')->latest()->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();
            $cheque_transactions   = Transaction::where('type', 'cheque')->latest()->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();


        	$total_amount    = Transaction::select('*')
                                          ->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
                                          ->sum('amount');
            $cheque_amount  = Transaction::select('*')
                                          ->where('type', 'cheque')
                                          ->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
                                          ->sum('amount');
            $wire_amount = Transaction::select('*')
                                          ->where('type', 'wire-money')
                                          ->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
                                          ->sum('amount');
           
            return view('transaction-history.this-week', compact('all_transactions', 'wire_transactions', 'cheque_transactions', 'total_amount', 'cheque_amount', 'wire_amount', 'latest_transactions', 'transaction_cheque', 'transaction_wire', 'auth'));
      }
    }

    public function this_year()
    {
      
      $auth = Auth::user();

      if ($auth->hasRole('Agency')) {

      		$all_transactions      = Transaction::where('agency_user_id', $auth->id)->whereBetween('created_at', [Carbon::now()->startOfYear(), Carbon::now()->endOfYear()])->get();
    		
    		$latest_transactions   = Transaction::where('agency_user_id', $auth->id)->whereBetween('created_at', [Carbon::now()->startOfYear(), Carbon::now()->endOfYear()])->latest()->get();
    		$transaction_cheque   = Transaction::where('agency_user_id', $auth->id)->where('type', 'cheque')->latest()->whereBetween('created_at', [Carbon::now()->startOfYear(), Carbon::now()->endOfYear()])->count();
            $transaction_wire   = Transaction::where('agency_user_id', $auth->id)->where('type', 'wire-money')->latest()->whereBetween('created_at', [Carbon::now()->startOfYear(), Carbon::now()->endOfYear()])->count();

            $wire_transactions   = Transaction::where('agency_user_id', $auth->id)->where('type', 'wire-money')->latest()->whereBetween('created_at', [Carbon::now()->startOfYear(), Carbon::now()->endOfYear()])->get();
            $cheque_transactions   = Transaction::where('agency_user_id', $auth->id)->where('type', 'cheque')->latest()->whereBetween('created_at', [Carbon::now()->startOfYear(), Carbon::now()->endOfYear()])->get();


        	$total_amount    = Transaction::select('*')
                                          ->where('agency_user_id', $auth->id)
                                          ->whereBetween('created_at', [Carbon::now()->startOfYear(), Carbon::now()->endOfYear()])
                                          ->sum('amount');
            $cheque_amount  = Transaction::select('*')
                                          ->where('agency_user_id', $auth->id)
                                          ->where('type', 'cheque')
                                          ->whereBetween('created_at', [Carbon::now()->startOfYear(), Carbon::now()->endOfYear()])
                                          ->sum('amount');
            $wire_amount = Transaction::select('*')
                                          ->where('agency_user_id', $auth->id)
                                          ->where('type', 'wire-money')
                                          ->whereBetween('created_at', [Carbon::now()->startOfYear(), Carbon::now()->endOfYear()])
                                          ->sum('amount');

            
            return view('transaction-history.this-year', compact('all_transactions', 'wire_transactions', 'cheque_transactions', 'total_amount', 'cheque_amount', 'wire_amount', 'latest_transactions', 'transaction_cheque', 'transaction_wire', 'auth'));

      } elseif ($auth->hasRole('Administrator')) {
            $all_transactions      = Transaction::whereBetween('created_at', [Carbon::now()->startOfYear(), Carbon::now()->endOfYear()])->get();
    		
    		$latest_transactions   = Transaction::whereBetween('created_at', [Carbon::now()->startOfYear(), Carbon::now()->endOfYear()])->latest()->get();
    		$transaction_cheque   = Transaction::where('type', 'cheque')->latest()->whereBetween('created_at', [Carbon::now()->startOfYear(), Carbon::now()->endOfYear()])->count();
            $transaction_wire   = Transaction::where('type', 'wire-money')->latest()->whereBetween('created_at', [Carbon::now()->startOfYear(), Carbon::now()->endOfYear()])->count();

            $wire_transactions   = Transaction::where('type', 'wire-money')->latest()->whereBetween('created_at', [Carbon::now()->startOfYear(), Carbon::now()->endOfYear()])->get();
            $cheque_transactions   = Transaction::where('type', 'cheque')->latest()->whereBetween('created_at', [Carbon::now()->startOfYear(), Carbon::now()->endOfYear()])->get();


        	$total_amount    = Transaction::select('*')
                                          ->whereBetween('created_at', [Carbon::now()->startOfYear(), Carbon::now()->endOfYear()])
                                          ->sum('amount');
            $cheque_amount  = Transaction::select('*')
                                          ->where('type', 'cheque')
                                          ->whereBetween('created_at', [Carbon::now()->startOfYear(), Carbon::now()->endOfYear()])
                                          ->sum('amount');
            $wire_amount = Transaction::select('*')
                                          ->where('type', 'wire-money')
                                          ->whereBetween('created_at', [Carbon::now()->startOfYear(), Carbon::now()->endOfYear()])
                                          ->sum('amount');

            
            return view('transaction-history.this-year', compact('all_transactions', 'wire_transactions', 'cheque_transactions', 'total_amount', 'cheque_amount', 'wire_amount', 'latest_transactions', 'transaction_cheque', 'transaction_wire', 'auth'));
      }
    }

    public function advanced_search(Request $request)
    {
        $from = $request->get('from');
        $to   = $request->get('to');
        
        $auth = Auth::user();
        if ($auth->hasRole('Administrator')) {
            $search_results  = Transaction::whereBetween('created_at', [$from, $to])->get();
            
        } elseif ($auth->hasRole('Agency')) {
            $search_results  = Transaction::where('agency_user_id', $auth->id)->whereBetween('created_at', [$from, $to])->get();
        }

        return view('transaction-history.advance-search', compact('search_results', 'from', 'to'));
    }

}