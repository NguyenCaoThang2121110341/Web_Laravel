@extends('layouts.admin')
@section('title', 'Category')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h1 class="d-inline">Tất cả danh mục</h1>
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
                        $args = ['id' => $category->id];
                    @endphp
                    <form action="{{ route('admin.category.update', $args) }}"enctype="multipart/form-data" method="post">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label>Tên danh mục (*)</label>
                            <input type="text" name="name" id="name" placeholder="Nhập tên danh mục"
                                class="form-control" value="{{ old('name',$category->name) }}">
                            @error('name')
                                {{ $message }}
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label>Danh mục cha (*)</label>
                            <select name="parent_id" class="form-control">
                                <option value="0">None</option>
                                {!! $htmlparentId !!}
                            </select>
                        </div>
                        <div class="mb-3">
                            <label>Mô tả (*)</label>
                            <textarea rows="3" name="description" id="description" placeholder="Nhập mô tả danh mục" class="form-control" >{{ old('description',$category->description) }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label>Hình đại diện</label>
                            <input type="file" name="image" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label>Sắp xếp</label>
                            <select name="sort_order" class="form-control">
                                <option value="0">Chọn vị trí</option>
                                {!! $htmlsortOrder !!}
                            </select>
                        </div>
                        <div class="mb-3">
                            <label>Trạng thái</label>
                            <select name="status" class="form-control">
                                <option value="2" {{($category->status==2)?'selected':''}}>Chưa xuất bản</option>
                                <option value="1" {{($category->status==1)?'selected':''}}>Xuất bản</option>
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
