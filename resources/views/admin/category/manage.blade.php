@extends('admin.master')

@section('body')
    <div class="row mt-3">
        <div class="col-12 ">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Category Table</h4>
                    
@if(session('success'))
<script>
document.addEventListener("DOMContentLoaded", function () {
    Swal.fire({
        icon: 'success',
        title: 'Success!',
        text: "{{ session('success') }}",
        timer: 2000,
        showConfirmButton: false
    });
});
</script>
@endif
                    <div class="table-responsive m-t-40">
                        <table id="myTable" class="table table-striped border">
                            <thead>
                                <tr>
                                    <th>Sl No</th>
                                    <th>Category name</th>
                                    <th>Category Image</th>
                                    <th>Category Description</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $key => $category)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>

                                        <td>{{ $category->name }}</td>

                                        <td>
                                            <img src="{{ asset('uploads/category/' . $category->image) }}" width="60">
                                        </td>

                                        <td>{{ $category->description }}</td>

                                        <td>
                                            @if ($category->status == 1)
                                                <span class="badge bg-success">Publish</span>
                                            @else
                                                <span class="badge bg-danger">Unpublish</span>
                                            @endif
                                        </td>

                                        <td>
                                            <a href="#"
                                                class="btn btn-success btn-sm">
                                                <i class="fa fa-edit"></i>
                                            </a>

                                            <a href=""
                                                class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
