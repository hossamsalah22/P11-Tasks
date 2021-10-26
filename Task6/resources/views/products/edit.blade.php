@extends('layouts.layout');
@section('title', 'Edit Product');


@section('content')

    <form action="{{ route('products.update',$product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-row">
            <div class="col-6">
                <label for="">Name Ar</label>
                <input type="text" name="name_ar" id="" class="form-control" value="{{ $product->name_ar }}">
                @error('name_ar')
                <div class="alert alert-danger mt-2">{{ $message }}</div>
            @enderror
            </div>
            <div class="col-6">
                <label for="">Name En</label>
                <input type="text" name="name_en" id="" class="form-control" value="{{ $product->name_en }}">
                @error('name_en')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-6">
                <label for="">Price</label>
                <input type="number" name="price" id="" class="form-control" value="{{ $product->price }}">
                @error('price')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-6">
                <label for="">Quantity</label>
                <input type="number" name="quantity" id="" class="form-control" value="{{ $product->quantity }}">
                @error('quantity')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-4">
                <label for="">status</label>
                <select name="status" id="" class="form-control">
                    <option value="1">Available</option>
                    <option value="0">Not Available</option>
                </select>
                @error('status')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-4">
                <label for="">Subcategory</label>
                <select name="subcategory_id" id="" class="form-control">
                    @foreach ($subcategories as $subcategory)
                        <option value="{{ $subcategory->id }}" {{$product->subcategory_id == $subcategory->id ? 'selected' : ''}}>
                            {{ $subcategory->name_en }}</option>
                    @endforeach
                </select>
                @error('subcategory_id')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-4">
                <label for="">Brand</label>
                <select name="brand_id" id="" class="form-control">
                    <option value="">No Brand</option>
                    @foreach ($brands as $brand)
                        <option value="{{ $brand->id }}" {{$product->brand_id == $brand->id ? 'selected' : ''}}>
                            {{ $brand->name_en }}</option>
                    @endforeach
                </select>
                @error('brand_id')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-6">
                <label for="">Desc Ar</label>
                <textarea name="desc_ar" id="" cols="30" rows="10" style="resize:none"
                    class="form-control"> {{ $product->desc_ar }}</textarea>
                    @error('desc_ar')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
            </div>
            <div class="col-6">
                <label for="">Desc En</label>
                <textarea name="desc_en" id="" cols="30" rows="10" style="resize:none"
                    class="form-control">{{ $product->desc_en }}</textarea>
                    @error('desc_en')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
            </div>
            <div class="col-12 py-3">
                <img src="{{url('images/products/' . $product->image)}}" alt="" class="w-100">
                <input type="file" name="image" id="" class="form-control mt-3">
                @error('image')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="form-row">
            <div class="col-3">
                <button class="btn btn-primary rounded form-control" name="page" value="index">Update</button>
            </div>
            <div class="col-3">
                <button class="btn btn-dark rounded form-control" name="page" value="back">Update & Return</button>
            </div>
        </div>
    </form>
@endsection
