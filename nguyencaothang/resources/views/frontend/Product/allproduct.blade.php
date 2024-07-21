@extends('layouts.site')
@section('title', 'san-pham')
@section('content')
<div class="product-grid">
@foreach ($list_product as $product)
  <div class="product-card">
    <img style ="width: 200px; height: 100;" src="{{ asset('images/product/' . $product->image) }}" alt="Product 3">
    <h3>{{ $product->name }}</h3>
    <p>${{ $product->price }}</p>
  
    <button onclick="window.location.href='{{ route('site.product.detail', ['slug' => $product->slug]) }}'">Chi tiết sản phẩm</button> 
  </div>
@endforeach
  <!-- Add more product cards as needed -->
</div>
<!-- <div class="col-12 pb-1">
                    <nav aria-label="Page navigation">
                      <ul class="pagination justify-content-center mb-3">
                       
                        <li>
                           
                        </li>
                      </ul>
                    </nav>
                </div>
                 -->

                <nav aria-label="Page navigation example">
  <ul class="pagination justify-content-center">
    <li class="page-item">
      <a class="page-link" href="#" aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
      </a>
    </li>
    <li class="page-item"> {{ $list_product->links() }}</li>
  
    <li class="page-item">
      <a class="page-link" href="#" aria-label="Next">
        <span aria-hidden="true">&raquo;</span>
      </a>
    </li>
  </ul>
</nav>



    @endsection
