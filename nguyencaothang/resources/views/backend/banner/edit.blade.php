@extends('layouts.admin')
@section('title', 'Banner')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Cập nhật banner</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
                            <li class="breadcrumb-item active">Cập nhật banner</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Thông tin banner</h3>
                </div>

                <form action="{{ route('admin.banner.update', ['id' => $banner->id]) }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Tên banner <span class="text-danger">*</span></label>
                            <input type="text" name="name" id="name" value="{{ old('name', $banner->name) }}"
                                class="form-control" placeholder="Nhập tên banner">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="image">Hình ảnh</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" name="image" id="image" class="custom-file-input">
                                    <label class="custom-file-label" for="image">Chọn file</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="link">Link</label>
                            <textarea name="link" id="link" class="form-control" placeholder="Nhập link">{{ old('link', $banner->link) }}</textarea>
                            @error('link')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="position">Vị trí <span class="text-danger">*</span></label>
                            <select name="position" id="position" class="form-control">
                                <option value="slideshow">Slide Show</option>
                                <option value="mainmenu">Main Menu</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="description">Mô tả <span class="text-danger">*</span></label>
                            <textarea id="description" name="description" class="form-control" placeholder="Nhập mô tả danh mục">{{ old('description', $banner->description) }}</textarea>
                            @error('description')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="sort_order">Sắp xếp</label>
                            <select name="sort_order" id="sort_order" class="form-control">
                                <option value="0">Chọn vị trí</option>
                                {!! $htmlsortorder !!}
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="status">Trạng thái</label>
                            <select name="status" id="status" class="form-control">
                                <option value="2" {{ $banner->status == 2 ? 'selected' : '' }}>Chưa xuất
                                    bản</option>
                                <option value="1" {{ $banner->status == 1 ? 'selected' : '' }}>Xuất bản
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Cập nhật banner</button>
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
    <script>
        @if (Session::has('success'))
            toastr.success("{{ Session::get('success') }}");
        @endif

        @if (Session::has('error'))
            toastr.error("{{ Session::get('error') }}");
        @endif
    </script>
@endsection
