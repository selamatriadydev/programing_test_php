<?php

namespace App\Http\Controllers;

use App\Product;
use App\Type;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request){
        $params_datas = Product::paginate(10); 
        return view("product.index", compact("params_datas"));
    }

    public function create(){
        $type_datas = Type::pluck('name', 'typeID');
        return view("product.create", compact('type_datas'));
    }

    public function store(Request $request){ 
        $request->validate([
            'productId' => 'required|unique:tb_product,productId',
            'name'   => 'required',
            'typeId'   => 'required',
            'price'   => 'required',
        ]);
        $newParams = new Product();
        $newParams->productID = $request->productId;
        $newParams->name      = $request->name;
        $newParams->itemTypeID= $request->typeId;
        $newParams->price     = $request->price;
        $newParams->stock     = 0;
        $newParams->save();
        return redirect()->route('params.product.index')->with('success', 'create success');
    }
    public function edit($id){
        $type_datas = Type::pluck('name', 'typeID');
        $params_data= Product::find($id);
        return view("product.edit", compact('params_data', 'type_datas'));
    }

    public function update(Request $request, $id){
        $request->validate([
            'name'   => 'required',
            'typeId'   => 'required',
            'price'   => 'required',
        ]);

        $param_update = Product::find($id);
        if(!$param_update){
            return redirect()->route('params.product.index')->with('warning', 'Update is failed. Data is not found!!');
        }
        $param_update->name       = $request->name;
        $param_update->itemTypeID = $request->typeId;
        $param_update->price      = $request->price;
        $param_update->update();
        return redirect()->route('params.product.index')->with('success', 'update success');
    }

    public function delete($id){
        $params_data   = Product::find($id);
        if(!$params_data){
            return redirect()->route('params.product.index')->with('warning', 'Delete is failed. Data is not found!!');
        }
        $params_data->delete();
        return redirect()->route('params.product.index')->with('success', 'Delete success');
    }
}
