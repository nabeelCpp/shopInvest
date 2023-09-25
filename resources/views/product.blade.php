@extends('inc.layout')

@section('content')
    <!-- Product section-->
    <section class="py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="row gx-4 gx-lg-5">
                <div class="col-md-6">
                    <img class="card-img-top mb-5 mb-md-0" src="{{ asset("uploads/products/{$product->id}/{$product->images[0]->filename}") }}" id="mainProductImg" alt="..." />
                    <div class="row mt-5">
                        @if ($product->images && count($product->images) > 0)
                            @foreach ($product->images as $key => $image)
                                <div class="col-md-3 p-3 py-2 thumbnails img-thumbnail {{$key == 0? 'border border-primary' : '' }}" style="cursor: pointer"><img class="card-img-top mb-5 mb-md-0" src="{{ asset("uploads/products/{$product->id}/{$image->filename}") }}" style="height: 100px; width: 100px" onclick="changeImage(this)" /></div>
                            @endforeach
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="small mb-1 border">{{ $product->brand->name }}</div>
                    <h1 class="display-5 fw-bolder">{{ $product->name }}</h1>
                    <div class="fs-5 mb-5">
                        <span>${{ $product->price }}</span>
                    </div>
                    <p class="lead">{!! $product->description !!}</p>
                    <div class="d-flex">
                        <input class="form-control text-center me-3" id="inputQuantity" type="number" value="1" style="max-width: 5rem" min="1" />
                        <button class="btn btn-outline-dark flex-shrink-0" type="button" data-json="{{ json_encode($product) }}" onclick="addToCart(this)" data-bs-toggle="modal" data-bs-target="#addToCartModal">
                            <i class="bi-cart-fill me-1"></i>
                            Add to cart
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Related items section-->
    @if (isset($related) && count($related) > 0)
        <section class="py-5 bg-light">
            <div class="container px-4 px-lg-5 mt-5">
                <h2 class="fw-bolder mb-4">Related products</h2>
                <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                    @foreach ($related as $p)
                        {{-- Iterate over images and save data to variable for further use --}}
                        @php
                            $carousel = '';
                            $carouselImages = '';
                        @endphp
                        @foreach ($p->images as $key => $image)
                            @php
                                $carousel .= "<li data-bs-target='#productCarousel_{$p->id}' data-bs-slide-to='{$key}' class='".($key == 0 ? 'active' :'')."'></li>";
                                $carouselImages .= "<div class=\"carousel-item ".($key == 0 ? 'active' :'')."\">
                                            <img src=\"".asset("uploads/products/{$p->id}/{$image->filename}")."\" class=\"d-block w-100\" alt=\"{$image->filename}\">
                                        </div>";
                            @endphp
                        @endforeach
                        <div class="col mb-5">
                            <div class="card h-100">
                                <!-- Product image-->
                                <div id="productCarousel_{{ $p->id }}" class="carousel slide" data-bs-ride="carousel">
                                    <!-- Indicators (Optional) -->
                                    <ol class="carousel-indicators">
                                        {!! $carousel !!}
                                    </ol>
                                
                                    <!-- Slides -->
                                    <div class="carousel-inner">
                                        {!! $carouselImages !!}
                                    </div>
                                
                                    <!-- Controls (Optional) -->
                                    @if (count($p->images) > 1)
                                        <a class="carousel-control-prev" href="#productCarousel_{{ $p->id }}" role="button" data-bs-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Previous</span>
                                        </a>
                                        <a class="carousel-control-next" href="#productCarousel_{{ $p->id }}" role="button" data-bs-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Next</span>
                                        </a>
                                    @endif
                                </div>
                                <!-- Product details-->
                                <div class="card-body p-4">
                                    <div class="text-center">
                                        <!-- Product name-->
                                        <h5 class="fw-bolder"><a class="btn btn-text" href="{{ route("product.details", ['productId' => $p->id]) }}">{{ $p->name }}</a></h5>
                                        <!-- Product price-->
                                        ${{ $p->price }}
                                    </div>
                                </div>
                                <!-- Product actions-->
                                <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                    <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="{{ route("product.details", ['productId' => $p->id]) }}">Buy</a></div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
@endsection

@section('js')
    <script>
        
        const changeImage = (el) => {
            let element = $(el)
            let img = $(element).attr('src')
            /**
             * Remove active from all the thumbnails
            */
           $('.thumbnails').removeClass('border')
           $('.thumbnails').removeClass('border-primary')

           element.parent().addClass('border')
           element.parent().addClass('border-primary')

           $('#mainProductImg').attr('src', img)
        }

        /**
         * Add to cart
        */
        const addToCart = (el) => {
            let element = $(el)
            let product = element.data('json')
            let qty = $('#inputQuantity').val()
            if(qty > 0){
                let products = localStorage.cart ? JSON.parse(localStorage.cart) : []
                let productExist = products.filter(p => (p.id == product.id))
                if(productExist.length) {
                    products = products.map(p => {
                        if(product.id == p.id) {
                            p.qty = parseInt(p.qty) + parseInt(qty); 
                        }
                        return p;
                    })
                }else{
                    product.qty = qty
                    /**
                     * Put image as url
                    */
                    product.img = `{{ asset('uploads/products') }}/${product.id}/${product.images[0].filename}`
                    products.push(product)
                }
                localStorage.setItem('cart', JSON.stringify(products))
                /**
                 * Update cart count
                */
                cartBucket()
            }else{
                alert('Quantity must be greater than 0')
            }
        }
        
    </script>
@endsection