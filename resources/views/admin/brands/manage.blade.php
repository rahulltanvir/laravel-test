@extends('admin.master')

@section('body')
    <div class="row mt-3">
        <div class="col-12 ">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Category Table</h4>

                    @if (session('success'))
                        <script>
                            document.addEventListener("DOMContentLoaded", function() {
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
                                @foreach ($brands as $key => $brand)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>

                                        <td>{{ $brand->name }}</td>

                                        <td>
                                            <img src="{{ asset('uploads/brands/' . $brand->image) }}" width="60">
                                        </td>

                                        <td>{{ $brand->description }}</td>

                                        <td>
                                            @if ($brand->status == 1)
                                                <span class="badge bg-success">Publish</span>
                                            @else
                                                <span class="badge bg-danger">Unpublish</span>
                                            @endif
                                        </td>

                                        <td>
                                            <a href="{{ route('brand.edit', $brand->id) }}"
                                                class="btn btn-success btn-sm">
                                                <i class="fa fa-edit"></i>
                                            </a>

                                            <form id="delete-form-{{ $brand->id }}"
                                          action="{{ route('brand.delete', $brand->id) }}"
                                          method="POST"
                                          style="display:inline;">

                                        @csrf
                                        @method('DELETE')

                                        <button type="button"
                                            class="btn btn-danger btn-sm"
                                            onclick="confirmDelete({{$brand->id }})">
                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                        </button>

                                    </form>
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
  <script>
function confirmDelete(id) {
    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Yes, delete it!"
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('delete-form-' + id).submit();
        }
    });
}
</script>
@if (session('success'))
    @if (request()->routeIs('category.manage'))
        <script>
            document.addEventListener("DOMContentLoaded", function() {
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
@endif
@endsection
