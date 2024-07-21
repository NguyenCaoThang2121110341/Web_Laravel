<!DOCTYPE html>
<html lang="en">

<head>

  <meta http-equiv="pragma" content="no-cache" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
  <meta charset="UTF-8" />
  <meta http-equiv="cache-control" content="max-age=604800" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <title>Thế Giới Điện Thoại</title>

  <link href="images/favicon.ico" rel="shortcut icon" type="image/x-icon">

  <!-- jQuery -->
  <script src="{{asset('js/jquery-2.0.0.min.js')}}" type="text/javascript"></script>

  <!-- Bootstrap4 files-->
  <script src="{{asset('js/bootstrap.bundle.min.js')}}" type="text/javascript"></script>
  <!-- <link href="{{asset('css/bootstrap.css')}}" rel="stylesheet" type="text/css"/> -->

  <!-- Font awesome 5 -->
  <!-- <link href="{{asset('fonts/fontawesome/css/all.min.css')}}" type="text/css" rel="stylesheet"> -->

  <!-- custom style -->
  <!-- <link href="{{asset('css/ui.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('css/responsive.css')}}" rel="stylesheet" type="text/css" /> -->
  <link rel="stylesheet" href="{{asset('style.css')}}" />
  <script src="{{ asset('jquery/jquery-3.7.1.min.js') }}"></script>
  <!-- custom javascript -->
  <!-- <script src="{{asset('js/script.js')}}" type="text/javascript"></script> -->

  @yield('header')
</head>

<body>
  {{-- header --}}
  <header>
    <img src="{{asset('header1.png')}}">







  </header>
  <nav>
    <div class="container">
      <ul>
        <li> <a href="/"><img style="width: 150px; height: 50px;" src="{{asset('logo.jpg')}}"> </a></li>
        <li> <a href="">ĐÀ NẲNG<i class="fas fa-sort-down"></i></a></li>
        <!--     
		<li>   
       <form action="{{ route('products.search') }}" method="GET"> <input type ="text"><button type="submit" class="btnn"> <i class="fas fa-search"></i>         
       </form>  
       </li> -->

          <div >
            <div class=>
              <form action="{{ route('products.search') }}" method="GET">
                <input name="search" placeholder="Tìm sản phẩm" type="search">
                <button type="submit" class="btnn"> <i class="fas fa-search"></i> </button>
              </form>
            </div>
          </div>
 
        @php

      $count = count(session('carts', []));
    @endphp
        <li> <a href="{{ route('site.cart.index')}}"><button><i class="fas fa-shopping-cart"></i>Giỏ hàng (<span
                id="showqty">{{ $count }}</span>)</button></a></li>
        <li> <a href="{{ route('site.category')}}">Danh mục</a></li>
        <li> <a href="{{ route('site.brand')}}">Thương hiệu</a></li>
        <li> <a href="{{ route('site.topic')}}">Chủ đề</a></li>

        <li>
          <a href="">Tìm kiếm </a>
        </li>
      </ul>
    </div>
  </nav>
  <div class="menu-container">
    <x-main-menu />
  </div>



  {{-- main --}}
  <main>
    @yield('content')
  </main>

  {{-- footer --}}
  <footer>
    <div class="footer-content">
      <div class="footer-section">
        <h3>About Us</h3>
        <p>We are a company that provides high-quality products and services to our customers.</p>
      </div>
      <div class="footer-section">
        <h3>Quick Links</h3>
        <ul>
          <li><a href="#">Home</a></li>
          <li><a href="#">Products</a></li>
          <li><a href="#">Services</a></li>
          <li><a href="#">Contact</a></li>
        </ul>
      </div>
      <div class="footer-section">
        <h3>Contact Us</h3>
        <ul>
          <li>Phone: 123-456-7890</li>
          <li>Email: info@company.com</li>
          <li>Address: 123 Main Street, Anytown USA</li>
        </ul>
      </div>
      <div class="footer-section">
        <h3>Follow Us</h3>
        <div class="social-media">
          <a href="#"><i class="fab fa-facebook-f"></i></a>
          <a href="#"><i class="fab fa-twitter"></i></a>
          <a href="#"><i class="fab fa-instagram"></i></a>
          <a href="#"><i class="fab fa-linkedin-in"></i></a>
        </div>
      </div>
    </div>
    <div class="footer-bottom">
      <p>&copy; 2023 Company Name. All rights reserved.</p>
    </div>
  </footer>


</body>

</html>