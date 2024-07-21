@extends('layouts.admin')

@section('title', 'Chi tiết Menu')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Chi tiết Menu</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('admin.menu.index') }}" class="btn btn-primary">Quay lại Menu</a>
                </div>
            </div>
        </div>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <table class="table table-bordered">
                            <tr>
                                <th>ID:</th>
                                <td>{{ $menu->id }}</td>
                            </tr>
                            <tr>
                                <th>Tên Menu:</th>
                                <td>{{ $menu->name }}</td>
                            </tr>
                            <tr>
                                <th>Link:</th>
                                <td>{{ $menu->link }}</td>
                            </tr>
                            <tr>
                                <th>Type:</th>
                                <td>{{ $menu->type }}</td>
                            </tr>
                            <tr>
                                <th>Position:</th>
                                <td>{{ $menu->position }}</td>
                            </tr>
                            <tr>
                                <th>Trạng thái:</th>
                                <td>{{ $menu->status == 1 ? 'Xuất bản' : 'Chưa xuất bản' }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-12 text-right">
                        <a href="{{ route('admin.menu.edit', $menu->id) }}" class="btn btn-primary">Chỉnh sửa</a>
                        <form action="{{ route('admin.menu.destroy', $menu->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Xóa</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
