

<div class="product-card">
    <img style ="width: 400px; height: 150;" src="{{ asset('images/posts/'.$postitem->image)}}" alt="Product 3">
    <h3>{{ $postitem->title }}</h3>
  
  
    <button onclick="window.location.href='{{ route('site.post.detail', ['slug' => $postitem->slug]) }}'">Chi tiết </button> 
  </div>

  <!-- Add more product cards as needed -->




