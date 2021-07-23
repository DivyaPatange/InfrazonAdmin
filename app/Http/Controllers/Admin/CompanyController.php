<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Company;

class CompanyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allCompany = Company::orderBy('id', 'DESC')->get();
        if(request()->ajax()) {
            return datatables()->of($allCompany)
            ->addColumn('status', function($row){    
                if($row->status == 1)
                {
                    return '<span class="badge badge-success">Active</span>';
                }  
                else{
                    return '<span class="badge badge-danger">Inactive</span>';
                }                                                                                                                                                                                                                                                                                      
            })
            ->addColumn('action', 'admin.companies.action')
            ->rawColumns(['action', 'status'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('admin.companies.index');
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
        $company = new Company();
        $company->company_name = $request->company;
        $company->status = $request->status;
        $company->save();
        return response()->json(['success' => 'Company Added Successfully!']);
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
        //
    }

    public function getCompany(Request $request)
    {
        $company = Company::where('id', $request->bid)->first();
        if (!empty($company)) 
        {
            $data = array('id' =>$company->id, 'company_name' =>$company->company_name,'status' =>$company->status
            );
        }else{
            $data =0;
        }
        echo json_encode($data);
    }

    public function updateCompany(Request $request)
    {
        $company = Company::where('id', $request->id)->first();
        $input_data = array (
            'company_name' => $request->company,
            'status' => $request->status,
        );

        Company::whereId($company->id)->update($input_data);
        return response()->json(['success' => 'Company Updated Successfully']);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $company = Company::findorfail($id);
        $company->delete();
        return response()->json(['success' => 'Company Deleted Successfully!']);
    }
}
