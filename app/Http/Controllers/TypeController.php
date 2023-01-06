<?php

namespace App\Http\Controllers;

use App\Type;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    public function index(Request $request){
        $params_datas = Type::paginate(10); 
        return view("type.index", compact("params_datas"));
    }

    public function create(){
        return view("type.create");
    }

    public function store(Request $request){
        $request->validate([
            'typeId' => 'required|unique:tb_type,typeId',
            'name'   => 'required',
        ]);
        $newParams = new Type();
        $newParams->typeID  = $request->typeId;
        $newParams->name    = $request->name;
        $newParams->save();
        return redirect()->route('params.type.index')->with('success', 'create success');
    }
    public function edit($id){
        $params_data   = Type::find($id);
        return view("type.edit", compact('params_data'));
    }

    public function update(Request $request, $id){
        $request->validate([
            'name'   => 'required',
        ]);

        $param_update = Type::find($id);
        if(!$param_update){
            return redirect()->route('params.type.index')->with('warning', 'Update is failed. Data is not found!!');
        }
        $param_update->name = $request->name;
        $param_update->update();
        return redirect()->route('params.type.index')->with('success', 'update success');
    }

    public function delete($id){
        $params_data   = Type::find($id);
        if(!$params_data){
            return redirect()->route('params.type.index')->with('warning', 'Delete is failed. Data is not found!!');
        }
        $params_data->delete();
        return redirect()->route('params.type.index')->with('success', 'Delete success');
    }
}
