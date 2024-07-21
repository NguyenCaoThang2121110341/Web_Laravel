@extends('layouts.site')
@section('title', 'tat-ca-chu-de')
@section('content')
<div class="container">
    <h1>Tất cả chủ đề</h1>
</div>
<div class="product-grid">
@foreach ($list_topic as $topic)

  <div class="product-card">
  
    <h3 class="container">{{ $topic->name }}</h3>
    
  
    <button onclick="window.location.href='{{ route('site.post.topic', ['slug' => $topic->slug]) }}'">Xem bài viết </button> 
  </div>
@endforeach
  <!-- Add more product cards as needed -->
</div>
<div class="col-12 pb-1">
                    <nav aria-label="Page navigation">
                      <ul class="pagination justify-content-center mb-3">
                       
                        <li>
                           
                        </li>
                      </ul>
                    </nav>
                </div>
                

                <nav aria-label="Page navigation example">
  <ul class="pagination justify-content-center">
    <li class="page-item">
      <a class="page-link" href="#" aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
      </a>
    </li>
    <li class="page-item"> {{ $list_topic->links() }}</li>
  
    <li class="page-item">
      <a class="page-link" href="#" aria-label="Next">
        <span aria-hidden="true">&raquo;</span>
      </a>
    </li>
  </ul>
</nav>



    @endsection
