@extends('layouts.dashboard')

@section('content')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Brands</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Brands</li>
        </ol>
        <div class="card mb-4">
            <div class="card-header">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addBrand">
                    <i class="fas fa-plus"></i>
                    Add
                </button>
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($brands as $key => $brand)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $brand->name }}</td>
                                <td>
                                    <button type="button" class="btn btn-outline-primary btn-sm" title="Edit" data-bs-toggle="modal" data-bs-target="#editBrand" onclick="editBrand({{ $brand->id }}, '{{ $brand->name }}')"><i class="fa fa-edit"></i></button>
                                    <button type="button" class="btn btn-outline-danger btn-sm" data-bs-toggle="modal" data-bs-target="#removeBrand" onclick="removeBrand({{ $brand->id }}, '{{ $brand->name }}')"><i class="fa fa-trash" title="Delete"></i></button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>

{{-- Add Modal goes here! --}}
<!-- Modal -->
<div class="modal fade" id="addBrand" tabindex="-1" aria-labelledby="addBrandLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="addBrandLabel">Add Brand</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{ route('brands.store') }}" method="post">
            @csrf
            <div class="modal-body">
                <div class="row justify-content-center">
                    <div class="col-lg-12">
                        <div class="card shadow-lg border-0 rounded-lg mt-5">
                            <div class="card-body">
                                <div class="form-floating mb-3">
                                    <input class="form-control" id="brandName" name="name" type="text" placeholder="Brand Name" required value="" />
                                    <label for="brandName">Brand Name</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success">Save</button>
            </div>
        </form>
      </div>
    </div>
</div>


{{-- Edit Modal goes here! --}}
<!-- Modal -->
<div class="modal fade" id="editBrand" tabindex="-1" aria-labelledby="addBrandLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="editBrandLabel">Edit Brand <small>(<b id="editBrandName">Brand name</b>)</small></h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="#" method="POST" id="editBrandForm">
            @csrf
            @method('patch')
            <div class="modal-body">
                <div class="row justify-content-center">
                    <div class="col-lg-12">
                        <div class="card shadow-lg border-0 rounded-lg mt-5">
                            <div class="card-body">
                                <div class="form-floating mb-3">
                                    <input class="form-control" name="name" type="text" placeholder="Brand Name" required value="" />
                                    <label>Brand Name</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success">Update</button>
            </div>
        </form>
      </div>
    </div>
</div>

{{-- Remove Modal goes here! --}}
<!-- Modal -->
<div class="modal fade" id="removeBrand" tabindex="-1" aria-labelledby="removeBrandLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="editBrandLabel">Delete Brand <small>(<b id="removeBrandName">Brand name</b>)</small></h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="#" method="POST" id="removeBrandForm">
            @csrf
            @method('delete')
            <div class="modal-body">
                <div class="row justify-content-center">
                    <div class="col-lg-12">
                        <div class="card shadow-lg border-0 rounded-lg mt-5">
                            <div class="card-body">
                                <div class="form-floating mb-3">
                                    <p>Are you sure you want to delete the brand? This action cannot be undone!</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                <button type="submit" class="btn btn-success">Yes</button>
            </div>
        </form>
      </div>
    </div>
</div>
@endsection

@section('js')
    <script>
        const editBrand = (id, name) => {
            let url = `{{ route('brands') }}/${id}`
            let form = $('#editBrandForm')
            form.attr('action', url)
            form.find('[name="name"]').val(name)
            $('#editBrandName').text(name)
        }
        
        /**
         * Remove brand show alert.
        */
        const removeBrand = (id, name) => {
            console.log(id, name)
            let url = `{{ route('brands') }}/${id}`
            let form = $('#removeBrandForm')
            form.attr('action', url)
            $('#removeBrandName').text(name)
        }
    </script>
@endsection