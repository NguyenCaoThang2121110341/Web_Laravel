@extends('layouts.site')
@section('title','gio-hang')
@section('content')
<div class="cart-container">
  <h1 class="cart-title">Giỏ hàng</h1>
  <form action="{{ route ("site.cart.update")}}" method="post">
  @csrf
  <table class="cart-table">
    <thead>
      <tr>
        <th>Sản phẩm</th>
        <th>Giá</th>
        <th>Số lượng</th>
       
        <th></th>
      </tr>
    </thead>
    <tbody>
    @php
                    $totalMoney=0;
                @endphp
                @foreach ( $list_cart as $row_cart)
      <tr>
        <td>
          <div class="cart-item">
            <img style="width: 90px" src="{{asset ('images/product/'.$row_cart['image'])}}" alt="Tên sản phẩm" class="cart-item-image">
            <div class="cart-item-info">
              <h3 class="cart-item-name">{{ $row_cart['name'] }}</h3>
              <p class="cart-item-description">Mô tả sản phẩm</p>
            </div>
          </div>
        </td>
        <td class="cart-item-price">${{ number_format($row_cart['price']) }}</td>
        <td>
          <div class="cart-item-quantity">
            <button class="quantity-btn">-</button>
            
            <input type="number" value="{{ $row_cart['qty'] }}" class="quantity-input">
            <button class="quantity-btn">+</button>
          </div>
        </td>
        <td class="cart-item-total"></td>
        <td><button onclick="window.location.href='{{route('site.cart.delete', ['id'=>$row_cart['id']])}}'"  class="remove-btn">Xóa</button></td>
      </tr>
      <!-- Thêm các sản phẩm khác ở đây -->
      @php
                    $totalMoney += $row_cart['price']*$row_cart['qty'];
                @endphp
                @endforeach
    </tbody>
  </table>

  <div class="cart-summary">
    <h2 class="cart-summary-title">Tổng cộng</h2>
    <p class="cart-summary-total">${{ number_format($totalMoney)}}</p>
    <button class="checkout-btn">Thanh toán</button>
  </div>
</div>
@endsection