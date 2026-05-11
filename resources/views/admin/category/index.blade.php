@extends('admin.master')

@section('body')
    <div class="row mt-3">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Add Category</h4>
                <hr/>
                    <form class="form-horizontal p-t-20">
                        <div class="form-group row">
                            <label for="exampleInputuname3" class="col-sm-3 control-label">Category Name  </label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="ti-name"></i></span>
                                    <input type="text" class="form-control" name="name" id="exampleInputuname3"
                                        placeholder="Category Name">
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleInputEmail3" class="col-sm-3 control-label">Category Description</label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="ti-name"></i></span>
                                    <textarea type="text" class="form-control" id="exampleInputEmail3"
                                        placeholder="Category Description"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="form-label col-sm-3 control-label" for="web">Website</label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="ti-world"></i></span>
                                    <input type="text" class="form-control" id="web"
                                        placeholder="Enter Website Name">
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword4" class="col-sm-3 control-label">Password*</label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="ti-lock"></i></span>
                                    <input type="password" class="form-control" id="exampleInputpwd4"
                                        placeholder="Enter pwd">
                                </div>
                            </div>
                        </div>
                                        <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">File Upload1</h4>
                                <label for="input-file-now" class="form-label">Your so fresh input file — Default version</label>
                                <input type="file" id="input-file-now" class="dropify" />
                            </div>
                        </div>
                    </div>
                </div>
                        <div class="form-group row">
                            <div class="offset-sm-3 col-sm-9">
                                <label class="form-check m-b-0">
                                    <input type="checkbox" class="form-check-input">
                                    <span class="form-check-label">Check me out !</span>
                                </label>
                            </div>
                        </div>
                        <div class="form-group row m-b-0">
                            <div class="offset-sm-3 col-sm-9">
                                <button type="submit" class="btn btn-success waves-effect waves-light text-white">Sign
                                    in</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
