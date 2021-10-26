@extends('layouts.layout');
@section('title', 'Create Product');


@section('content')

    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-row">
            @include('messages.message')
            <div class="col-6">
                <label for="">Name Ar</label>
                <input type="text" name="name_ar" id="" class="form-control" value="{{ old('name_ar') }}">
                @error('name_ar')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-6">
                <label for="">Name En</label>
                <input type="text" name="name_en" id="" class="form-control" value="{{ old('name_en') }}">
                @error('name_en')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-6">
                <label for="">Price</label>
                <input type="number" name="price" id="" class="form-control" value="{{ old('price') }}">
                @error('price')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-6">
                <label for="">Quantity</label>
                <input type="number" name="quantity" id="" class="form-control" value="{{ old('quantity') }}">
                @error('quantity')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-4">
                <label for="">status</label>
                <select name="status" id="" class="form-control">
                    <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Available</option>
                    <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Not Available</option>
                </select>
                @error('status')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-4">
                <label for="">Subcategory</label>
                <select name="subcategory_id" id="" class="form-control">
                    @foreach ($subcategories as $subcategory)
                        <option value="{{ $subcategory->id }}"
                            {{ old('subcategory_id') == $subcategory->id ? 'selected' : '' }}>
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
                        <option value="{{ $brand->id }}" {{ old('brand_id') == $brand->id ? 'selected' : '' }}>
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
                    class="form-control">{{ old('desc_ar') }}</textarea>
                @error('desc_ar')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-6">
                <label for="">Desc En</label>
                <textarea name="desc_en" id="" cols="30" rows="10" style="resize:none"
                    class="form-control">{{ old('desc_en') }}</textarea>
                @error('desc_en')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-12 py-3">
                <input type="file" name="image" id="" class="form-control">
                @error('image')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="form-row">
            <div class="col-3">
                <button class="btn btn-primary rounded form-control" name="page" value="index">Create</button>
            </div>
            <div class="col-3">
                <button class="btn btn-dark rounded form-control" name="page" value="back">Create & Return</button>
            </div>
        </div>
    </form>
@endsection
