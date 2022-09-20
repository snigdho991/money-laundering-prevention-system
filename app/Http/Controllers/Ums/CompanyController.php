<?php

namespace App\Http\Controllers\Ums;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Company;
use Session;
use Auth;

class CompanyController extends Controller
{

	public function __construct()
    {
        $this->middleware(['role:Agency']);
    }

	public function index()
    {
        $companies = Company::where('agency_user_id', Auth::id())->get();
        return view('company.index', compact('companies'));
    }

    public function create()
    {
        return view('company.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'company_name' => 'required',
            'responsible'  => 'required',
            'phone'        => 'required',
        ]);

        $company = Company::create([
        	'agency_user_id' => Auth::id(),
            'company_name'   => $request->company_name,
            'responsible'    => $request->responsible,
            'phone'          => $request->phone,
        ]);

        Session::flash('success', 'Company Added Successfully !');
        return redirect()->route('company.index');
    }

    public function edit($id)
    {
        $auth = Auth::user();
        $company = Company::find($id);

        if($company) {
            if($auth->id == $company->agency_user_id){
                return view('company.edit', compact('company'));
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
            'company_name' => 'required',
            'responsible'  => 'required',
            'phone'        => 'required',
        ]);

        $company = Company::find($id);

        $company->company_name = $request->company_name;
        $company->responsible  = $request->responsible;
        $company->phone   = $request->phone;

        $company->save();

        Session::flash('info', 'Company stuffs updated successfully.');
        return redirect()->route('company.index');
        
    }

    public function destroy($id)
    {
        
        $company = Company::findOrFail($id);
        $company->delete();

        Session::flash('error', 'Company Deleted Successfully !');
        return redirect()->route('company.index');

    }
}
