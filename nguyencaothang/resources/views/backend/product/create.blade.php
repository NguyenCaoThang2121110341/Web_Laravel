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
            <div class="col-12 text-right">
        <a href="{{route('admin.product.index')}}" class="btn btn-sm btn-warning">
                            <i class="fa fa-arrow-left" aria-hidden="true"></i> Quay lại
                        </a>
            </div>
            </div>
            <div class="card-body">
                <div class="row">
                    
                <div class="col-md-9 ">
                <form action="{{ route('admin.product.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                    
                        <div class="mb-9">
                            <label>Tên sản phẩm (*)</label>
                            <input type="text" value="{{ old("name") }}"  name="name" id="name" class="form-control" onkeydown="handle_slug(this.value);">
                            @error('name')
                                {{ $message }}
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label>Chi tiết</label>
                            <textarea type="text" style="height:250px;" value="{{ old("detail") }}"  name="detail" id="detail"  class="form-control"></textarea>
                            @error('detail')
                                {{ $message }}
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label>Mô tả</label>
                            <textarea type="text"  style="height:250px;"value="{{ old("description") }}"  name="description" id="description"  class="form-control"></textarea>
                            @error('description')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label>Danh mục (*)</label>
                            <select name="category_id" class="form-control">
                                <option value="0">Chọn danh mục</option>
                                {!!$htmlcategoryid!!}
                            </select>
                        </div>
                        <div class="mb-3">
                            <label>Thương hiệu (*)</label>
                            <select name="brand_id" class="form-control">
                                <option value="0">Chọn thương hiệu</option>
                                {!!$htmlbrandid!!}
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
                            <label>Giá khuyến mãi</label>
                            <input type="text"  value="{{ old("pricesale") }}"  name="pricesale" id="pricesale"  class="form-control">
                            @error('pricesale')
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
                            <label>Hình đại diện</label>
                            <input type="file" name="image" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label>Trạng thái</label>
                            <select name="status" class="form-control">
                                <option value="1">Xuất bản</option>
                                <option value="2">Chưa xuất bản</option>
                            </select>
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
