<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use App\Employee;
use App\Company;
use Validator;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('employees.index')
        ->with('companies', Company::select('id','name')->get())
        ->with('employees', Employee::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $this->validate($request, [
        //     'firstname' => 'required',
        //     'lastname'  => 'required',
        //     'company'   => 'required',
        //     'email'     => 'required',
        //     'phone'     => 'required'
        // ]);

        $validator = Validator::make($request->all(), [
            'firstname' => 'required',
            'lastname'  => 'required',
            'company'   => 'required',
            'email'     => 'required',
            'phone'     => 'required'
        ]);

        if($validator->fails()){
            $error = $validator->errors()->first();
            toastr()->error('warning', 'Please enter valid details');
            return back();
        }

        $employees = new Employee;
        $employees->firstname = $request->firstname;
        $employees->lastname  = $request->lastname;
        $employees->company   = $request->company;
        $employees->email     = $request->email;
        $employees->phone     = $request->phone;
        $employees->save();
        
        toastr()->success('success', 'You succesfully added');
        return back();

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
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
        $employees = Employee::find($id);
        $employees->firstname = $request->firstname;
        $employees->save();

        toastr()->success('success', 'You succesfully updated');
        return redirect()->route('employees.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employees = Employee::find($id);

        if($employees->delete()){ 
			toastr()->success('success', 'You succesfully deleted');
		}else{
			toastr()->error('message_success', 'Sorry please try again');
		}

        return redirect()->route('employees.index');
    }
}
