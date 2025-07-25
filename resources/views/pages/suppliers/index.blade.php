@extends('layout.app')
@section('content')
    <div class="content container-fluid">

        @if (session('success'))
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    toastr.success('{{ session('success') }}', 'Success');
                });
            </script>
        @endif


        <div class="page-header">
            <div class="row">
                <div class="col">
                    <h3 class="page-title">Supplier Records</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active">Supplier Records</li>
                    </ul>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-2">Supplier Records</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="datatable table table-stripped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Supplier Name</th>
                                        <th>Supplier Phone No</th>
                                        <th>Supplier Email</th>
                                        <th>Address</th>
                                        <th>Actions</th>
                                    </tr>


                                </thead>
                                @foreach ($values as $supplier)
                                    <tbody>
                                        <tr>
                                            <td>{{ $supplier->id }}</td>
                                            <td>{{ $supplier->supplier_name }}</td>
                                            <td>{{ $supplier->phone_no }}</td>
                                            <td>{{ $supplier->email }}</td>
                                            <td>{{ $supplier->address ?? 'N/A' }}</td>
                                            <td>
                                                <a href="{{ route('suppliers.edit', $supplier) }}" class="btn btn-primary">Edit</a>
                                                <form id="deleteRecord-{{ $supplier->id }}" action="{{ route('suppliers.destroy', $supplier) }}" method="POST"
                                                    style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" onclick="confirmDelete({{ $supplier->id}})" class="btn btn-danger">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    </tbody>
                                @endforeach
                            </table>
                        </div>
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
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
            }).then((result) => {
            if (result.isConfirmed) {
               document.getElementById('deleteRecord-'+id).submit();
            }
            });
        }
    </script>

@endsection
