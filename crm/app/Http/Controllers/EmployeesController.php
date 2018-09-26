<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employees;
use App\Companies;
use Carbon\Carbon;

class EmployeesController extends Controller
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
        //Get all employyes form db: ordered by Last name ASC + company details
        //Create pagination for 10 entries per page
        $employees = Employees::orderBy('last_name', 'ASC')->with('companies')->paginate(10);
        return view('employees.index')->with('employees', $employees);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Get all companies
        $companies = Companies::all();
        $select = [];
        foreach($companies as $company){
            $select[$company->id] = $company->name;
        }
        return view('employees.create')->with('select', $select);
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
            'first_name' => 'required|min:2|max:100',
            'last_name' => 'required|min:2|max:100',
            'phone' => 'nullable|regex:/^[0-9]{11}$/',
            'company' => 'required'
        ]);

        //Create Employee
        $employee = new Employees;
        $employee->first_name = $request->input('first_name');
        $employee->last_name = $request->input('last_name');
        $employee->company = $request->input('company');
        $employee->email = $request->input('email');
        $employee->phone = $request->input('phone');
        $employee->created_at = Carbon::now();
        $employee->updated_at = Carbon::now();
        $employee->save();

        return redirect('/employees')->with('success', 'The employee has been successfully added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //Get Employee detail + his company details
        $employee = EMployees::with('companies')->find($id);
        return view('employees.show')->with('employee', $employee);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //Define data and companies as array
        $data = $companies = [];

        //Get all companies
        $allCompanies = Companies::all();

        //Build companies array for dropdown list
        foreach($allCompanies as $company){
            $companies[$company->id] = $company->name;
        }

        //Get employee detail
        $employee = Employees::with('companies')->find($id);

        //Add companies and employee details to data array
        $data['employee'] = $employee;
        $data['companies'] = $companies;

        return view('employees.edit')->with('data', $data);
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
            'first_name' => 'required|min:2|max:100',
            'last_name' => 'required|min:2|max:100',
            'company' => 'required'
        ]);

        //Update Employee
        $employee = Employees::find($id);
        $employee->first_name = $request->input('first_name');
        $employee->last_name = $request->input('last_name');
        $employee->company = $request->input('company');
        $employee->email = $request->input('email');
        $employee->phone = $request->input('phone');
        $employee->updated_at = Carbon::now();
        $employee->save();

        return redirect('/employees/'.$id)->with('success', 'The employee has been successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Delete employee
        $employee = Employees::find($id);
        $employee->delete();
        return redirect('/employees')->with('success', 'The employee has been successfully removed');
    }
}
