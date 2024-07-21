@extends('layouts.admin')
@section('title', 'Product')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h1 class="d-inline">Tất cả Sản Phẩm</h1>
                    </div>
                </div>
            </div>
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="card">
                <div class="card-header text-right">
                    <button class="btn btn-sm btn-success">
                        <i class="fa fa-solid fa-plus"></i>
                        Thêm sản phẩm
                    </button>
                    <button class="btn btn-sm btn-success">
                        <i class="fa fa-save" aria-hidden="true"></i>
                        Thêm vào thùng rác
                    </button>
                </div>
                <div class="card-body">
                    @php
                        $args = ['id' => $product->id];
                    @endphp
                    <form action="{{ route('admin.product.update', $args) }}" enctype="multipart/form-data" method="post">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label>Tên sản phẩm (*)</label>
                            <input type="text" name="name" id="name" placeholder="Nhập tên danh mục"
                                class="form-control" value="{{ old('name', $product->name) }}">
                            @error('name')
                                {{ $message }}
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label>Danh mục cha (*)</label>
                            <select name="category_id" class="form-control">
                                <option value="">Chọn danh mục</option>
                                {{-- @foreach ($categories as $id => $name)
                                    <option value="{{ $id }}">{{ $name }}</option>
                                @endforeach --}}
                                {!! $htmlcategories !!}
                            </select>
                        </div>
                        <div class="mb-3">
                            <label>Chi tiết (*)</label>
                            <textarea rows="3" name="detail" id="detail" placeholder="Nhập chi tiết sản phẩm" class="form-control">{{ old('detail', $product->detail )}}</textarea>
                        </div>

                        <div class="mb-3">
                            <label>Hình đại diện</label>
                            <input type="file" name="image" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label>Mô tả (*)</label>
                            <textarea rows="3" name="description" id="description" placeholder="Nhập mô tả danh mục" class="form-control">{{ old('description', $product->description )}}</textarea>
                        </div>
                        <div class="mb-3">
                            <label>Giá tiền (*)</label>
                            <input type="number" name="price" id="price" placeholder="Nhập giá tiền"
                                class="form-control" value="{{ old('price', $product->price )}}"></input>
                        </div>
                        <div class="mb-3">
                            <label>Giá sau khi được giảm (*)</label>
                            <input type="number" name="pricesale" id="pricesale" placeholder="Nhập giá tiền"
                                class="form-control" value="{{ old('pricesale', $product->pricesale )}}"></input>
                        </div>

                        <div class="mb-3">
                            <label>Thương hiệu cha (*)</label>
                            <select name="brand_id" class="form-control">
                                <option value="">Chọn thương hiệu</option>
                                {{-- @foreach ($brands as $id => $name)
                                    <option value="{{ $id }}">{{ $name }}</option>
                                @endforeach --}}
                                {!! $htmlbrands !!}
                            </select>
                        </div>
                        <div class="mb-3">
                            <label>Trạng thái</label>
                            <select name="status" class="form-control">
                                <option value="2" {{ $product->status == 2 ? 'selected' : '' }}>Chưa xuất bản</option>
                                <option value="1" {{ $product->status == 1 ? 'selected' : '' }}>Xuất bản</option>
                            </select>
                        </div>
                        <div class="card-header text-right">
                            <button class="btn btn-sm btn-success">
                                <i class="fa fa-save" aria-hidden="true"></i>
                                Lưu
                            </button>
                        </div>
                    </form>
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
@endsection
