<div class="container">
    <h1>Bài viết mới nhất</h1>
</div>
<div class="product-grid">
@foreach ($list->take(6) as $post)
  <div class="product-card">
    <img style ="width: 300px; height: 200;" src="{{ asset('images/posts/' . $post->image) }}" alt="Product 3">
    <h3>{{ $post->title }}</h3>
    <p>{{ $post->description }}</p>
  
    <button onclick="window.location.href='{{ route('site.post.detail', ['slug' => $post->slug]) }}'">Chi tiết bài viết</button> 
  </div>
@endforeach
  <!-- Add more product cards as needed -->
</div>



