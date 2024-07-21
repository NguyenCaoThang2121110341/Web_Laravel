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
            <div class="col-12 text-right">
        <a href="{{route('admin.order_detail.index')}}" class="btn btn-sm btn-warning">
                            <i class="fa fa-arrow-left" aria-hidden="true"></i> Quay lại
                        </a>
            </div>
            </div>
            <div class="card-body">
                <div class="row">
                    
                <div class="col-md-9 ">
                    <form action="{{route('admin.order_detail.store')}}" method="post">
                        @csrf
                    
                       
                       
                    </div>
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label>Sản phẩm (*)</label>
                            <select name="product_id" class="form-control">
                                <option value="0">Chọn sản phẩm</option>
                                {!!$htmlproductid!!}
                            </select>
                        </div>
                        <div class="mb-3">
                            <label>Đơn hàng (*)</label>
                            <select name="order_id" class="form-control">
                                <option value="0">Chọn đơn hàng</option>
                                {!!$htmlorderid!!}
                            </select>
                        </div>
                        <div class="mb-3">
                            <label>Giá</label>
                            <input type="text"  value="{{ old("price") }}"  name="price" id="price"  class="form-control">
                            @error('price')
                                {{ $message }}
                            @enderror
                        </div>
                  
                        <div class="mb-3">
                            <label>Số lượng</label>
                            <input type="text"  value="{{ old("qty") }}"  name="qty" id="qty"  class="form-control">
                            @error('qty')
                                {{ $message }}
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label>amount</label>
                            <input type="text"  value="{{ old("amount") }}"  name="amount" id="amount"  class="form-control">
                            @error('amount')
                                {{ $message }}
                            @enderror
                        </div>
                        
                        
                        <div class="mb-3">
                           <button type="submit"class="btn btn-success" style="width:293px"> Thêm</button>
                        </div>
                    </form>
                    </div>
                    
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection
