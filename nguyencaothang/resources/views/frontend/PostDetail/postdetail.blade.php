@extends('layouts.site')
@section('title', 'chi-tiet-bai-viet')
@section('content')
<div class="product-detail">
  <div class="product-image"> 
    <img style ="width: 300px; height: auto;" src="{{ asset('images/posts/' . $post->image) }}" alt="Product Image">
  </div>
  <div class="product-info">
    <h1>{{$post->title}}</h1>
    <p class="product-description">
    {{$post->description}}
    </p>
   
    <p class="product-price">Đánh giá : </p>
    <div class="product-actions">
      
      
    </div>
  </div>
</div>
<h2 ><span class="px-2">Bài viết liên quan</span></h2>
<div class="product-grid">
@foreach ( $list_post->take(3) as $postitem )
<x-post-card :$postitem/>
@endforeach
</div>

@endsection

