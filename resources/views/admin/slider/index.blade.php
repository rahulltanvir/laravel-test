@extends('admin.master')

@section('body')

<div class="container-fluid">

    <h4 class="mb-4">Add Slider</h4>

    <div class="card">

        <div class="card-body">

            <form action="{{ route('sliders.store') }}" method="POST" enctype="multipart/form-data">

                @csrf


                <div class="mb-3">
                    <label>Title</label>
                    <input type="text" 
                           name="title" 
                           class="form-control"
                           required>
                </div>


                <div class="mb-3">
                    <label>Price</label>
                    <input type="text" 
                           name="price" 
                           class="form-control">
                </div>


                <div class="mb-3">
                    <label>Description</label>

                    <textarea name="description" 
                              class="form-control"
                              rows="4"></textarea>
                </div>


                <div class="mb-3">
                    <label>Button Text</label>

                    <input type="text"
                           name="button_text"
                           class="form-control">
                </div>


                <div class="mb-3">
                    <label>Button Link</label>

                    <input type="text"
                           name="button_link"
                           class="form-control">
                </div>


                <div class="mb-3">
                    <label>Slider Image</label>

                    <input type="file"
                           name="image"
                           class="form-control"
                           required>
                </div>


                <div class="mb-3">
                    <label>Serial</label>

                    <input type="number"
                           name="serial"
                           value="1"
                           class="form-control">
                </div>


                <div class="mb-3">

                    <label>Status</label>

                    <select name="status" class="form-control">

                        <option value="1">Active</option>

                        <option value="0">Inactive</option>

                    </select>

                </div>


                <button type="submit" class="btn btn-primary">
                    Save Slider
                </button>


            </form>

        </div>

    </div>

</div>

@endsection