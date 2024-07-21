@extends('layouts.admin')
@section('title', 'Order')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12 row">
                        <h1 class="d-inline col-md-10">Đơn Đặt Hàng</h1>
                        <div class="col-md-2 text-right">
                            <a href="#" class="text-danger"><i class="fa fa-trash" aria-hidden="true"></i><sup>0</sup></a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="card">
                <div class="card-header text-right">
                    <button class="btn btn-sm btn-success">
                        <i class="fa fa-save" aria-hidden="true"></i>
                        Lưu
                    </button>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <form action="{{ route('admin.order.store') }}" method="post">
                                @csrf
                                <div class="mb-3">
                                    <label for="name">Tên Người Đặt</label>
                                    {{-- old là giữ lại giá trị đó nếu 1 trong cái khác trong bài bị lỗi thì nó sẽ load lại form này, old giúp giữ lại giá trị để khỏi cần nhập lại --}}
                                    <input type="text" value="{{ old('name') }}" name="name" id="name" class="form-control"> 
                                    @error('name')
                                        {{ $message }}
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="phone">Điện thoại</label>
                                    <input type="number" value="{{ old('phone') }}" name="phone" id="phone" class="form-control">
                                    @error('phone')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="email">Email</label>
                                    <input type="text" value="{{ old('email') }}" name="email" id="email" class="form-control">
                                    @error('email')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                          
                                <div class="mb-3">
                                    <label for="title">Tiêu đề</label>
                                    <input type="text" value="{{ old('title') }}" name="title" id="title" class="form-control">
                                    @error('title')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>  
                                <div class="mb-3">
                                    <label for="address">Địa chỉ</label>
                                    <input type="text" value="{{ old('address') }}" name="address" id="address" class="form-control">
                                    @error('address')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="note">Ghi Chú</label>
                                    <input type="text" value="{{ old('note') }}" name="note" id="note" class="form-control">
                                    @error('note')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="user_id">Id Người dùng</label>
                                    <select name="user_id" id="user_id" class="form-control">
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->id }}</option>
                                        @endforeach
                                    </select>
                                    @error('user_id')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="status">Trạng thái</label>
                                    <select name="status" id="status" class="form-control">
                                        <option value="2">Chưa xuất bản</option>
                                        <option value="1">Xuất bản</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-success">Thêm bài đăng</button>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-8">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width:30px;">
                                            <input type="checkbox">
                                        </th>
                                        <th>ID</th>
                                      <th>Tên Liên Hệ</th>
                                        <th>Email Liên Hệ</th>
                                        <th>Số điện thoại</th>
                                        <th>Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($list as $row)
                                    <tr class="datarow">
                                        <td>
                                            <input type="checkbox">
                                        </td>
                                        <td>
                                            {{ $row->id }}
                                        </td>
                                        <td>
                                            {{ $row->name }}
                                        </td>
                                        <td>
                                            {{ $row->email}}
                                        </td>
                                        <td>
                                            {{ $row->phone }}
                                        </td>
                                        <td>
                                            <a class="btn btn-sm btn-warning" href="#">Hiện</a>
                                            <a class="btn btn-sm btn-success" href="#">
                                                <i class="fa fa-edit" aria-hidden="true"></i>
                                            </a>
                                            <a class="btn btn-sm btn-info" href="{{ route('admin.post.show', ['id' => $row->id]) }}">
                                                <i class="fa fa-eye" aria-hidden="true"></i>
                                            </a>
                                            <a class="btn btn-sm btn-danger" href="#">
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


