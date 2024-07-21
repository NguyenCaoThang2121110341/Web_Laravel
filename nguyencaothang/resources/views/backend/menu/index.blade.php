@extends('layouts.admin')

@section('title', 'Quản lý Menu')

@section('content')
<div class="content-wrapper">

    <!-- Main content -->
    <section class="content">
        <div class="card">
            <h1 class="d-inline col-md-10">Trang quản trị menu</h1>

            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card-header  text-white">
                            <h3 class="card-title">
                                <i class="fa fa-plus-circle" aria-hidden="true"></i> Thêm Menu
                            </h3>
                        </div>
                        <form action="{{ route('admin.menu.store') }}" method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="name">Tên Menu</label>
                                <input type="text" value="{{ old('name') }}" name="name" id="name" class="form-control">
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="link">Link</label>
                                <input type="text" name="link" id="link" class="form-control" value="{{ old('link') }}">
                            </div>
                            <div class="mb-3">
                                <label for="sort_order">Sắp xếp</label>
                                <select name="sort_order" id="sort_order" class="form-control">
                                    <option value="0">Chọn vị trí</option>
                                    {!! $htmlsortorder !!}
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="parent_id">Cấp cha</label>
                                <select name="parent_id" id="parent_id" class="form-control">
                                    <option value="0">Cấp cha</option>
                                    {!! $htmlparentid !!}
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="type">Type</label>
                                <input type="text" name="type" id="type" class="form-control" value="{{ old('type') }}">
                            </div>                                
                            <div class="mb-3">
                                <label for="position">Position</label>
                                <input type="text" name="position" id="position" class="form-control" value="{{ old('position') }}">
                            </div>    
                            <div class="mb-3">
                                <label for="status">Trạng thái</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="2">Chưa xuất bản</option>
                                    <option value="1">Xuất bản</option>
                                </select>
                            </div>
                            <div class="mb-3 text-right">
                                <button type="submit" class="btn btn-success">Thêm Menu</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-8">
                        <div class="card-header  text-white">
                            <h3 class="card-title">
                                <i class="fa fa-list" aria-hidden="true"></i> Danh sách Menu
                            </h3>
                        </div>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center" style="width:30px;">
                                        <input type="checkbox">
                                    </th>
                                    <th>Id</th>
                                    <th>Tên Menu</th>
                                    <th>Link</th>
                                    <th>Type</th>
                                    <th>Position</th>
                                    <th class="text-center">Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($list as $row)
                                <tr class="datarow">
                                    <td class="text-center">
                                        <input type="checkbox">
                                    </td>
                                    <td>{{ $row->id }}</td>
                                    <td>{{ $row->name }}</td>
                                    <td>{{ $row->link }}</td>
                                    <td>{{ $row->type }}</td>
                                    <td>{{ $row->position }}</td>
                                    <td class="text-center">
                                        @php
                                            $agrs = ['id' => $row->id];
                                        @endphp
                                        <a href="{{ route('admin.menu.show', $agrs) }}" class="btn btn-sm btn-info" title="Xem Danh Mục">
                                            <i class="fa fa-eye" aria-hidden="true"></i>
                                        </a>
                                        <a href="{{ route('admin.menu.edit', $agrs) }}" class="btn btn-sm btn-primary" title="Chỉnh sửa Danh Mục">
                                            <i class="fa fa-edit" aria-hidden="true"></i>
                                        </a>
                                        <form action="{{ route('admin.menu.destroy', $row->id) }}" method="POST" style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn xóa menu này không?');">
                                                Xóa
                                            </button>
                                        </form>
                                        
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

@section('footer')
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
<script>
    @if (Session::has('success'))
        toastr.success("{{ Session::get('success') }}");
    @endif

    @if (Session::has('error'))
        toastr.error("{{ Session::get('error') }}");
    @endif
</script>
@endsection
