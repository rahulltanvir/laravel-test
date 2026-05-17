@extends('admin.master')

@section('body')
    <div class="row mt-3">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">Add Sub Category</h4>
                    <hr />

                    <form class="form-horizontal p-t-20" method="POST" action="{{ route('subcategory.store') }}" enctype="multipart/form-data">

                        @csrf

                        {{-- Category Select --}}
                        <div class="form-group row">
                            <label class="col-sm-3 control-label">
                                Category Name
                                <span class="required text-danger">*</span>
                            </label>

                            <div class="col-sm-9">

                                <select class="form-control" name="category_id" required>
                                    <option value="" disabled selected>
                                        --Select Category--
                                    </option>

                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>

                            </div>
                        </div>

                        {{-- Sub Category Name --}}
                        <div class="form-group row">
                            <label class="col-sm-3 control-label">
                                Sub Category Name
                                <span class="required text-danger">*</span>
                            </label>

                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="sub_cat_name"
                                    placeholder="Sub Category Name" required>
                            </div>
                        </div>

                        {{-- Description --}}
                        <div class="form-group row">
                            <label class="col-sm-3 control-label">
                                Sub Category Description
                                <span class="required text-danger">*</span>
                            </label>

                            <div class="col-sm-9">
                                <textarea class="form-control" name="sub_cat_description" rows="4" placeholder="Sub Category Description"
                                    required></textarea>
                            </div>
                        </div>

                        {{-- Image --}}
                        <div class="form-group row">
                            <label class="col-sm-3 control-label">
                                File Upload
                                <span class="required text-danger">*</span>
                            </label>

                            <div class="col-sm-9">
                                <input type="file" name="sub_cat_img" class="dropify" required>
                            </div>
                        </div>

                        {{-- Status --}}
                        <div class="form-group row">
                            <label class="col-sm-3 control-label">
                                Status
                                <span class="text-danger">*</span>
                            </label>

                            <div class="col-sm-9">

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="sub_cat_status" id="publish"
                                        value="1" required>

                                    <label class="form-check-label" for="publish">
                                        Publish
                                    </label>
                                </div>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="sub_cat_status" id="unpublish"
                                        value="0">

                                    <label class="form-check-label" for="unpublish">
                                        Unpublish
                                    </label>
                                </div>

                            </div>
                        </div>

                        {{-- Submit Button --}}
                        <div class="form-group row m-b-0">
                            <div class="offset-sm-3 col-sm-9">

                                <button type="submit" class="btn btn-success waves-effect waves-light text-white">

                                    Create New Sub Category

                                </button>

                            </div>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
