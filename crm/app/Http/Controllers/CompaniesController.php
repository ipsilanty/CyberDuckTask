<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Companies;
use Carbon\Carbon;

class CompaniesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //Redirect user to login page if is not logged in
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Get all companies form db: ordered by Name ASC + employees 
        //Create pagination for 10 entries per page
        $companies = Companies::orderBy('name', 'asc')->with('employees')->paginate(10);
        return view('companies.index')->with('companies', $companies);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('companies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Fields validation
        $this->validate($request, [
            'name' => 'required|min:2|max:100',
            'logo' => 'image|nullable|max:1999|dimensions:min_width=100,min_height=100'
        ]);

        //Handle file upload
        if($request->hasFile('logo')) {
            //Get filename with extension
            $fileNameWithExt = $request->file('logo')->getClientOriginalName();

            //Get just file name
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);

            //Get just extension
            $ext = $request->file('logo')->getClientOriginalExtension();

            //File name to store
            $companyLogo = $fileName.'_'.time().'.'.$ext;

            //Upload logo
            $path = $request->file('logo')->storeAs('public/logo', $companyLogo);
        } else {
            //Add a default logo
            $companyLogo = "company_logo.png";
        }

        //Create new company
        $company = new Companies;
        $company->name = $request->input('name');
        $company->email = $request->input('email');
        $company->website = $request->input('website');
        $company->logo = $companyLogo;
        $company->created_at = Carbon::now();
        $company->updated_at = Carbon::now();
        $company->save();

        return redirect('/companies')->with('success', 'The company has been successfully added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //Get Company details + employees
        $company = Companies::with('employees')->find($id);
        return view('companies.show')->with('company', $company);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //Get Company detail
        $company = Companies::find($id);
        return view('companies.edit')->with('company', $company);
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
        //Fields validation
        $this->validate($request, [
            'name' => 'required|min:2|max:100',
            'logo' => 'image|nullable|max:1999|dimensions:min_width=100,min_height=100'
        ]);

        //Handle file upload
        if($request->hasFile('logo')) {
            //Get filename with extension
            $fileNameWithExt = $request->file('logo')->getClientOriginalName();

            //Get just file name
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);

            //Get just extension
            $ext = $request->file('logo')->getClientOriginalExtension();

            //File name to store
            $companyLogo = $fileName.'_'.time().'.'.$ext;

            //Upload logo
            $path = $request->file('logo')->storeAs('public/logo', $companyLogo);
        }

        //Update the company
        $company = Companies::find($id);
        $company->name = $request->input('name');
        $company->email = $request->input('email');
        $company->website = $request->input('website');
        //Check if logo has any file
        if($request->hasFile('logo')) {
            $company->logo = $companyLogo;
        }
        $company->updated_at = Carbon::now();
        $company->save();

        return redirect('/companies/'.$id)->with('success', 'The company has been successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Delete company
        $company = Companies::find($id);

        //Check for default logo
        if($company->logo != 'company_logo.png') {
            //Delete image
            Storage::delete('public/logo/'.$company->logo);
        }
        $company->delete();
        return redirect('/companies')->with('success', 'The company has been successfully removed');
    }
}
