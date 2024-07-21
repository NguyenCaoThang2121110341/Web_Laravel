<div class="container">
    <h1>Sản phẩm mới nhất</h1>
</div>
<div class="product-grid">
@foreach ($list->take(6) as $product)
  <div class="product-card">
    <img style ="width: 300px; height: 300px;" src="{{ asset('images/product/' . $product->image) }}" alt="Product 3">
    <h3>{{ $product->name }}</h3>
    <p>${{ $product->price }}</p>
  
    <button onclick="window.location.href='{{ route('site.product.detail', ['slug' => $product->slug]) }}'">Chi tiết sản phẩm</button> 
  </div>
@endforeach
  <!-- Add more product cards as needed -->
</div>



