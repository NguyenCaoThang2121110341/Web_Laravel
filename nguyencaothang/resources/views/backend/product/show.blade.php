@extends('layouts.admin')
@section('content')
@section('title', 'Chi tiết sản phẩm')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Chi Tiết Sản Phẩm: {{ $product->name }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.index') }}">Trang chủ</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.product.index') }}">Sản phẩm</a></li>
                        <li class="breadcrumb-item active">Chi tiết sản phẩm</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <img src="{{asset('images/product/'.$product->image)}}" alt="{{ $product->name }}"
                            class="card-img-top">
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <h2 class="card-title">{{ $product->name }}</h2>
                            <p class="card-text"><strong>Slug:</strong> {{ $product->slug }}</p>
                            <p class="card-text"><strong>Giá:</strong> {{ number_format($product->price, 0, ',', '.') }}
                                VNĐ</p>
                            <p class="card-text"><strong>Giá khuyến mãi:</strong>
                                {{ number_format($product->pricesale, 0, ',', '.') }} VNĐ</p>
                            <p class="card-text"><strong>Số lượng:</strong> {{ $product->qty }}</p>
                            <p class="card-text"><strong>Trạng thái:</strong> <span
                                    class="badge badge-{{ $product->status == 1 ? 'success' : 'danger' }}">{{ $product->status == 1 ? 'Hiển thị' : 'Không hiển thị' }}</span>
                            </p>

                            <hr>
                        
                            <div class="row">
                                <div class="col-md-6">
                                    <p class="card-text">
                                        
                                        <strong>Danh mục:</strong> {{ $product->category->name }}
                                    </p>
                                </div>
                                <div class="col-md-6">
                                    <p class="card-text">
                                        
                                        <strong>Thương hiệu:</strong> {{ $product->brand->name }}
                                    </p>
                                </div>
                            </div>

                            <hr>
                            <h3 class="card-title">Thông tin bổ sung</h3>
                            <p class="card-text"><strong>Người tạo:</strong> {{ $product->created_by->name ?? 'N/A' }}
                            </p>
                            <p class="card-text"><strong>Người cập nhật:</strong>
                                {{ $product->updated_by->name ?? 'N/A' }}</p>
                            <p class="card-text"><strong>Ngày tạo:</strong> {{ $product->created_at }}</p>
                            <p class="card-text"><strong>Ngày cập nhật:</strong> {{ $product->updated_at }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection

@section('header')
<link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
<link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
@endsection
@section('footer')
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
<script>
    @if (Session::has('success'))
        toastr.success("{{ Session::get('success') }}");
    @endif

    @if (Session::has('error'))
        toastr.error("{{ Session::get('error') }}");
    @endif
</script>
@endsection
