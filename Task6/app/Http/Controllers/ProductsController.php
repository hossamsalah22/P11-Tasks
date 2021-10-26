<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Subcategory;
use App\Http\Traits\media;

use function PHPUnit\Framework\fileExists;

class ProductsController extends Controller
{
    use media;
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    public function create()
    {
        $subcategories = Subcategory::where('status', '1')->get();
        $brands = Brand::where('status', '1')->get();
        return view('products.create', compact('subcategories', 'brands'));
    }

    public function store(StoreProductRequest $request)
    {

        // Upload Image
        $imageName = $this->uploadImage($request->image, 'products');
        // insert Data Into DB
        Product::create([
            'name_en' => $request->name_en,
            'name_ar' => $request->name_ar,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'status' => $request->status,
            'subcategory_id' => $request->subcategory_id,
            'brand_id' => $request->brand_id,
            'desc_ar' => $request->desc_ar,
            'desc_en' => $request->desc_en,
            'image' => $imageName,
        ]);

        return $this->returnWithMessage($request);
    }

    public function edit($id)
    {
        $product = Product::findORFail($id);
        $subcategories = Subcategory::where('status', '1')->get();
        $brands = Brand::where('status', '1')->get();
        return view('products.edit', compact('product', 'subcategories', 'brands'));
    }

    public function update(UpdateProductRequest $request, $id)
    {
        Product::where('id', $id)->Update([
            'name_en' => $request->name_en,
            'name_ar' => $request->name_ar,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'status' => $request->status,
            'subcategory_id' => $request->subcategory_id,
            'brand_id' => $request->brand_id,
            'desc_ar' => $request->desc_ar,
            'desc_en' => $request->desc_en,
        ]);
        if ($request->has('image')) {
            $this->deleteImage(Product::findOrFail($id)->image, 'products');
            $imageName = $this->uploadImage($request->image, 'products');
            Product::where('id', $id)->update(['image' => $imageName]);
        }
        return $this->returnWithMessage($request);
    }

    public function delete($id)
    {
        $this->deleteImage(Product::findOrFail($id)->image, 'products');
        Product::destroy($id);
        return redirect()->back()->with('success', "Product Deleted Succesfully");
    }

    public function returnWithMessage($request)
    {
        if ($request->page == "index") {
            return redirect()->route('products.index')->with('success', "Product Updated Succesfully");
        } else {
            return redirect()->back()->with('success', "Product Updated Succesfully");
        }
    }
}
