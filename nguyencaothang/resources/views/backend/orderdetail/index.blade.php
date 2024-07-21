@extends('layouts.admin')
@section('title', 'Dashboard')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="d-inline">Chi tiết đơn hàng</h1>
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
                    <a href="{{ route('admin.order_detail.create') }}" class="btn btn-sm btn-success">
                            <i class="fa fa-plus" aria-hidden="true"></i>Thêm
                        </a>
                        <a href="" class="btn btn-sm btn-danger">
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
                 
               
                            <th>Sản phẩm</th>
                            <th>Đơn hàng</th>
                            <th>Giá</th>
                            <th>Số lượng</th>
                            <th>amount</th>
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
                          
                         
                            <td>
                            {{$row->productname}}
                            </td>
                            <td>
                            {{$row->ordername}}
                            </td>
                            <td>
                            {{$row->price}}
                            </td>
                            <td>
                            {{$row->qty}}
                            </td>
                            <td>
                            {{$row->amount}} 
                            </td>
                            <td class="text-center">
                           
                                <a href="{{route("admin.category.show",['id'=>$row->id])}}" class="btn btn-sm btn-info">
                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                </a>
                                <a href="{{route("admin.category.edit",['id'=>$row->id])}}" class="btn btn-sm btn-primary">
                                    <i class="fa fa-edit" aria-hidden="true"></i>
                                </a>
                                <a href="{{route("admin.category.destroy",['id'=>$row->id])}}" class="btn btn-sm btn-danger">
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
