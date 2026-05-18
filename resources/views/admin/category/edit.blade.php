@extends('admin.master')

@section('body')
    <div class="row mt-3">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">Update Category</h4>
                    <hr />
                    <form class="form-horizontal p-t-20" method="POST" action="{{ route('category.update', $category->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group row">
                            <label for="exampleInputuname3" class="col-sm-3 control-label">Category Update Name<span
                                    class="required text-danger">*</span> </label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="up_cat_name" id="exampleInputuname3"
                                        value="{{ $category->name }}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleInputEmail3" class="col-sm-3 control-label">Category Update Description<span
                                    class="required text-danger">*</span></label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <textarea type="text" class="form-control" name="up_cat_description" id="exampleInputEmail3"
                                        value="" >{{$category->description }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="form-label col-sm-3 control-label" for="web">Change Image <span
                                    class=" text-danger">*</span> </label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    @if ($category->image)
                                        <div class="mb-2">
                                            <img src="{{ asset('uploads/category/' . $category->image) }}" width="120"
                                                style="border-radius: 8px;">
                                        </div>
                                    @endif
                                    <input type="file" id="input-file-now" name="up_cat_img"
                                        class="dropify control-label" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 control-label">
                                Category Status <span class="text-danger">*</span>
                            </label>

                            <div class="col-sm-9">

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="up_cat_status" id="publish"
                                        value="1" {{ $category->status==1 ? 'checked' : '' }} >

                                    <label class="form-check-label" for="publish">
                                        Publish
                                    </label>
                                </div>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="up_cat_status" id="unpublish"
                                        value="0" {{ $category->status==0 ? 'checked' : '' }}>

                                    <label class="form-check-label" for="unpublish">
                                        Unpublish
                                    </label>
                                </div>

                            </div>
                        </div>


                        <div class="form-group row m-b-0">
                            <div class="offset-sm-3 col-sm-9">
                                <button type="submit" class="btn btn-success waves-effect waves-light text-white">
                                    Create New Category</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
