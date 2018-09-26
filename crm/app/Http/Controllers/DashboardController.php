<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Companies;
use App\Employees;

class DashboardController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [];

        //Get all companies
        $companies = Companies::all();

        //Get all employees
        $employees = Employees::all();

        //Add companies and employees to data array
        $data['companies'] = $companies;
        $data['employees'] = $employees;

        return view('dashboard')->with('data', $data);
    }
}
