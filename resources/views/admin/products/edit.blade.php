@extends('admin.master')

@section('body')

<div class="row mt-3">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">

                <h4 class="card-title">Edit Product</h4>
                <hr>

                <form method="POST"
                      action="{{ route('product.update', $product->id) }}"
                      enctype="multipart/form-data">

                    @csrf
                    @method('PUT')

                    {{-- CATEGORY --}}
                    <div class="form-group row">
                        <label class="col-sm-3">Category *</label>

                        <div class="col-sm-9">
                            <select name="category_id" id="categoryId" class="form-control">

                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach

                            </select>
                        </div>
                    </div>

                    {{-- SUBCATEGORY --}}
                    <div class="form-group row">
                        <label class="col-sm-3">Sub Category *</label>

                        <div class="col-sm-9">
                            <select name="subcategory_id" id="subcategoryId" class="form-control">

                                <option value="{{ $product->subcategory_id }}">
                                    {{ $product->subcategory->name ?? 'Select Subcategory' }}
                                </option>

                            </select>
                        </div>
                    </div>

                    {{-- BRAND --}}
                    <div class="form-group row">
                        <label class="col-sm-3">Brand</label>

                        <div class="col-sm-9">
                            <select name="brand_id" class="form-control">

                                @foreach($brands as $brand)
                                    <option value="{{ $brand->id }}"
                                        {{ $product->brand_id == $brand->id ? 'selected' : '' }}>
                                        {{ $brand->name }}
                                    </option>
                                @endforeach

                            </select>
                        </div>
                    </div>

                    {{-- UNIT --}}
                    <div class="form-group row">
                        <label class="col-sm-3">Unit</label>

                        <div class="col-sm-9">
                            <select name="unit_id" class="form-control">

                                @foreach($units as $unit)
                                    <option value="{{ $unit->id }}"
                                        {{ $product->unit_id == $unit->id ? 'selected' : '' }}>
                                        {{ $unit->name }}
                                    </option>
                                @endforeach

                            </select>
                        </div>
                    </div>

                    {{-- NAME --}}
                    <div class="form-group row">
                        <label class="col-sm-3">Product Name *</label>

                        <div class="col-sm-9">
                            <input type="text"
                                   name="name"
                                   class="form-control"
                                   value="{{ $product->name }}">
                        </div>
                    </div>

                    {{-- SLUG --}}
                    <div class="form-group row">
                        <label class="col-sm-3">Slug</label>

                        <div class="col-sm-9">
                            <input type="text"
                                   name="slug"
                                   class="form-control"
                                   value="{{ $product->slug }}">
                        </div>
                    </div>

                    {{-- SKU --}}
                    <div class="form-group row">
                        <label class="col-sm-3">SKU</label>

                        <div class="col-sm-9">
                            <input type="text"
                                   name="sku"
                                   class="form-control"
                                   value="{{ $product->sku }}">
                        </div>
                    </div>

                    {{-- PRODUCT CODE --}}
                    <div class="form-group row">
                        <label class="col-sm-3">Product Code *</label>

                        <div class="col-sm-9">
                            <input type="text"
                                   name="product_code"
                                   class="form-control"
                                   value="{{ $product->product_code }}">
                        </div>
                    </div>

                    {{-- STOCK --}}
                    <div class="form-group row">
                        <label class="col-sm-3">Stock *</label>

                        <div class="col-sm-9">
                            <input type="number"
                                   name="stock"
                                   class="form-control"
                                   value="{{ $product->stock }}">
                        </div>
                    </div>

                    {{-- PRICE --}}
                    <div class="form-group row">

                        <label class="col-sm-3">Regular Price</label>

                        <div class="col-sm-4">
                            <input type="number"
                                   name="regular_price"
                                   class="form-control"
                                   value="{{ $product->regular_price }}">
                        </div>

                        <label class="col-sm-1">Sale</label>

                        <div class="col-sm-4">
                            <input type="number"
                                   name="sale_price"
                                   class="form-control"
                                   value="{{ $product->sale_price }}">
                        </div>

                    </div>

                    {{-- DISCOUNT --}}
                    <div class="form-group row">
                        <label class="col-sm-3">Discount (%)</label>

                        <div class="col-sm-9">
                            <input type="number"
                                   name="discount"
                                   class="form-control"
                                   value="{{ $product->discount }}">
                        </div>
                    </div>

                    {{-- DESCRIPTION --}}
                    <div class="form-group row">
                        <label class="col-sm-3">Short Description</label>

                        <div class="col-sm-9">
                            <textarea name="short_description"
                                      class="form-control">{{ $product->short_description }}</textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3">Long Description</label>

                        <div class="col-sm-9">
                            <textarea name="long_description"
                                      class="form-control summernote">{{ $product->long_description }}</textarea>
                        </div>
                    </div>

                    {{-- CURRENT IMAGE --}}
                    <div class="form-group row">
                        <label class="col-sm-3">Current Image</label>

                        <div class="col-sm-9">
                            @if($product->thumbnail)
                                <img src="{{ asset($product->thumbnail) }}"
                                     width="100">
                            @endif
                        </div>
                    </div>

                    {{-- NEW IMAGE --}}
                    <div class="form-group row">
                        <label class="col-sm-3">Change Image</label>

                        <div class="col-sm-9">
                            <input type="file" name="thumbnail" class="dropify">
                        </div>
                    </div>

                    {{-- STATUS --}}
                    <div class="form-group row">
                        <label class="col-sm-3">Status</label>

                        <div class="col-sm-9">

                            <label>
                                <input type="radio"
                                       name="status"
                                       value="1"
                                       {{ $product->status == 1 ? 'checked' : '' }}>
                                Active
                            </label>

                            <label class="ms-3">
                                <input type="radio"
                                       name="status"
                                       value="0"
                                       {{ $product->status == 0 ? 'checked' : '' }}>
                                Inactive
                            </label>

                        </div>
                    </div>

                    {{-- BUTTON --}}
                    <button type="submit" class="btn btn-success mt-3">
                        Update Product
                    </button>

                </form>

            </div>
        </div>
    </div>
</div>

@endsection