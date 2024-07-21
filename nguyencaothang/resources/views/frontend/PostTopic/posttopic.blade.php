@extends('layouts.site')
@section('title', 'bai-viet-theo-chu-de')
@section('content')


<div class="container">
    <h1>Bài viết chủ đề: {{ $row->name }}</h1>
</div>


<div class="product-grid">
  
@foreach ($list_post as $postitem)
<x-post-card :$postitem/>


@endforeach
</div>
<nav aria-label="Page navigation example">
  <ul class="pagination justify-content-center">
    <li class="page-item">
      <a class="page-link" href="#" aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
      </a>
    </li>
    <li class="page-item"> {{ $list_post->links() }}</li>
  
    <li class="page-item">
      <a class="page-link" href="#" aria-label="Next">
        <span aria-hidden="true">&raquo;</span>
      </a>
    </li>
  </ul>
</nav>

@endsection