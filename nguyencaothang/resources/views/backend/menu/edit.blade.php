@extends('layouts.admin')
@section('title', 'Cập nhật Menu')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Cập nhật Menu</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('admin.menu.index') }}" class="btn btn-primary">Quay lại Menu</a>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Chỉnh Sửa Menu</h3>
            </div>

            <form action="{{ route('admin.menu.update', ['id' => $menu->id]) }}" method="post">
                @csrf
                @method("PUT")
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">Tên menu</label>
                        <input type="text" value="{{ old('name', $menu->name) }}" name="name" id="name" class="form-control" placeholder="Nhập tên menu">
                        @error('name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="link">Link</label>
                        <input type="text" value="{{ old('link', $menu->link) }}" name="link" id="link" class="form-control" placeholder="Nhập link"> 
                        @error('link')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="parent_id">Cấp cha</label>
                        <select name="parent_id" id="parent_id" class="form-control">
                            <option value="0">Cấp cha</option>
                            {!! $htmlparentid !!}
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="table_id">Table ID</label>
                        <select name="table_id" id="table_id" class="form-control">
                            <option value="0">Table 1</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="sort_order">Sắp xếp</label>
                        <select name="sort_order" id="sort_order" class="form-control">
                            <option value="0">Chọn vị trí</option>
                            {!! $htmlsortorder !!}
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="type">Loại</label>
                        <select name="type" id="type" class="form-control">
                            <option value="Loại 1">Loại 1</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="position">Vị trí</label>
                        <select name="position" id="position" class="form-control">
                            <option value="mainmenu" {{ $menu->position == "mainmenu" ? 'selected' : '' }}>Main menu</option>
                            <option value="slider" {{ $menu->position == "slider" ? 'selected' : '' }}>Slider</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="status">Trạng thái</label>
                        <select name="status" id="status" class="form-control">
                            <option value="2" {{ $menu->status == 2 ? 'selected' : '' }}>Chưa xuất bản</option>
                            <option value="1" {{ $menu->status == 1 ? 'selected' : '' }}>Xuất bản</option>
                        </select>
                    </div>
                </div>

                <div class="card-footer text-right">
                    <button type="submit" class="btn btn-primary">Cập nhật menu</button>
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
    @if (Session::has('success'))
        <script>toastr.success("{{ Session::get('success') }}");</script>
    @endif
    @if (Session::has('error'))
        <script>toastr.error("{{ Session::get('error') }}");</script>
    @endif
@endsection
