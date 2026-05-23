@extends('admin.master')

@section('body')
    <div class="row mt-3">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">Add Product</h4>
                    <hr>

                    <form method="POST" action="{{ route('product.store') }}" enctype="multipart/form-data">
                        @csrf

                        {{-- Category --}}
                        <div class="form-group row">
                            <label class="col-sm-3 control-label">Category <span class="text-danger">*</span></label>

                            <div class="col-sm-9">
                                <select name="category_id" id="categoryId" class="form-control" required>
                                    <option value="">-- Select Category --</option>

                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        {{-- Sub Category --}}
                        <div class="form-group row">
                            <label class="col-sm-3 control-label">Sub Category <span class="text-danger">*</span></label>

                            <div class="col-sm-9">
                                <select name="subcategory_id" id="subcategoryId" class="form-control">
                                    <option value="">-- Select subCategory --</option>
                                </select>
                            </div>
                        </div>

                        {{-- Brand --}}
                        <div class="form-group row">
                            <label class="col-sm-3 control-label">Brand</label>

                            <div class="col-sm-9">
                                <select name="brand_id" class="form-control">
                                    <option value="">-- Select Brand --</option>

                                    @foreach ($brands as $brand)
                                        <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        {{-- Unit --}}
                        <div class="form-group row">
                            <label class="col-sm-3 control-label">Unit</label>

                            <div class="col-sm-9">
                                <select name="unit_id" class="form-control">
                                    <option value="">-- Select Unit --</option>

                                    @foreach ($units as $unit)
                                        <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        {{-- Product Name --}}
                        <div class="form-group row">
                            <label class="col-sm-3 control-label">Product Name</label>

                            <div class="col-sm-9">
                                <input type="text" name="name" class="form-control" required>
                            </div>
                        </div>

                        {{-- Product Code --}}
                        <div class="form-group row">
                            <label class="col-sm-3 control-label">Product Code</label>

                            <div class="col-sm-9">
                                <input type="text" name="product_code" class="form-control" required>
                            </div>
                        </div>

                        {{-- Product Model --}}
                        <div class="form-group row">
                            <label class="col-sm-3 control-label">Product Model</label>

                            <div class="col-sm-9">
                                <input type="text" name="product_model" class="form-control">
                            </div>
                        </div>

                        {{-- Stock --}}
                        <div class="form-group row">
                            <label class="col-sm-3 control-label">Stock</label>

                            <div class="col-sm-9">
                                <input type="number" name="stock" class="form-control" required>
                            </div>
                        </div>

                        {{-- Price --}}
                        <div class="form-group row">
                            <label class="col-sm-3 control-label">Regular Price</label>

                            <div class="col-sm-4">
                                <input type="number" name="regular_price" class="form-control" required>
                            </div>

                            <label class="col-sm-1 control-label">Sale</label>

                            <div class="col-sm-4">
                                <input type="number" name="sale_price" class="form-control">
                            </div>
                        </div>

                        {{-- Short Description --}}
                        <div class="form-group row">
                            <label class="col-sm-3 control-label">Short Description</label>

                            <div class="col-sm-9">
                                <textarea name="short_description" class="form-control"></textarea>
                            </div>
                        </div>

                        {{-- Long Description --}}
                        <div class="form-group row">
                            <label class="col-sm-3 control-label">Long Description</label>

                            <div class="col-sm-9">
                                <textarea name="long_description" class="summernote"></textarea>
                            </div>
                        </div>

                        {{-- Image --}}
                        <div class="form-group row">
                            <label class="col-sm-3 control-label">Image</label>

                            <div class="col-sm-9">
                                <input type="file" name="image" class="dropify" required>
                            </div>
                        </div>

                        {{-- Status --}}
                        <div class="form-group row">
                            <label class="col-sm-3 control-label">Status</label>

                            <div class="col-sm-9">
                                <label class="mr-3">
                                    <input type="radio" name="status" value="1" checked> Active
                                </label>

                                <label>
                                    <input type="radio" name="status" value="0"> Inactive
                                </label>
                            </div>
                        </div>

                        {{-- Submit --}}
                        <div class="form-group row">
                            <div class="offset-sm-3 col-sm-9">
                                <button type="submit" class="btn btn-success">
                                    Save Product
                                </button>
                            </div>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection

