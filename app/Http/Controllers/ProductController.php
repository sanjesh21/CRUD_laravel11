<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index(){
        $products = Product::orderBy('created_at','DESC')->get();
        return view('products.list',[
        'products' => $products 
        ]);
    }

    public function create(){
        return view('products.create');
    }

    public function store(Request $request){
        $rules =[
            'name' =>'required |min:5',
            'price' =>'required |numeric',
            'sku' =>'required|min:3',
        ];

        if($request ->image !=""){
            $rules['image'] = 'image';

        }

        $validator = Validator::make($request ->all(),$rules);

        if($validator -> fails()){
            return redirect()->route('products.create')->withErrors($validator)->withInput();
        }
        $product= new Product();
        $product ->name = $request ->name;
        $product ->price = $request ->price;
        $product ->sku = $request ->sku;
        $product ->description = $request ->description;
        $product ->save();

       if($request->image !="") {
        $image = $request ->image;
        $ext = $image->getClientOriginalExtension();
        $imageName = time().'.'.$ext;
        $image ->move(public_path('uploads/products'),$imageName);
        $product ->image = $imageName;
        $product ->save();
       }

        return redirect()->route('products.index')->with('success','Succseful');
    }

    public function edit($id){
        $product = Product::findOrFail($id);
        return view('products.edit',[
            'product' => $product
        ]);
    }

    public function update($id,Request $request){
        $product = Product::findOrFail($id);

        $rules =[
            'name' =>'required |min:5',
            'price' =>'required |numeric',
            'sku' =>'required|min:3',
        ];

        if($request ->image !=""){
            $rules['image'] = 'image';

        }

        $validator = Validator::make($request ->all(),$rules);

        if($validator -> fails()){
            return redirect()->route('products.edit',$product->id)->withErrors($validator)->withInput();
        }
        $product ->name = $request ->name;
        $product ->price = $request ->price;
        $product ->sku = $request ->sku;
        $product ->description = $request ->description;
        $product ->save();

       if($request->image !="") {
        File::delete(public_path('uploads/products/' . $product->image));
        $image = $request ->image;
        $ext = $image ->getClientOriginalExtension();
        $imageName = time().'.'.$ext;
        $image ->move(public_path('uploads/products'),$imageName);
        $product ->image = $imageName;
        $product ->save();
       }

        return redirect()->route('products.index')->with('success','Succseful');
    }
    
    public function destroy($id){
        $product = Product::findOrFail($id);
        File::delete(public_path('uploads/products/' . $product->image));
        $product ->delete();
        return redirect()->route('products.index')->with('success','Succseful');
        
    }
}
