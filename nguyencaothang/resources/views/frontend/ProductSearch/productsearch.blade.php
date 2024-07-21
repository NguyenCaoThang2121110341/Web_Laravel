@extends('layouts.site')
@section('title', 'Kết quả tìm kiếm')

@section('content')
    <main>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2>Kết quả tìm kiếm cho "{{ $search }}"</h2>
                    <div class="product-grid">
                        @forelse ($products as $product)
                            <!-- <div class="col-lg-4 col-md-6 col-12">
                                <div class="single-product">
                                 
                                    <div class="product-img">
                                        <a href="{{ url('chi-tiet-san-pham/' . $product->slug) }}">
                                            <img src="{{ asset('images/products/' . $product->image) }}" alt="{{ $product->name }}">
                                        </a>
                                    </div>
                                    <div class="product-content">
                                        <h3><a href="{{ url('chi-tiet-san-pham/' . $product->slug) }}" style="color: rgb(92, 98, 98)">Tên sản phẩm: {{ $product->name }}</a></h3>
                                        <div class="product-price">
                                            <span>Giá: {{ number_format($product->price, 0, ',', '.') }} VND</span>
                                        </div>
                                        <div class="price-sale">
                                            <span>Giá Sale: {{ number_format($product->pricesale, 0, ',', '.') }} VND</span>
                                        </div>
                                        <button class="btn btn-primary" onclick="window.location.href='{{ url('chi-tiet-san-pham/' . $product->slug) }}'">Chi tiết sản phẩm</button>
                                  
                                    </div>
                                </div>
                            </div> -->

                            <div class="product-card">
    <img style ="width: 300px; height: auto;" src="{{ asset('images/product/' . $product->image) }}" alt="Product 3">
    <h3>{{ $product->name }}</h3>
    <p>${{ $product->price }}</p>
  
    <button onclick="window.location.href='{{ route('site.product.detail', ['slug' => $product->slug]) }}'">Chi tiết sản phẩm</button> 
  </div>
                        @empty
                            <div class="col-12">
                                <p>Không tìm thấy sản phẩm nào phù hợp.</p>
                            </div>
                        @endforelse
                    </div>
                    
                </div>
            </div>
        </div>
    </main>
@endsection