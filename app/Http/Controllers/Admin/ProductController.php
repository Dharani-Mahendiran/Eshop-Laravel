<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Http\Requests\ProductFormRequest;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('admin.product.index', compact('products'));
    }

    

    public function create(){
        // Send category data to select category in product form
        $categories = Category::all();
        return view('admin.product.create', compact('categories'));
    }


    public function store(ProductFormRequest $request){

        $product = new Product();
        $ValidatedData = $request->validated();
        
        $product->cate_id = $ValidatedData['cate_id'];
        $product->name = $ValidatedData['name'];
        $product->slug = Str::slug($ValidatedData['slug']);
        $product->description = $ValidatedData['description'];
        $product->original_price = $ValidatedData['original_price'];
        $product->selling_price = $ValidatedData['selling_price'];
        $product->quantity = $ValidatedData['quantity'];
    
        if($request->hasFile('image')){
            $product->image = $ValidatedData['image'];
            $file = $request -> file('image');
            $extension = $file ->  getClientOriginalExtension();
            $filename = time().'.'. $extension;
            $file->move('uploads/product', $filename);
            $product->image = $filename;

        }

        $product->status = $request->status == true ? '1' : '0';
        $product->trending = $request->trending == true ? '1' : '0';
        $product->meta_title = $ValidatedData['meta_title'];
        $product->meta_keyword =$ValidatedData['meta_keyword'];
        $product->meta_description = $ValidatedData['meta_description'];
        $product->save();
    
        return redirect('admin/product')->with('message', 'Product Added Successfully');
    }


       
    public function edit(Product $product){
        $categories = Category::all();
        return view('admin.product.edit', compact('product', 'categories'));
    }


    public function update(ProductFormRequest $request, $product){

        $ValidatedData = $request->validated();

        $product = Product::findOrFail($product);

        $product->cate_id = $ValidatedData['cate_id'];
        $product->name = $ValidatedData['name'];
        $product->slug = Str::slug($ValidatedData['slug']);
        $product->description = $ValidatedData['description'];
        $product->original_price = $ValidatedData['original_price'];
        $product->selling_price = $ValidatedData['selling_price'];
        $product->quantity = $ValidatedData['quantity'];
    
        if($request->hasFile('image')){
            //check if the image exits
            $path = 'uploads/product/'.$product->image;
            if(File::exists($path)){
                File::delete($path);
            }

            $product->image = $ValidatedData['image'];
            $file = $request -> file('image');
            $extension = $file ->  getClientOriginalExtension();
            $filename = time().'.'. $extension;
            $file->move('uploads/product', $filename);
            $product->image = $filename;
            }
            $product->status = $request->status == true ? '1' : '0';
            $product->trending = $request->trending == true ? '1' : '0';
            $product->meta_title = $ValidatedData['meta_title'];
            $product->meta_keyword =$ValidatedData['meta_keyword'];
            $product->meta_description = $ValidatedData['meta_description'];

            $product->update();
            return redirect('admin/product')->with('message', 'Product Updated Successfully');

    }


   public function destroy(Product $product){

    $path= 'uploads/product/'.$product->image;
    if(File::exists($path)){
        File::delete($path);
    }

    $product->delete();
    return redirect('admin/product')->with('message','Product Deleted Successfully');

   }

    

}


