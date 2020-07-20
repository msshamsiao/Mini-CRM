<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Company;
use Validator;

class CompaniesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('companies.index')->with('companies', Company::all());
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
        $validator = Validator::make($request->all(), [
            'company_name'    => 'required',
            'company_email'   => 'required',
            'company_website' => 'required'
        ]);

        if($validator->fails()){
            $error = $validator->errors()->first();
            toastr()->error('warning', $error);
            return back();
        }else{
            if(request('company_logo'))
            {
                $image = $request->file('company_logo');
                $logo_image = time().'.'.$image->getClientOriginalExtension();
                $destinationPath = storage_path('app/public');
                $image->move($destinationPath, $logo_image);

                $companies = new Company;
                $companies->name    = $request->company_name;
                $companies->email   = $request->company_email;
                $companies->logo    = $logo_image;
                $companies->website = $request->company_website;
                $companies->save();
            }else{

                $logo_image = "default.jpg";

                $companies = new Company;
                $companies->name    = $request->company_name;
                $companies->email   = $request->company_email;
                $companies->logo    = $logo_image;
                $companies->website = $request->company_website;
                $companies->save();

            }
        }

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
        $companies = Company::find($id);
        $companies->name    = $request->company_name;
        $companies->email   = $request->company_email;
        $companies->logo    = $request->company_logo;
        $companies->website = $request->company_website;
        $companies->save();

        toastr()->success('success', 'You succesfully updated');
        return redirect()->route('companies.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $companies = Company::find($id);
        
        if($companies->delete()){ 
			toastr()->success('success', 'You succesfully deleted');
		}else{
			toastr()->error('message_success', 'Sorry please try again');
		}

        return redirect()->route('companies.index');
        
    }
}
