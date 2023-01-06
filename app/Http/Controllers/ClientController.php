<?php

namespace App\Http\Controllers;

use App\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index(Request $request){
        $params_datas = Client::paginate(10); 
        return view("client.index", compact("params_datas"));
    }

    public function create(){
        return view("client.create");
    }

    public function store(Request $request){
        $request->validate([
            'clientId' => 'required|unique:tb_client,clientId',
            'name'   => 'required',
            'address'   => 'required',
        ]);
        $newParams = new Client();
        $newParams->clientID= $request->clientId;
        $newParams->name    = $request->name;
        $newParams->email   = $request->email ? $request->email : "";
        $newParams->address = $request->address;
        $newParams->save();
        return redirect()->route('params.client.index')->with('success', 'create success');
    }
    public function edit($id){
        $params_data   = Client::find($id);
        return view("client.edit", compact('params_data'));
    }

    public function update(Request $request, $id){
        $request->validate([
            'name'   => 'required',
            'address'   => 'required',
        ]);

        $param_update = Client::find($id);
        if(!$param_update){
            return redirect()->route('params.client.index')->with('warning', 'Update is failed. Data is not found!!');
        }
        $param_update->name    = $request->name;
        $param_update->email   = $request->email ? $request->email : "";
        $param_update->address = $request->address;
        $param_update->update();
        return redirect()->route('params.client.index')->with('success', 'update success');
    }

    public function delete($id){
        $params_data   = Client::find($id);
        if(!$params_data){
            return redirect()->route('params.client.index')->with('warning', 'Delete is failed. Data is not found!!');
        }
        $params_data->delete();
        return redirect()->route('params.client.index')->with('success', 'Delete success');
    }
}
