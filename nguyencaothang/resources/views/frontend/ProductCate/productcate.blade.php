@extends('layouts.site')
@section('title', 'san-pham-theo-danh-muc')
@section('content')



<div class="container">
    <h1>Sản phẩm danh mục: {{ $row->name }}</h1>
</div>


<div class="product-grid">
@foreach ( $list_product as $productitem )
<x-product-card :$productitem/>
@endforeach
</div>
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