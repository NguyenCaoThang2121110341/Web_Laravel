@extends('layouts.admin')
@section('content')
@section('title', 'Chi tiết thương hiệu')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Chi tiết thương hiệu: {{ $brand->name }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.index') }}">Trang chủ</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.brand.index') }}">Thương hiệu</a></li>
                        <li class="breadcrumb-item active">Chi tiết</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-12 text-right">
                        <a href="{{ route('admin.brand.index') }}"
                            class="btn btn-sm btn-secondary">
                            <i class="fa fa-arrow-left" aria-hidden="true"></i> Quay về
                        </a>
                        @if ($brand->products->count() > 0)
                            <a href="{{ route('admin.brand.trash-pro-by-brand-on-show', ['id' => $brand->id]) }}"
                                class="btn btn-sm btn-danger trash-count-pro-by-brand-btn">
                                <i class="fa fa-trash" aria-hidden="true"></i> Sản phẩm
                            </a>
                        @endif
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <img src="{{ asset('images/brand/' . $brand->image) }}" alt="{{ $brand->name }}"
                            class="img-fluid">
                    </div>
                    <div class="col-md-8">
                        <dl class="row">
                            <dt class="col-sm-4">Tên thương hiệu:</dt>
                            <dd class="col-sm-8">{{ $brand->name }}</dd>

                            <dt class="col-sm-4">Slug:</dt>
                            <dd class="col-sm-8">{{ $brand->slug }}</dd>

                            <dt class="col-sm-4">Mô tả:</dt>
                            <dd class="col-sm-8">{{ $brand->description }}</dd>

                            <dt class="col-sm-4">Trạng thái:</dt>
                            <dd class="col-sm-8">{{ $brand->status == 1 ? 'Xuất bản' : 'Chưa xuất bản' }}</dd>

                            <dt class="col-sm-4">Người tạo:</dt>
                            <dd class="col-sm-8">{{ $brand->createdBy->name ?? 'N/A' }}</dd>

                            <dt class="col-sm-4">Người cập nhật:</dt>
                            <dd class="col-sm-8">{{ $brand->updatedBy->name ?? 'N/A' }}</dd>

                            <dt class="col-sm-4">Ngày tạo:</dt>
                            <dd class="col-sm-8">{{ $brand->created_at }}</dd>

                            <dt class="col-sm-4">Ngày cập nhật:</dt>
                            <dd class="col-sm-8">{{ $brand->updated_at }}</dd>
                        </dl>
                    </div>
                </div>

                <div class="row mt-4">
                    @if ($brand->products->count() > 0 && $hasActiveProducts)
                        <div class="col-md-12">
                            <h4>Sản phẩm thuộc thương hiệu:</h4>
                            <div class="list-group list-group-flush" style="max-height: 300px; overflow-y: auto;">
                                @foreach ($brand->products as $product)
                                    @if ($product->status != 0 && $product->status != 3)
                                        <div class="list-group-item">
                                            <div class="d-flex w-100 justify-content-between">
                                                <div class="d-flex align-items-center">
                                                    <img src="{{ asset('images/product/' . $product->image) }}"
                                                        alt="{{ $product->name }}" class="img-thumbnail mr-2"
                                                        style="max-width: 50px;">
                                                    <h5 class="mb-1">{{ $product->name }}</h5>
                                                </div>
                                                <div class="d-flex">
                                                    <div style="display: inline-block;">
                                                        <a href="{{ route('admin.product.edit', ['id' => $product->id]) }}"
                                                            class="btn btn-sm btn-primary">
                                                            <i class="fa fa-edit" aria-hidden="true"></i>
                                                        </a>
                                                    </div>
                                                    <div style="display: inline-block; margin-left: 5px;">
                                                        <a href="{{ route('admin.brand.delete-product-by-brand-on-show', ['id' => $product->id]) }}"
                                                            class="btn btn-sm btn-danger">
                                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    @endif
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
<script>
    $(document).ready(function() {
        $.ajax({
            url: "{{ route('admin.pro.by.brand.trash.count', ['id' => $brand->id]) }}",
            method: 'GET',
            success: function(response) {
                $('.trash-count-pro-by-brand-btn').append(' (' + response.count + ')');
            },
            error: function() {
                console.error('Lỗi khi lấy số lượng thương hiệu trong thùng rác.');
            }
        });
    });
</script>
@endsection
