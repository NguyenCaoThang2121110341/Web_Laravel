@extends('layouts.site')
@section('title', 'dang-nhap')
@section('content')
<!-- <link rel="stylesheet"  href="{{asset('style.css')}}" /> -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<div class="login-container">
  <h1 class="login-title">Đăng nhập</h1>

  <form class="login-form" action={{ route("website.dologin") }} method="post">
  @csrf
    <div class="form-group">
      <label for="username">Tên đăng nhập:</label>
      <input type="text" id="username" name="username" required>
    </div>

    <div class="form-group">
      <label for="password">Mật khẩu:</label>
      <input type="password" id="password" name="password" required>
    </div>

    <div class="form-actions">
      <button type="submit" class="login-btn">Đăng nhập</button>
      <a href="#" class="forgot-password">Quên mật khẩu?</a>
    </div>
  </form>

  <div class="signup-link">
    Chưa có tài khoản? <a href="#">Đăng ký</a>
  </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

@if (Session::has('message'))
    <script>
        toastr.options={
            "processBar":true,
            "closeButton":true
        }
        toastr.error("{{ Session::get('message') }}")
    </script>
    @endif

 @endsection