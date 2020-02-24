<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;
use App\Entity\Product;
use Illuminate\Validation\Rule;
use Storage;

class ProductsController extends Controller
{

    public function __construct()
    {
    }
    public function index(Request $request)
    {
        $query = Product::orderByDesc('id');

        if(!empty($value = $request->get('id'))){
            $query->where('id',$value);
        }
        if(!empty($value = $request->get('name'))){
            $query->where('name','like','%'.$value.'%');
        }
        $products = $query->paginate(20);
        return view('admin.products.index',compact('products'));
    }

    public function create()
    {
        return view('admin.products.create');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required|string|max:255',
            'text'=>'required|string|',
            'image'=>'required|string|',
            'proteins'=>'nullable|integer',
            'fat'=>'nullable|integer',
            'carbohydrates'=>'nullable|integer',
        ]);
        $Product = Product::create([
           'name'=>$request['name'],
            'text'=>$request['text'],
            'image'=>$request['image'],
            'proteins'=>$request['proteins'],
            'fat'=>$request['fat'],
            'carbohydrates'=>$request['carbohydrates'],
        ]);
        return redirect()->route('admin.products.show',$Product);
    }

    public function show(Product $product)
    {
        return view('admin.products.show',compact('product'));
    }

    public function edit(Product $product)
    {
        return view('admin.products.edit',compact('product','muscles'));
    }

    public function update(Request $request, Product $product)
    {
        $data = $this->validate($request,[
            'name'=>'required|string|max:255',
            'text'=>'required|string|',
            'image'=>'required|string',
            'proteins'=>'nullable|integer',
            'fat'=>'nullable|integer',
            'carbohydrates'=>'nullable|integer',
            ]);
        $product->update($data);
        return redirect()->route('admin.products.show',$product);
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.products.index');
    }
}
