@extends('layouts.admin')
@section('content')
@section('title', 'Chi tiết danh mục')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Chi tiết danh mục: {{ $category->name }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.index') }}">Trang chủ</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.category.index') }}">Danh mục</a></li>
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
                        @if ($category->parent_id != 0)
                            <a href="{{ route('admin.category.show', ['id' => $category->parent_id]) }}"
                                class="btn btn-sm btn-secondary">
                                <i class="fa fa-arrow-left" aria-hidden="true"></i> Quay về danh mục cha
                            </a>
                        @endif
                        @if ($category->children->count() > 0)
                            <a href="{{ route('admin.category.trash-child-cate-on-show', ['id' => $category->id]) }}"
                                class="btn btn-sm btn-warning trash-count-child-cate-btn">
                                <i class="fa fa-trash" aria-hidden="true"></i> Danh mục con
                            </a>
                        @endif
                        @if ($category->products->count() > 0)
                            <a href="{{ route('admin.category.trash-pro-by-cate-on-show', ['id' => $category->id]) }}"
                                class="btn btn-sm btn-danger trash-count-pro-by-cate-btn">
                                <i class="fa fa-trash" aria-hidden="true"></i> Sản phẩm
                            </a>
                        @endif
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <img src="{{ asset('images/cate/' . $category->image) }}" alt="{{ $category->name }}"
                            class="img-fluid">
                    </div>
                    <div class="col-md-8">
                        <dl class="row">
                            <dt class="col-sm-4">Tên danh mục:</dt>
                            <dd class="col-sm-8">{{ $category->name }}</dd>

                            <dt class="col-sm-4">Slug:</dt>
                            <dd class="col-sm-8">{{ $category->slug }}</dd>

                            <dt class="col-sm-4">Thuộc Parent:</dt>
                            <dd class="col-sm-8">
                                {{ $category->parent_id == 0 ? 'Cấp cha' : ($category->parent ? $category->parent->name : 'Không có') }}
                            </dd>

                            <dt class="col-sm-4">Mô tả:</dt>
                            <dd class="col-sm-8">{{ $category->description }}</dd>

                            <dt class="col-sm-4">Trạng thái:</dt>
                            <dd class="col-sm-8">{{ $category->status == 1 ? 'Xuất bản' : 'Chưa xuất bản' }}</dd>

                            <dt class="col-sm-4">Người tạo:</dt>
                            <dd class="col-sm-8">{{ $category->createdBy->name ?? 'N/A' }}</dd>

                            <dt class="col-sm-4">Người cập nhật:</dt>
                            <dd class="col-sm-8">{{ $category->updatedBy->name ?? 'N/A' }}</dd>

                            <dt class="col-sm-4">Ngày tạo:</dt>
                            <dd class="col-sm-8">{{ $category->created_at }}</dd>

                            <dt class="col-sm-4">Ngày cập nhật:</dt>
                            <dd class="col-sm-8">{{ $category->updated_at }}</dd>
                        </dl>
                    </div>
                </div>

                <div class="row mt-4">
                    @if ($category->children->count() > 0)
                        <div class="col-md-6">
                            <h4>Danh mục con:</h4>
                            <div class="list-group list-group-flush" style="max-height: 300px; overflow-y: auto;">
                                @foreach ($category->children as $child)
                                    @if ($child->status != 0 && $child->status != 3)
                                        <div class="list-group-item">
                                            <div class="d-flex w-100 justify-content-between">
                                                <div class="d-flex align-items-center">
                                                    <img src="{{ asset('img/categories/' . $child->image) }}"
                                                        alt="{{ $child->name }}" class="img-thumbnail mr-2"
                                                        style="max-width: 50px;">
                                                    <h5 class="mb-1">{{ $child->name }}</h5>
                                                </div>
                                                <div class="d-flex">
                                                    <div style="display: inline-block;">
                                                        <a href="{{ route('admin.category.show', ['id' => $child->id]) }}"
                                                            class="btn btn-sm btn-info">
                                                            <i class="fa fa-eye" aria-hidden="true"></i>
                                                        </a>
                                                    </div>
                                                    <div style="display: inline-block; margin-left: 5px;">
                                                        <a href="{{ route('admin.category.edit',['id' => $child->id]) }}"
                                                            class="btn btn-sm btn-primary">
                                                            <i class="fa fa-edit" aria-hidden="true"></i>
                                                        </a>
                                                    </div>
                                                    <div style="display: inline-block; margin-left: 5px;">
                                                        <a href="{{ route('admin.category.delete-child-cate-on-show', ['id' => $child->id]) }}"
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

                    @if ($category->products->count() > 0 && $hasActiveProducts)
                        <div class="col-md-{{ $category->children->count() > 0 ? '6' : '12' }}">
                            <h4>Sản phẩm thuộc danh mục:</h4>
                            <div class="list-group list-group-flush" style="max-height: 300px; overflow-y: auto;">
                                @foreach ($category->products as $product)
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
                                                        <a href="{{ route('admin.category.delete-product-by-cate-on-show', ['id' => $product->id]) }}"
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
            url: "{{ route('admin.child.category.trash.count', ['id' => $category->id]) }}",
            method: 'GET',
            success: function(response) {
                $('.trash-count-child-cate-btn').append(' (' + response.count + ')');
            },
            error: function() {
                console.error('Lỗi khi lấy số lượng danh mục con trong thùng rác.');
            }
        });
    });
</script>
<script>
    $(document).ready(function() {
        $.ajax({
            url: "{{ route('admin.pro.by.category.trash.count', ['id' => $category->id]) }}",
            method: 'GET',
            success: function(response) {
                $('.trash-count-pro-by-cate-btn').append(' (' + response.count + ')');
            },
            error: function() {
                console.error('Lỗi khi lấy số lượng danh mục con trong thùng rác.');
            }
        });
    });
</script>
@endsection
