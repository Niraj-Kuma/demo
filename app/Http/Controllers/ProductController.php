<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Products;

class ProductController extends Controller
{
   
    public function index(){
        $data['products'] =  Products::all();
        return view('products.index',$data);
    }


    public function create(){
        return view('products.create');
    }
    public function store(Request $request){

        $data =[
            'name' =>$request->get('name'),
            'description' =>$request->get('description'),
            'price' =>$request->get('price'),
            'quantity' =>$request->get('quantity'),
            'category' =>$request->get('category'),
            'status' =>$request->get('status'),
        ];

        Products::create($data);
        return redirect()->route('product.index');
    }
    public function update(Request $request, $id){
        if(!$id){
            return redirect()->back();
        }

        $product = Products::find($id);
        if($product){
            $data =[
                'name' =>$request->get('name'),
                'description' =>$request->get('description'),
                'price' =>$request->get('price'),
                'quantity' =>$request->get('quantity'),
                'category' =>$request->get('category'),
                'status' =>$request->get('status'),
            ];
    
    
    
            Products:: where('id', $id)->update($data);
            return redirect()->route('product.index');
        }
        return redirect()->back();
    }
    public function edit($id){
        if(!$id){
            return redirect()->back();
        }

        $product = Products::find($id);
        if($product){
            return view('products.edit', compact('product'));
        }
        return redirect()->back();
    }

    public function delete($id){

    }
}
