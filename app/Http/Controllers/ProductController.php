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

        $request ->validate([
            'name' => 'required',
            'price' =>'required|integer',
            'image' =>'required|mimes:jpeg,bmp,png,jpg'
        ]);


      try{

        $image = '';
        if($request->image && $request->hasFile('image')){
            $file = $request->image;
            $filename = time().'-'.rand(1000,100000).'-'. $file->getClientOriginalName();
            $path = public_path().'/uploads';
            $file->move($path, $filename);
           $image = $filename;
        
        }
                
        $data =[
            'name' =>$request->get('name'),
            'description' =>$request->get('description'),
            'price' =>$request->get('price'),
            'quantity' =>$request->get('quantity'),
            'category' =>$request->get('category'),
            'status' =>$request->get('status'),
            'image' => $image,
        ]; 
        $test = Products::insert($data);
        $request->session()->flash('success', 'Record Created Successfully!');
        return redirect()->route('product.index');

      }catch(\Exception $e){
        $request->session()->flash('error', 'Something went wrong!');
        return redirect()->route('product.index');
      }
    }
    public function update(Request $request, $id){

        if(!$id){
            return redirect()->back();
        }

        $request ->validate([
            'name' => 'required',
            'price' =>'required|integer',
            'image' =>'required|mimes:jpeg,bmp,png'
        ]);

        $product = Products::find($id);
        if($product){

            $image = '';
            if($request->image && $request->hasFile('image')){
                $delete_path = public_path()."/uploads/$product->image";
                if(file_exists($delete_path)){
                    unlink($delete_path);
                }
                $file = $request->image;
                $filename = time().'-'.rand(1000,100000).'-'. $file->getClientOriginalName();
                $path = public_path().'/uploads';
                $file->move($path, $filename);
               $image = $filename;
            }

            
            $data =[
                'name' =>$request->get('name'),
                'description' =>$request->get('description'),
                'price' =>$request->get('price'),
                'quantity' =>$request->get('quantity'),
                'category' =>$request->get('category'),
                'status' =>$request->get('status'),
                'image' => $image
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

        if(!$id){
            return redirect()->back();
        }

        $product = Products::find($id);
        if($product){
            $product->delete();
            return redirect()->route('product.index');
        }
        return redirect()->back();

    }
}
