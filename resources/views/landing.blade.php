@extends('inc.layout')

@section('content')
    <section class="py-5">
        <div class="container px-4 px-lg-5 mt-5">
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                
                
                @if (isset($products) && $products)
                    @foreach ($products as $product)
                        {{-- Iterate over images and save data to variable for further use --}}
                        @php
                            $carousel = '';
                            $carouselImages = '';
                        @endphp
                        @foreach ($product->images as $key => $image)
                            @php
                                $carousel .= "<li data-bs-target='#productCarousel_{$product->id}' data-bs-slide-to='{$key}' class='".($key == 0 ? 'active' :'')."'></li>";
                                $carouselImages .= "<div class=\"carousel-item ".($key == 0 ? 'active' :'')."\">
                                            <img src=\"".asset("uploads/products/{$product->id}/{$image->filename}")."\" class=\"d-block w-100\" alt=\"{$image->filename}\">
                                        </div>";
                            @endphp
                        @endforeach
                        <div class="col mb-5">
                            <div class="card h-100">
                                <!-- Product image-->
                                <div id="productCarousel_{{ $product->id }}" class="carousel slide" data-bs-ride="carousel">
                                    <!-- Indicators (Optional) -->
                                    <ol class="carousel-indicators">
                                        {!! $carousel !!}
                                    </ol>
                                
                                    <!-- Slides -->
                                    <div class="carousel-inner">
                                        {!! $carouselImages !!}
                                    </div>
                                
                                    <!-- Controls (Optional) -->
                                    @if (count($product->images) > 1)
                                        <a class="carousel-control-prev" href="#productCarousel_{{ $product->id }}" role="button" data-bs-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Previous</span>
                                        </a>
                                        <a class="carousel-control-next" href="#productCarousel_{{ $product->id }}" role="button" data-bs-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Next</span>
                                        </a>
                                    @endif
                                </div>
                               
                                <!-- Product details-->
                                <div class="card-body p-4">
                                    <div class="text-center">
                                        <!-- Product name-->
                                        <h5 class="fw-bolder"><a class="btn btn-text" href="{{ route("product.details", ['productId' => $product->id]) }}">{{ $product->name }}</a></h5>
                                        <!-- Product reviews-->
                                        <div class="d-flex justify-content-center small text-warning mb-2">
                                            <div class="bi-star-fill"></div>
                                            <div class="bi-star-fill"></div>
                                            <div class="bi-star-fill"></div>
                                            <div class="bi-star-fill"></div>
                                            <div class="bi-star"></div>
                                        </div>
                                        <!-- Product price-->
                                        ${{ $product->price }}
                                    </div>
                                </div>
                                <!-- Product actions-->
                                <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                    <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="{{ route("product.details", ['productId' => $product->id]) }}">Buy</a></div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    
                @else
                    <div class="col mb-5">
                        <p class="text-muted">No Products found!</p>
                    </div>
                @endif
            </div>
        </div>
    </section>
@endsection