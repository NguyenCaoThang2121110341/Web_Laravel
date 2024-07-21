

  <div class="product-card">
    <img style ="width: 200px; height: 100;" src="{{ asset('images/product/'. $product->image)}}" alt="Product 3">
    <h3>{{ $product->name }}</h3>
    <p>${{ $product->price }}</p>
  
    <button onclick="window.location.href='{{ route('site.product.detail', ['slug' => $product->slug]) }}'">Chi tiết sản phẩm</button> 
  </div>

  <!-- Add more product cards as needed -->




