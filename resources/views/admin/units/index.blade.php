@extends('admin.master')

@section('body')
    <div class="row mt-3">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">Add Unit</h4>
                    <hr />
                    <form class="form-horizontal p-t-20" method="POST" action="{{ route('unit.store') }}" enctype="multipart/form-data">
                       @csrf
                        <div class="form-group row">
                            <label for="exampleInputuname3" class="col-sm-3 control-label">unit Name<span
                                    class="required text-danger">*</span> </label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="unit_name" id="exampleInputuname3"
                                        placeholder="Unit Name" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleInputuname3" class="col-sm-3 control-label">unit code<span
                                    class="required text-danger">*</span> </label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="unit_code" id="exampleInputuname3"
                                        placeholder="unit Code" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleInputEmail3" class="col-sm-3 control-label">Unit Description<span
                                    class="required text-danger">*</span></label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <textarea type="text" class="form-control" name="unit_description" id="exampleInputEmail3" placeholder="Unit Description" required></textarea>
                                </div>
                            </div>
                        </div>
                    
                        <div class="form-group row">
                            <label class="col-sm-3 control-label">
                                Unit Status <span class="text-danger">*</span>
                            </label>

                            <div class="col-sm-9">

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="unit_status" id="publish"
                                        value="1" required>

                                    <label class="form-check-label" for="publish">
                                        Publish
                                    </label>
                                </div>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="unit_status" id="unpublish"
                                        value="0"required>

                                    <label class="form-check-label" for="unpublish">
                                        Unpublish
                                    </label>
                                </div>

                            </div>
                        </div>


                        <div class="form-group row m-b-0">
                            <div class="offset-sm-3 col-sm-9">
                                <button type="submit" class="btn btn-success waves-effect waves-light text-white">
                                    Create New Unit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
