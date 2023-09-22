@extends('layouts.dashboard')

@section('css')
    
@endsection

@section('content')

<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">{{ isset($product) && $product ? 'Edit' : 'Create' }} Product</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item">Products</li>
            <li class="breadcrumb-item {{ isset($product) && $product ? '' : 'active' }}">{{ isset($product) && $product ? 'Edit' : 'Create' }}</li>
            @if (isset($product) && $product)
                <li class="breadcrumb-item active">{{ $product->name }}</li>
            @endif
        </ol>
        <div class="card mb-4">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="card shadow-lg border-0 rounded-lg mt-5">
                        <form action="{{ isset($product) && $product ? route('products.update', ['id' => $product->id]) : route('products.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @if (isset($product) && $product)
                                @method('patch')
                            @endif
                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <div class="form-floating mb-3 mb-md-0">
                                            <input class="form-control" id="productName" name="name" type="text" placeholder="Enter Product Name" value="{{ old('name') ? old('name') : (isset($product) && $product ? $product->name : '')}}" />
                                            <label for="productName" class="required">Product name</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-floating">
                                            <input class="form-control" id="price" type="number" placeholder="Enter product price" name="price" value="{{ old('price') ? old('price') : (isset($product) && $product ? $product->price : '')}}" />
                                            <label for="price" class="required">Price ($)</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-floating">
                                            <select name="brand" id="brand" class="form-control">
                                                <option value="">Select Brand</option>
                                                @foreach ($brands as $brand)
                                                    <option value="{{ $brand->id }}" {{ old('brand') && old('brand') == $brand->id ? 'selected' : (isset($product) && $product && $product->brand_id == $brand->id ? 'selected' : '' ) }}>{{ $brand->name }}</option>
                                                @endforeach
                                            </select>
                                            <label for="Brand" class="required">Brand</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-floating mb-3">
                                    <textarea name="description" id="description" cols="30" rows="10" class="form-control">{{ old('description') ? old('description') : (isset($product) && $product ? $product->description : '')}}</textarea>
                                    <label for="description" class="mb-5 required">Product Description</label>
                                </div>
                                {{-- If product is in edit form. --}}
                                @if (isset($product) && $product)
                                    <div class="row p-3">
                                        <h3>Product Gallery</h3>
                                        @if ($product->images && count($product->images) > 0)
                                            @foreach ($product->images as $image)
                                                <div class="col-lg-4">
                                                    <img src="{{ asset('uploads/products') }}/{{ $product->id }}/{{ $image->filename }}"  class="rounded img-thumbnail" alt="{{ $image->filename }}">
                                                    @if (count($product->images) > 1)
                                                        <button type="button" class="btn  btn-outline-danger btn-sm" style="margin-top: -25%; z-index: 99999" title="Delete" data-bs-toggle="modal" data-bs-target="#removeImage" onclick="removeImage({{ $image->id }})"><i class="fa fa-trash"></i></button>
                                                    @endif
                                                </div>
                                            @endforeach
                                        @else
                                            <p class="text-muted">No Gallery Found!</p>
                                        @endif
                                    </div>
                                @endif
                                <div class="row mb-3">
                                    <div class="form-floating mb-3">
                                        <input type="file" multiple name="images[]" class="form-control" id="images">
                                        <label for="images" class="{{ isset($product) && $product ? '' : 'required' }}">Product Images</label>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-center py-3">
                                <div class="mt-4 mb-0">
                                    <div class="d-grid"><button class="btn btn-success btn-block" type="submit">{{ isset($product) && $product ? 'Update' : 'Save' }}</button></div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

{{-- Remove Image goes here! --}}
<!-- Modal -->
<div class="modal fade" id="removeImage" tabindex="-1" aria-labelledby="removeImageLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="editBrandLabel">Delete Image</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="#" method="POST" id="removeImageForm">
            @csrf
            @method('delete')
            <div class="modal-body">
                <div class="row justify-content-center">
                    <div class="col-lg-12">
                        <div class="card shadow-lg border-0 rounded-lg mt-5">
                            <div class="card-body">
                                <div class="form-floating mb-3">
                                    <p>Are you sure you want to delete the Image? This action cannot be undone!</p>
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
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
          selector: 'textarea',
        });
        @if(isset($product) && $product)
            /**
             * Remove Image show alert.
            */
            const removeImage = (id) => {
                console.log(id)
                let url = `{{ url('images') }}/${id}`
                let form = $('#removeImageForm')
                form.attr('action', url)
            }
        @endif
    </script>
@endsection