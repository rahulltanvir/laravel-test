@extends('admin.master')

@section('body')

<div class="container-fluid">

    <h4 class="mb-4">Edit Slider</h4>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- Validation Errors --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card">

        <div class="card-body">

            <form action="{{ route('sliders.update', $slider->id) }}"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf
                @method('PUT')


                {{-- Title --}}
                <div class="mb-3">
                    <label class="form-label">Title</label>

                    <input type="text"
                           name="title"
                           value="{{ old('title', $slider->title) }}"
                           class="form-control"
                           required>
                </div>


                {{-- Price --}}
                <div class="mb-3">
                    <label class="form-label">Price</label>

                    <input type="text"
                           name="price"
                           value="{{ old('price', $slider->price) }}"
                           class="form-control">
                </div>


                {{-- Description --}}
                <div class="mb-3">
                    <label class="form-label">Description</label>

                    <textarea name="description"
                              class="form-control"
                              rows="4">{{ old('description', $slider->description) }}</textarea>
                </div>


                {{-- Button Text --}}
                <div class="mb-3">
                    <label class="form-label">Button Text</label>

                    <input type="text"
                           name="button_text"
                           value="{{ old('button_text', $slider->button_text) }}"
                           class="form-control">
                </div>


                {{-- Button Link --}}
                <div class="mb-3">
                    <label class="form-label">Button Link</label>

                    <input type="text"
                           name="button_link"
                           value="{{ old('button_link', $slider->button_link) }}"
                           class="form-control">
                </div>


                {{-- Current Image --}}
                <div class="mb-3">

                    <label class="form-label">Current Slider Image</label>

                    <div class="mt-2">
                        @if($slider->image)
                            <img src="{{ asset('uploads/sliders/' . $slider->image) }}"
                                 width="250"
                                 height="120"
                                 style="object-fit: cover;"
                                 class="img-thumbnail">
                        @else
                            <p class="text-muted">No image available</p>
                        @endif
                    </div>

                </div>


                {{-- New Image --}}
                <div class="mb-3">

                    <label class="form-label">Change Slider Image</label>

                    <input type="file"
                           name="image"
                           class="form-control"
                           accept="image/jpeg,image/png,image/jpg,image/webp">

                    <small class="text-muted">
                        Leave empty if you don't want to change the current image.
                    </small>

                </div>


                {{-- Serial --}}
                <div class="mb-3">

                    <label class="form-label">Serial</label>

                    <input type="number"
                           name="serial"
                           value="{{ old('serial', $slider->serial) }}"
                           class="form-control"
                           required>

                </div>


                {{-- Status --}}
                <div class="mb-3">

                    <label class="form-label">Status</label>

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

                <a href="{{ route('sliders.index') }}"
                   class="btn btn-secondary">
                    Back
                </a>

            </form>

        </div>

    </div>

</div>

@endsection