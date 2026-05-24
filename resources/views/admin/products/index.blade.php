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
                                    <option value="{{ $category->id }}">
                                        {{ $category->name }}
                                    </option>
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
                                    <option value="{{ $brand->id }}">
                                        {{ $brand->name }}
                                    </option>
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
                                    <option value="{{ $unit->id }}">
                                        {{ $unit->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    {{-- Product Name --}}
                    <div class="form-group row">
                        <label class="col-sm-3 control-label">
                            Product name <span class="text-danger">*</span>
                        </label>

                        <div class="col-sm-9">
                            <input type="text"
                                   name="name"
                                   class="form-control mt-2"
                                   placeholder="Product Name">
                        </div>
                    </div>

                    {{-- Product Code --}}
                    <div class="form-group row">
                        <label class="col-sm-3 control-label">
                            Product Code <span class="text-danger">*</span>
                        </label>

                        <div class="col-sm-9">
                            <input type="text"
                                   name="product_code"
                                   class="form-control mt-2"
                                   placeholder="Product Code">
                        </div>
                    </div>

                    {{-- Stock --}}
                    <div class="form-group row">
                        <label class="col-sm-3 control-label">
                            Product Stock <span class="text-danger">*</span>
                        </label>

                        <div class="col-sm-9">
                            <input type="number"
                                   name="stock"
                                   class="form-control mt-2"
                                   placeholder="Stock">
                        </div>
                    </div>

                    {{-- Price --}}
                    <div class="form-group row">

                        <label class="col-sm-3 control-label">
                            Reguler Price <span class="text-danger">*</span>
                        </label>

                        <div class="col-sm-4">
                            <input type="number"
                                   name="regular_price"
                                   class="form-control mt-2"
                                   placeholder="Regular Price">
                        </div>

                        <label class="col-sm-1 control-label">
                            Sale Price <span class="text-danger">*</span>
                        </label>

                        <div class="col-sm-4">
                            <input type="number"
                                   name="sale_price"
                                   class="form-control mt-2"
                                   placeholder="Sale Price">
                        </div>

                    </div>

                    {{-- Description --}}
                    <div class="form-group row">
                        <label class="col-sm-3 control-label">
                            Product Specification <span class="text-danger">*</span>
                        </label>

                        <div class="col-sm-9">
                            <textarea name="short_description"
                                      class="form-control mt-2"></textarea>
                        </div>
                    </div>

                    {{-- Long Description --}}
                    <div class="form-group row">
                        <label class="col-sm-3 control-label">
                            Product Description <span class="text-danger">*</span>
                        </label>

                        <div class="col-sm-9">
                            <textarea name="long_description"
                                      class="form-control summernote mt-2"></textarea>
                        </div>
                    </div>

                    {{-- Image --}}
                    <div class="form-group row">
                        <label class="col-sm-3 control-label">
                            Product Image <span class="text-danger">*</span>
                        </label>

                        <div class="col-sm-9">
                            <input type="file"
                                   name="image"
                                   class="dropify mt-2">
                        </div>
                    </div>

                    {{-- Status --}}
                    <div class="form-group row">
                        <label class="col-sm-3 control-label">
                            Product Status <span class="text-danger">*</span>
                        </label>

                        <div class="col-sm-9">
                            <label>
                                <input type="radio" name="status" value="1" checked>
                                Active
                            </label>

                            <label>
                                <input type="radio" name="status" value="0">
                                Inactive
                            </label>
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

$(document).on('change', '#categoryId', function () {

    let categoryId = $(this).val();

    let $sub = $('#subcategoryId');

    $sub.html('<option value="">--Select Subcategory--</option>');

    if (categoryId == '' || categoryId == null) {
        return;
    }

    $.ajax({

        url: '/product/get-subcategories/' + categoryId,
        type: 'GET',
        dataType: 'json',

        success: function (res) {

            console.log(res);

            if (res.data.length > 0) {

                $.each(res.data, function (i, item) {

                    $sub.append(
                        `<option value="${item.id}">${item.name}</option>`
                    );

                });

            } else {

                $sub.html(
                    '<option value="">No Subcategory Found</option>'
                );

            }

        },

        error: function (err) {

            console.log(err.responseText);

        }

    });

});

</script>

@endpush