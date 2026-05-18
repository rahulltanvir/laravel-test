@extends('admin.master')

@section('body')
    <div class="row mt-3">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">Update Sub Category</h4>
                    <hr />

                    <form action="{{ route('subcategory.update', $subcategory->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        {{-- Category Select --}}
                        <div class="form-group row">
                            <label class="col-sm-3 control-label">
                                Category Name
                                <span class="required text-danger">*</span>
                            </label>

                            <div class="col-sm-9">

                                <select class="form-control" name="up_category_id" required>
                                    <option value="" disabled selected>
                                        --Select Category--
                                    </option>

                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ $subcategory->category_id == $category->id ? 'selected' : '' }}>
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
                                <input type="text" class="form-control" name="up_subcat_name"
                                    value="{{ $subcategory->name }}">
                            </div>
                        </div>

                        {{-- Description --}}
                        <div class="form-group row">
                            <label class="col-sm-3 control-label">
                                Sub Category Description
                                <span class="required text-danger">*</span>
                            </label>

                            <div class="col-sm-9">
                                <textarea class="form-control" name="up_subcat_description" rows="4" placeholder="Sub Category Description">{{ $subcategory->description }}</textarea>
                            </div>
                        </div>

                        {{-- Image --}}
                        <div class="form-group row">
                            <label class="form-label col-sm-3 control-label" for="web">Change Image <span
                                    class=" text-danger">*</span> </label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    @if ($subcategory->image)
                                        <div class="mb-2">
                                            <img src="{{ asset('uploads/subcategory/' . $subcategory->image) }}"
                                                width="120" style="border-radius: 8px;">
                                        </div>
                                    @endif
                                    <input type="file" id="input-file-now" name="up_subcat_img"
                                        class="dropify control-label" />
                                </div>
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
                                    <input class="form-check-input" type="radio" name="up_subcat_status" id="publish"
                                        value="1" {{ $subcategory->status == 1 ? 'checked' : '' }}>

                                    <label class="form-check-label" for="publish">
                                        Publish
                                    </label>
                                </div>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="up_subcat_status" id="unpublish"
                                        value="0" {{ $subcategory->status == 0 ? 'checked' : '' }}>

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

                                    Update Sub Category

                                </button>

                            </div>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
