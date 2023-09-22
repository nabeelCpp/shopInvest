@extends('layouts.dashboard')

@section('content')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Products</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Products</li>
        </ol>
        <div class="card mb-4">
            <div class="card-header">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" onclick="window.location.href='{{ route('products.create') }}'">
                    <i class="fas fa-plus"></i>
                    Add
                </button>
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Product Name</th>
                            <th>Price</th>
                            <th>Brand</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Product Name</th>
                            <th>Price ($)</th>
                            <th>Brand</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                       @foreach ($products as $key => $product)
                           <tr>
                                <td>{{ $key+1 }}</td>
                                <td>
                                    @if ($product->images && count($product->images) > 0)
                                        <img src="{{ asset('uploads/products/'.$product->id.'/'.$product->images[0]->filename) }}"  class="rounded img-thumbnail" style="height: 50px; width: 50px;" alt="">
                                    @endif
                                    {{ $product->name }}
                                </td>
                                <td>{{ number_format($product->price, 2) }}</td>
                                <td>{{ $product->brand->name }}</td>
                                <td>
                                    <button type="button" class="btn btn-outline-primary btn-sm" title="Edit" onclick="window.location.href='{{ route('products.edit', ['id' => $product->id]) }}'"><i class="fa fa-edit"></i></button>
                                    <button type="button" class="btn btn-outline-info btn-sm" title="View" data-json="{{ json_encode($product) }}" onclick="viewProduct(this)" data-bs-toggle="modal" data-bs-target="#viewProduct"><i class="fa fa-eye"></i></button>
                                    <button type="button" class="btn btn-outline-danger btn-sm" data-bs-toggle="modal" data-bs-target="#removeProduct" data-json="{{ json_encode($product) }}" onclick="removeProduct(this)"><i class="fa fa-trash" title="Delete"></i></button>
                                </td>
                           </tr>
                       @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>
{{-- View Product goes here! --}}
<!-- Modal -->
<div class="modal fade" id="viewProduct" tabindex="-1" aria-labelledby="viewProductLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="viewProductLabel">View Product <small>(<b id="viewProductName">Product name</b>)</small></h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="card shadow-lg border-0 rounded-lg mt-5">
                        <div class="card-body">
                            <div class="form-floating mb-3">
                                <input class="form-control" id="name" type="text" value="Product Name" readonly />
                                <label>Product Name</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input class="form-control" type="text" id="price" value="Product Name" readonly />
                                <label>Price</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input class="form-control" type="text" id="brand" value="Brand" readonly />
                                <label>Brand</label>
                            </div>
                            <div class="form-floating mb-3">
                                <h3>Description</h3>
                                <p id="description"></p>
                            </div>
                            <div class="row" id="images"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
</div>


{{-- Remove Product Modal goes here! --}}
<!-- Modal -->
<div class="modal fade" id="removeProduct" tabindex="-1" aria-labelledby="removeProductLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="editProductLabel">Delete Product <small>(<b id="removeProductName">Product name</b>)</small></h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="#" method="POST" id="removeProductForm">
            @csrf
            @method('delete')
            <div class="modal-body">
                <div class="row justify-content-center">
                    <div class="col-lg-12">
                        <div class="card shadow-lg border-0 rounded-lg mt-5">
                            <div class="card-body">
                                <div class="form-floating mb-3">
                                    <p>Are you sure you want to delete the product? This action cannot be undone!</p>
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
        const viewProduct = (element) => {
            let view = $(element)
            let product = view.data('json');
            $('#viewProductName').text(product.name)
            $('#name').val(product.name)
            $('#price').val('$'+product.price)
            $('#brand').val(product.brand.name)
            $('#description').html(product.description)
            let images = product.images && product.images.length > 0 && product.images.map(image => {
                return `<div class="col-lg-4">
                            <img src="{{ asset('uploads/products') }}/${product.id}/${image.filename}"  class="rounded img-thumbnail" alt="">
                        </div>`
            }).join('')
            $('#images').html(images)
        }

        /**
         * Remove product show alert.
        */
        const removeProduct = (el) => {
            let json = $(el).data('json');
            let url = `{{ route('products') }}/${json.id}`
            let form = $('#removeProductForm')
            form.attr('action', url)
            $('#removeProductName').text(json.name)
        }
    </script>
@endsection
