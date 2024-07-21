@extends('layouts.admin')
@section('title', 'Dashboard')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="d-inline">Quản Lý Sản Phẩm</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Quản lý danh mục</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="card">
        <div class="card-header">
                <div class="row">
                    <div class="col-12 text-right">
                    <a href="{{ route('admin.product.create') }}" class="btn btn-sm btn-success">
                            <i class="fa fa-plus" aria-hidden="true"></i>Thêm
                        </a>
                        <a href="{{ route('admin.product.trash') }}" class="btn btn-sm btn-danger">
                            <i class="fa fa-trash" aria-hidden="true"></i>Thùng rác
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
               
                    
                    <table class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th class="text-center" style="width:30px">#</th>
                            <th class="text-center" style="width:90px">Hình</th>
                            <th>Tên sản phẩm</th>
                            <th>Danh mục</th>
                            <th>Thương hiệu</th>
                            <th>Giá</th>
                            <th>Số lượng</th>
                            <th>Mô tả</th>
                            <th class="text-center" style="width:190px">Chức năng</th>
                            <th class="text-center" style="width:30px">ID</th>
                        </tr>
                    </thead>
                    <tbody>
                      @foreach($list as $row)
                        <tr>
                            <td class="text-center">
                              <input type="checkbox">
                            </td>
                            <td class="text-center">
                            <img src="{{asset('images/product/'.$row->image)}}" alt="product.jpg" style="width: 200px; height: 150px;">
                         
                            </td>
                            <td>
                              {{$row->name}}
                            </td>
                            <td>
                            {{$row->categoryname}}
                            </td>
                            <td>
                            {{$row->brandname}}
                            </td>
                            <td>
                            {{$row->price}}
                            </td>
                            <td>
                            {{$row->qty}}
                            </td>
                            <td>
                            {{$row->description}} 
                            </td>
                            
                            <td class="text-center">
                            @php
                                        $agrs = ['id' => $row->id];
                                    @endphp
                            @if ($row->status == 1)
                                        <a href="{{ route('admin.product.status', $agrs) }}"
                                            class="btn btn-sm btn-success">
                                            <i class="fa fa-toggle-on" aria-hidden="true"></i>
                                        </a>
                                    @else
                                        <a href="{{ route('admin.product.status', $agrs) }}"
                                            class="btn btn-sm btn-secondary">
                                            <i class="fa fa-toggle-off" aria-hidden="true"></i>
                                        </a>
                                    @endif
                           
                                    <a href="{{ route('admin.product.show', $agrs) }}" class="btn btn-sm btn-info">
                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                    </a>
                                <a href="{{route('admin.product.edit', $agrs)}}" class="btn btn-sm btn-primary">
                                    <i class="fa fa-edit" aria-hidden="true"></i>
                                </a>
                                    <a href="{{ route('admin.product.delete', $agrs) }}" class="btn btn-sm btn-danger">
                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                        </a>
                            </td>
                           
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                  
            </div>
        </div>
    </section>
</div>

@endsection
