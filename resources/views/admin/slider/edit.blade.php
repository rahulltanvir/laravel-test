@extends('admin.master')

@section('body')

<div class="container-fluid">

    <h4 class="mb-4">Edit Slider</h4>

    <div class="card">

        <div class="card-body">

            <form action="{{ route('sliders.update', $slider->id) }}"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf
                @method('PUT')


                {{-- Title --}}
                <div class="mb-3">
                    <label>Title</label>

                    <input type="text"
                           name="title"
                           value="{{ old('title', $slider->title) }}"
                           class="form-control"
                           required>
                </div>


                {{-- Price --}}
                <div class="mb-3">
                    <label>Price</label>

                    <input type="text"
                           name="price"
                           value="{{ old('price', $slider->price) }}"
                           class="form-control">
                </div>


                {{-- Description --}}
                <div class="mb-3">
                    <label>Description</label>

                    <textarea name="description"
                              class="form-control"
                              rows="4">{{ old('description', $slider->description) }}</textarea>
                </div>


                {{-- Button Text --}}
                <div class="mb-3">
                    <label>Button Text</label>

                    <input type="text"
                           name="button_text"
                           value="{{ old('button_text', $slider->button_text) }}"
                           class="form-control">
                </div>


                {{-- Button Link --}}
                <div class="mb-3">
                    <label>Button Link</label>

                    <input type="text"
                           name="button_link"
                           value="{{ old('button_link', $slider->button_link) }}"
                           class="form-control">
                </div>


                {{-- Current Image --}}
                <div class="mb-3">
                    <label>Current Slider Image</label>

                    <br>

                    <img src="{{ asset($slider->image) }}"
                         width="250"
                         class="img-thumbnail">
                </div>


                {{-- New Image --}}
                <div class="mb-3">
                    <label>Change Slider Image</label>

                    <input type="file"
                           name="image"
                           class="form-control">
                </div>


                {{-- Serial --}}
                <div class="mb-3">
                    <label>Serial</label>

                    <input type="number"
                           name="serial"
                           value="{{ old('serial', $slider->serial) }}"
                           class="form-control"
                           required>
                </div>


                {{-- Status --}}
                <div class="mb-3">

                    <label>Status</label>

                    <select name="status" class="form-control">

                        <option value="1"
                            {{ old('status', $slider->status) == 1 ? 'selected' : '' }}>
                            Active
                        </option>

                        <option value="0"
                            {{ old('status', $slider->status) == 0 ? 'selected' : '' }}>
                            Inactive
                        </option>

                    </select>

                </div>


                {{-- Submit --}}
                <button type="submit" class="btn btn-primary">
                    Update Slider
                </button>

            </form>

        </div>

    </div>

</div>

@endsection