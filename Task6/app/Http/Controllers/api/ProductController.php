<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Subcategory;
use App\Http\Traits\media;
use App\Http\Traits\apiResponse;

class ProductController extends Controller
{
    use media, apiResponse;

    public function index()
    {
        $products = Product::paginate(5);
        if ($products) {
            return $this->responseJson(200, "Success", compact('products'));
        } else {
            return $this->responseJson(422, "No Products Found");
        }
    }

    public function create()
    {
        $subcategories = Subcategory::where('status', '1')->get();
        $brands = Brand::where('status', '1')->get();
        return $this->responseJson(200, "Success", compact('subcategories', 'brands'));
    }

    public function store(StoreProductRequest $request)
    {
        // Upload Image
        $imageName = $this->uploadImage($request->image, 'products');
        // insert Data Into DB
        $product = Product::create([
            'name_en' => $request->name_en,
            'name_ar' => $request->name_ar,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'status' => $request->status,
            'subcategory_id' => $request->subcategory_id,
            'brand_id' => $request->brand_id,
            'desc_ar' => $request->desc_ar,
            'desc_en' => $request->desc_en,
            'image' => $imageName
        ]);
        if ($product) {
            return $this->responseJson(200, "Product Added Successfully");
        } else {
            return $this->responseJson(422, "Something Went Wrong, try again later");
        }
    }
    public function edit($id)
    {
        $product = Product::find($id);
        if ($product) {
            $subcategories = Subcategory::where('status', '1')->get();
            $brands = Brand::where('status', '1')->get();
            return $this->responseJson(200, "Product Found Successfully", compact('subcategories', 'brands'));
        } else {
            return $this->responseJson(422, "Product id Doesn't Found");
        }
    }

    public function update(UpdateProductRequest $request, $id)
    {
        $product = Product::find($id);
        if ($product) {
            if ($request->has('image')) {
                $this->deleteImage($product->image, 'products');
                $imageName = $this->uploadImage($request->image, 'products');
                Product::where('id', $product->id)->update(['image' => $imageName]);
            }

            Product::where('id', $product->id)->Update([
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
            return $this->responseJson(200, "Product Updated Successfully");
        } else {
            return $this->responseJson(422, "Product id Doesn't Found");
        }
    }

    public function delete($id)
    {
        $product = Product::find($id);
        if ($product) {
            $this->deleteImage($product->image, 'products');
            Product::destroy($product->id);
            return $this->responseJson(200, "Product Deleted Successfully");
        } else {
            return $this->responseJson(422, "Product id Doesn't Found");
        }
    }
}
