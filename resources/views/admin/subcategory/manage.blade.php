@extends('admin.master')

@section('body')
    <div class="row mt-3">
        <div class="col-12 ">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Sub Category Table</h4>

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
                                    <th>Sub Category name</th>
                                    <th>Sub Category Image</th>
                                    <th>Sub Category Description</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($subcategories as $key => $subcategory)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>

                                        <td>{{ $subcategory->category->name }}</td>
                                        <td>{{ $subcategory->name }}</td>

                                        <td>
                                            <img src="{{ asset('uploads/subcategory/' . $subcategory->image) }}" width="60">
                                        </td>

                                        <td>{{ $subcategory->description }}</td>

                                        <td>
                                            @if ($subcategory->status == 1)
                                                <span class="badge bg-success">Publish</span>
                                            @else
                                                <span class="badge bg-danger">Unpublish</span>
                                            @endif
                                        </td>

                                        <td>
                                            <a href=""
                                                class="btn btn-success btn-sm">
                                                <i class="fa fa-edit"></i>
                                            </a>

                                            <a href=""
                                                class="btn btn-danger btn-sm"
                                                onclick="event.preventDefault(); deleteConfirm(this);">

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
    <script>
function deleteConfirm(element) {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, delete it!',
        position: 'center'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = element.href;
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
