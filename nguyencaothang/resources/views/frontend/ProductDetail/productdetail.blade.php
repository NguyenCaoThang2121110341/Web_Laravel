@extends('layouts.site')
@section('title', 'chi-tiet-san-pham')
@section('content')
<div class="product-detail">
  <div class="product-image"> 
    <img style ="width: 300px; height: auto;" src="{{ asset('images/product/' . $product->image) }}" alt="Product Image">
  </div>
  <div class="product-info">
    <h1>{{$product->name}}</h1>
    <p class="product-description">
    {{$product->description}}
    </p>
    <div class="quantity">
            <label for="quantity">Số lượng:</label>
            <input type="number" id="qty" name="qty" value="1" min="1">
        </div>
    <p class="product-price">Giá tiền: ${{$product->price}}</p>
    <div class="product-actions">
      <button class="add-to-cart" onclick="handleAddCart({{$product->id}})">Thêm vào giỏ hàng</button>
      <button class="buy-now">Mua ngay</button>
    </div>
  </div>
</div>
<h2 ><span class="px-2">Sản phẩm liên quan</span></h2>
<div class="product-grid">
@foreach ( $list_product->take(3) as $productitem )
<x-product-card :$productitem/>
@endforeach
</div>
<script>
    function handleAddCart(productid)
    {
        let qty = document.getElementById("qty").value;
      $.ajax({
        url:"{{  route('site.cart.addcart')  }}",
        type:"GET",
        data:{
            productid:productid,
            qty:qty
        },
        success:function(result,status,xhr){
            document.getElementById("showqty").innerHTML=result;
            alert("Thêm vào giỏ hàng thành công");
        },
        error:function(xhr,status,error)
        {
            alert(error);
        }
      })
    }
 </script>
@endsection

