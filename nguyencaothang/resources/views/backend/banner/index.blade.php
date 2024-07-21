@extends('layouts.admin')
@section('title', 'Banner')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12 row">
                        <h1 class="d-inline col-md-10">Tất cả banner</h1>
                    </div>
                </div>
            </div>
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="card">
                <div class="card-header text-right">
                    <a href="{{ route('admin.banner.trash') }}" class="btn btn-sm btn-danger trash-count-btn">
                        <i class="fa fa-trash" aria-hidden="true"></i> Thùng rác
                    </a>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <form action="{{ route('admin.banner.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="name">Tên banner (*)</label>
                                    <input type="text" name="name" id="name" value="{{ old('name') }}"
                                        placeholder="Nhập tên banner" class="form-control">
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="image">Hình ảnh</label>
                                    <input type="file" name="image" id="image" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label for="link">Link</label>
                                    <textarea name="link" id="link" placeholder="Nhập link" class="form-control">{{ old('link') }}</textarea>
                                    @error('link')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="position">Vị trí (*)</label>
                                    <select name="position" id="position" class="form-control">
                                        <option value="slideshow">Slide Show</option>
                                        <option value="mainmenu">Main Menu</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="description">Mô tả (*)</label>
                                    <textarea id="description" name="description" placeholder="Nhập mô tả danh mục" class="form-control">{{ old('description') }}</textarea>
                                    @error('description')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="sort_order">Sắp xếp</label>
                                    <select name="sort_order" id="sort_order" class="form-control">
                                        <option value="0">Chọn vị trí</option>
                                        {!! $htmlsortorder !!}
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="status">Trạng thái</label>
                                    <select name="status" id="status" class="form-control">
                                        <option value="1">Xuất bản</option>
                                        <option value="2">Chưa xuất bản</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-sm btn-success w-100">Thêm banner</button>
                            </form>
                        </div>
                        <div class="col-md-8">
                            <table class="table table-bordered table-hover table-striped">
                                <thead class="thead-white">
                                    <tr>
                                        <th class="text-center" style="width: 30px;">
                                            <input type="checkbox">
                                        </th>
                                        <th>Id</th>
                                        <th class="text-center" style="width: 130px;">Hình ảnh</th>
                                        <th>Tên banner</th>
                                        <th>Vị trí</th>
                                        <th>Chức năng</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($list as $row)
                                        <tr class="datarow">
                                            <td class="text-center">
                                                <input type="checkbox">
                                            </td>
                                            <td>{{ $row->id }}</td>
                                            <td class="text-center">
                                                <img src="{{ asset('images/banner/' . $row->image) }}"
                                                    alt="{{ $row->image }}" class="img-fluid">
                                            </td>
                                            <td>{{ $row->name }}</td>
                                            <td>{{ $row->position }}</td>
                                            <td class="text-center">
                                                @php
                                                    $agrs = ['id' => $row->id];
                                                @endphp
                                                @if ($row->status == 1)
                                                    <a href="{{ route('admin.banner.status', $agrs) }}"
                                                        class="btn btn-sm btn-success">
                                                        <i class="fa fa-toggle-on" aria-hidden="true"></i>
                                                    </a>
                                                @else
                                                    <a href="{{ route('admin.banner.status', $agrs) }}"
                                                        class="btn btn-sm btn-secondary">
                                                        <i class="fa fa-toggle-off" aria-hidden="true"></i>
                                                    </a>
                                                @endif
                                                <a href="{{ route('admin.banner.show', $agrs) }}"
                                                    class="btn btn-sm btn-info">
                                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                                </a>
                                                <a href="{{ route('admin.banner.edit', $agrs) }}"
                                                    class="btn btn-sm btn-primary">
                                                    <i class="fa fa-edit" aria-hidden="true"></i>
                                                </a>
                                                <a href="{{ route('admin.banner.delete', $agrs) }}"
                                                    class="btn btn-sm btn-danger">
                                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
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
    <script>
        $(document).ready(function() {
            $.ajax({
                url: "{{ route('admin.banner.trash.count') }}",
                method: 'GET',
                success: function(response) {
                    $('.trash-count-btn').append(' (' + response.count + ')');
                },
                error: function() {
                    console.error('Lỗi khi lấy số lượng banner trong thùng rác.');
                }
            });
        });
    </script>
@endsection
