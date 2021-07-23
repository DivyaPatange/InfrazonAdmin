<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Company;
use App\Models\Admin\Category;
use App\Models\Admin\ModelName;

class ModelController extends Controller
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
        $allModel = ModelName::orderBy('id', 'DESC')->get();
        $categories = Category::where('status', 1)->get();
        $companies = Company::where('status', 1)->get();
        if(request()->ajax()) {
            return datatables()->of($allModel)
            ->addColumn('category_id', function($row){    
                $category = Category::where('id', $row->category_id)->first();
                if(!empty($category))
                {
                    return $category->category_name;
                }
            })
            ->addColumn('company_id', function($row){    
                $company = Company::where('id', $row->company_id)->first();
                if(!empty($company))
                {
                    return $company->company_name;
                }
            })
            ->addColumn('status', function($row){    
                if($row->status == 1)
                {
                    return '<span class="badge badge-success">Active</span>';
                }  
                else{
                    return '<span class="badge badge-danger">Inactive</span>';
                }                                                                                                                                                                                                                                                                                      
            })
            ->addColumn('action', 'admin.models.action')
            ->rawColumns(['action', 'status'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('admin.models.index', compact('categories', 'companies'));
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
        $model = new ModelName();
        $model->category_id = $request->category;
        $model->company_id = $request->company;
        $model->model_name = $request->model;
        $model->status = $request->status;
        $model->save();
        return response()->json(['success' => 'Model Added Successfully!']);
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

    public function getModel(Request $request)
    {
        $model = ModelName::where('id', $request->bid)->first();
        if (!empty($model)) 
        {
            $data = array('id' =>$model->id, 'company_id' =>$model->company_id,'status' =>$model->status, 'category_id' => $model->category_id, 'model_name' => $model->model_name
            );
        }else{
            $data =0;
        }
        echo json_encode($data);
    }

    public function updateModel(Request $request)
    {
        $model = ModelName::where('id', $request->id)->first();
        $input_data = array (
            'category_id' => $request->category,
            'company_id' => $request->company,
            'model_name' => $request->model,
            'status' => $request->status,
        );

        ModelName::whereId($model->id)->update($input_data);
        return response()->json(['success' => 'Model Updated Successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = ModelName::findorfail($id);
        $model->delete();
        return response()->json(['success' => 'Model Deleted Successfully!']);
    }
}
