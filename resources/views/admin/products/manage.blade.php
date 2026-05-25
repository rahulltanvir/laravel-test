@extends('admin.master')

@section('body')

<div class="row mt-3">
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <h4 class="card-title">Product Table</h4>
                <hr>

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

                <div class="table-responsive mt-4">
                    <table id="myTable" class="table table-striped border">

                        <thead>
                            <tr>
                                <th>Sl</th>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Price</th>
                                <th>Stock</th>
                                <th>Image</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($products as $key => $product)
                                <tr>
                                    <td>{{ $key + 1 }}</td>

                                    <td>{{ $product->name }}</td>

                                    <td>{{ $product->category->name ?? 'N/A' }}</td>

                                    <td>{{ $product->regular_price }}</td>

                                    <td>{{ $product->stock }}</td>

                                    <td>
                                        <img src="{{ asset($product->thumbnail) }}"
                                             width="60"
                                             height="60"
                                             style="object-fit:cover;">
                                    </td>

                                    <td>
                                        @if($product->status == 1)
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-danger">Inactive</span>
                                        @endif
                                    </td>

                                    <td>

                                        <a href="{{ route('product.edit', $product->id) }}"
                                           class="btn btn-success btn-sm">
                                            <i class="fa fa-edit"></i>
                                        </a>

                                        <form id="delete-form-{{ $product->id }}"
                                              action="{{ route('product.delete', $product->id) }}"
                                              method="POST"
                                              style="display:inline;">

                                            @csrf
                                            @method('DELETE')

                                            <button type="button"
                                                    class="btn btn-danger btn-sm"
                                                    onclick="confirmDelete({{ $product->id }})">
                                                <i class="fa fa-trash"></i>
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
        text: "This product will be deleted permanently!",
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

@endsection