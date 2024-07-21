@extends('layouts.admin')
@section('content')
@section('title', 'Danh sách danh mục con đã bị xóa')
<div class="content-wrapper">
    <!-- CONTENT -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Danh sách danh mục con của:{{ $category->name }} (ĐÃ BỊ XÓA)</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.index') }}">Trang chủ</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.category.index') }}">Danh mục</a></li>
                        <li class="breadcrumb-item active">Danh mục con đã bị xóa</li>
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
                        <a href="{{ route('admin.category.show',['id'=>$category->id]) }}" class="btn btn-sm btn-secondary">
                            <i class="fa fa-arrow-left" aria-hidden="true"></i> Quay về
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 30px;">#</th>
                            <th class="text-center" style="width: 90px;">Hình</th>
                            <th>Tên danh mục</th>
                            <th class="text-center">Thuộc parent</th>
                            <th class="text-center" style="width: 190px;">Chức năng</th>
                            <th class="text-center" style="width: 30px;">ID</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($list_category_trash as $row)
                            @php
                                $parentName =
                                    $row->parent_id == 0 ? 'Cấp cha' : ($row->parent ? $row->parent->name : 'Không có');
                            @endphp
                            <tr>
                                <td class="text-center">
                                    <input type="checkbox">
                                </td>
                                <td class="text-center">
                                    <img src="{{ asset('img/categories/' . $row->image) }}" class="img-fluid"
                                        alt="{{ $row->image }}">
                                </td>
                                <td>{{ $row->name }}</td>
                                <td class="text-center">{{ $parentName }}</td>
                                <td class="text-center">
                                    @php
                                        $agrs = ['id' => $row->id];
                                    @endphp
                                    <a href="{{ route('admin.category.restore', $agrs) }}" class="btn btn-sm btn-secondary">
                                        <i class="fa fa-trash-restore" aria-hidden="true"></i>
                                    </a>
                                    <a href="{{ route('admin.category.destroy', $agrs) }}" class="btn btn-sm btn-danger">
                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                    </a>
                                </td>
                                <td class="text-center">{{ $row->id }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    <!-- /.CONTENT -->
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
