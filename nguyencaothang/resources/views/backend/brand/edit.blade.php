@extends('layouts.admin')
@section('title', 'Brand')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12 row">
                        <h1 class="d-inline col-md-10">Tất cả Thương Hiệu</h1>
                        <div class="col-md-2 text-right">
                            <a href="#" class="text-danger"><i class="fa fa-trash"
                                    aria-hidden="true"></i><sup>0</sup></a>
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
                @php
                        $args = ['id' => $brand->id];
                    @endphp
                    <div class="row">
                        <div class="col-md-3">
                        <form action="{{ route('admin.brand.update', $args) }}"enctype="multipart/form-data" method="post">
                        @csrf
                        @method('PUT')
                             
                                <div class="mb-3">
                                    <label for="name">Tên Thương Hiệu</label>
                                    {{-- old là giữ lại giá trị đó nếu 1 trong cái khác trong bài bị lỗi thì nó sẽ load lại form này, old giúp giữ lại giá trị để khỏi cần nhập lại --}}
                                    <input type="text" value="{{ old('name',$brand->name) }}" name="name" id="name" class="form-control"> 
                                    @error('name')
                                        {{ $message }}
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="description">Mô tả</label>
                                    <textarea rows="3" name="description" id="description" placeholder="Nhập mô tả " class="form-control" >{{ old('description',$brand->description) }}</textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="sort_order">Sắp xếp</label>
                                    <select name="sort_order" id="sort_order" class="form-control">
                                        <option value="0">Chọn vị trí</option>
                                        {!! $htmlsortOrder !!}
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="image">Hình ảnh</label>
                                    <input type="file" name="image" id="image" class="form-control">
                                </div>
                                <div class="mb-3">
                            <label>Trạng thái</label>
                            <select name="status" class="form-control">
                                <option value="2" {{($brand->status==2)?'selected':''}}>Chưa xuất bản</option>
                                <option value="1" {{($brand->status==1)?'selected':''}}>Xuất bản</option>
                            </select>
                        </div>
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-success">Thêm Thương Hiệu</button>
                                </div>
                            </form>
                        </div>
                        
                    </div>
                </div>
            </div>
        </section>
    </div>

@endsection
