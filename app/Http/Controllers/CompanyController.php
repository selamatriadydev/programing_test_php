<?php

namespace App\Http\Controllers;

use App\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function index(Request $request){
        $params_datas = Company::paginate(10); 
        return view("company.index", compact("params_datas"));
    }

    public function create(){
        return view("company.create");
    }

    public function store(Request $request){
        $request->validate([
            'companyId' => 'required|unique:tb_company,companyId',
            'name'   => 'required',
            'address'   => 'required',
        ]);
        $newParams = new Company();
        $newParams->companyID= $request->companyId;
        $newParams->name    = $request->name;
        $newParams->email   = $request->email ? $request->email : "";
        $newParams->address = $request->address;
        $newParams->save();
        return redirect()->route('params.company.index')->with('success', 'create success');
    }
    public function edit($id){
        $params_data   = Company::find($id);
        return view("company.edit", compact('params_data'));
    }

    public function update(Request $request, $id){
        $request->validate([
            'name'   => 'required',
            'address'   => 'required',
        ]);

        $param_update = Company::find($id);
        if(!$param_update){
            return redirect()->route('params.company.index')->with('warning', 'Update is failed. Data is not found!!');
        }
        $param_update->name    = $request->name;
        $param_update->email   = $request->email ? $request->email : "";
        $param_update->address = $request->address;
        $param_update->update();
        return redirect()->route('params.company.index')->with('success', 'update success');
    }

    public function delete($id){
        $params_data   = Company::find($id);
        if(!$params_data){
            return redirect()->route('params.company.index')->with('warning', 'Delete is failed. Data is not found!!');
        }
        $params_data->delete();
        return redirect()->route('params.company.index')->with('success', 'Delete success');
    }
}
