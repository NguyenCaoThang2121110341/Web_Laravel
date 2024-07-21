@extends('layouts.site')
@section('title', 'bai-viet')
@section('content')
<div class="product-grid">
@foreach ( $list_post as $postitem )
<x-post-card :$postitem/>
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
    
    <li class="page-item">
      <a class="page-link" href="#" aria-label="Next">
        <span aria-hidden="true">&raquo;</span>
      </a>
    </li>
  </ul>
</nav>



    @endsection
