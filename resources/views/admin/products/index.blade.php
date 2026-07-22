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
                            <label class="col-sm-3 control-label">Category *</label>
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
                            <label class="col-sm-3 control-label">Sub Category *</label>
                            <div class="col-sm-9">
                                <select name="subcategory_id" id="subcategoryId" class="form-control">
                                    <option value="">--Select Subcategory--</option>
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
                            <label class="col-sm-3 control-label">Product Name *</label>
                            <div class="col-sm-9">
                                <input type="text" name="name" class="form-control" placeholder="Product Name">
                            </div>
                        </div>

                        {{-- Slug --}}
                        <div class="form-group row">
                            <label class="col-sm-3 control-label">Slug</label>
                            <div class="col-sm-9">
                                <input type="text" name="slug" class="form-control" placeholder="product-slug">
                            </div>
                        </div>

                        {{-- SKU --}}
                        <div class="form-group row">
                            <label class="col-sm-3 control-label">SKU</label>
                            <div class="col-sm-9">
                                <input type="text" name="sku" class="form-control" placeholder="SKU">
                            </div>
                        </div>

                        {{-- Product Code --}}
                        <div class="form-group row">
                            <label class="col-sm-3 control-label">Product Code *</label>
                            <div class="col-sm-9">
                                <input type="text" name="product_code" class="form-control" placeholder="Product Code">
                            </div>
                        </div>

                        {{-- Stock --}}
                        <div class="form-group row">
                            <label class="col-sm-3 control-label">Stock *</label>
                            <div class="col-sm-9">
                                <input type="number" name="stock" class="form-control" placeholder="Stock">
                            </div>
                        </div>
                        {{-- Product Weight --}}
                        <div class="form-group row">
                            <label class="col-sm-3 control-label">Product Weight (KG)</label>
                            <div class="col-sm-9">
                                <input type="number" step="0.01" name="product_weight" class="form-control"
                                    placeholder="Product Weight">
                            </div>
                        </div>

                        {{-- Price --}}
                        <div class="form-group row">
                            <label class="col-sm-3 control-label">Regular Price *</label>
                            <div class="col-sm-4">
                                <input type="number" name="regular_price" class="form-control" placeholder="Regular Price">
                            </div>

                            <label class="col-sm-1 control-label">Sale Price</label>
                            <div class="col-sm-4">
                                <input type="number" name="sale_price" class="form-control" placeholder="Sale Price">
                            </div>
                        </div>

                        {{-- Discount --}}
                        <div class="form-group row">
                            <label class="col-sm-3 control-label">Discount (%)</label>
                            <div class="col-sm-9">
                                <input type="number" name="discount" class="form-control" placeholder="Discount %">
                            </div>
                        </div>

                        {{-- Short Description --}}
                        <div class="form-group row">
                            <label class="col-sm-3 control-label">Short Description</label>
                            <div class="col-sm-9">
                                <textarea name="short_description" class="form-control summernote"></textarea>
                            </div>
                        </div>

                        {{-- Long Description --}}
                        <div class="form-group row" id="Long-Description">
                            <label class="col-sm-3 control-label">Long Description</label>
                            <div class="col-sm-9">
                                <textarea name="long_description" class="form-control summernote"></textarea>
                            </div>
                        </div>

                        {{-- Thumbnail --}}
                        <div class="form-group row">
                            <label class="col-sm-3 control-label">Thumbnail *</label>
                            <div class="col-sm-9">
                                <input type="file" name="thumbnail" class="dropify">
                            </div>
                        </div>

                        {{-- Gallery Images --}}
                        <div class="form-group row">
                            <label class="col-sm-3 control-label">Gallery Images</label>
                            <div class="col-sm-9">
                                <input type="file" name="images[]" multiple class="form-control dropify ">
                            </div>
                        </div>

                        {{-- Specifications --}}
                        {{-- <div class="form-group row">
                        <label class="col-sm-3 control-label">Specifications</label>
                        <div class="col-sm-9">

                            <div id="specification_area">

                                <div class="row mb-2 spec-row">

                                    <div class="col-md-5">
                                        <input type="text" name="spec_key[]" class="form-control" placeholder="Key">
                                    </div>

                                    <div class="col-md-5">
                                        <input type="text" name="spec_value[]" class="form-control" placeholder="Value">
                                    </div>

                                    <div class="col-md-2">
                                        <button type="button" class="btn btn-success addMoreSpec">+</button>
                                    </div>

                                </div>

                            </div>

                        </div>
                    </div> --}}

                        {{-- Featured --}}
                        <div class="form-group row">
                            <label class="col-sm-3 control-label">Featured</label>
                            <div class="col-sm-9">
                                <input type="checkbox" name="featured" value="1"> Yes
                            </div>
                        </div>

                        {{-- Status --}}
                        <div class="form-group row">
                            <label class="col-sm-3 control-label">Status</label>
                            <div class="col-sm-9">
                                <label><input type="radio" name="status" value="1" checked> Active</label>
                                <label><input type="radio" name="status" value="0"> Inactive</label>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-success mt-3">
                            Save Product
                        </button>

                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection


@push('scripts')
    <script>
        // Subcategory AJAX
        $(document).on('change', '#categoryId', function() {

            let categoryId = $(this).val();
            let $sub = $('#subcategoryId');

            $sub.html('<option value="">--Select Subcategory--</option>');

            if (!categoryId) return;

            $.ajax({
                url: '/product/get-subcategories/' + categoryId,
                type: 'GET',
                dataType: 'json',

                success: function(res) {

                    if (res.data.length > 0) {

                        $.each(res.data, function(i, item) {
                            $sub.append(`<option value="${item.id}">${item.name}</option>`);
                        });

                    } else {
                        $sub.html('<option>No Subcategory Found</option>');
                    }

                }
            });

        });


        // Add More Specification
        $(document).on('click', '.addMoreSpec', function() {

            $('#specification_area').append(`

        <div class="row mb-2 spec-row">

            <div class="col-md-5">
                <input type="text" name="spec_key[]" class="form-control" placeholder="Key">
            </div>

            <div class="col-md-5">
                <input type="text" name="spec_value[]" class="form-control" placeholder="Value">
            </div>

            <div class="col-md-2">
                <button type="button" class="btn btn-danger removeSpec">X</button>
            </div>

        </div>

    `);

        });

        $(document).on('click', '.removeSpec', function() {
            $(this).closest('.spec-row').remove();
        });
    </script>
@endpush
