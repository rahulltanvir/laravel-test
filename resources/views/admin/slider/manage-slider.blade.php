@extends('admin.master')

@section('body')

<div class="container-fluid">

    <div class="d-flex justify-content-between mb-3">
        <h4>Manage Slider</h4>

        <a href="{{ route('sliders.create') }}" class="btn btn-primary">
            Add Slider
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered">

        <thead>
            <tr>
                <th>#</th>
                <th>Image</th>
                <th>Title</th>
                <th>Serial</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>

        @foreach($sliders as $slider)

            <tr>
                <td>{{ $loop->iteration }}</td>

                <td>
                    <img src="{{ asset($slider->image) }}" width="120">
                </td>

                <td>{{ $slider->title }}</td>

                <td>{{ $slider->serial }}</td>

                <td>
                    {{ $slider->status ? 'Active' : 'Inactive' }}
                </td>

                <td>
                    <a href="{{ route('sliders.edit',$slider->id) }}"
                       class="btn btn-sm btn-warning">
                        Edit
                    </a>

                    <form action="{{ route('sliders.destroy',$slider->id) }}"
                          method="POST"
                          style="display:inline">

                        @csrf
                        @method('DELETE')

                        <button class="btn btn-sm btn-danger"
                                onclick="return confirm('Delete?')">
                            Delete
                        </button>

                    </form>
                </td>

            </tr>

        @endforeach

        </tbody>

    </table>

</div>

@endsection