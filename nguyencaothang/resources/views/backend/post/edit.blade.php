@extends('layouts.admin')
@section('title', 'Post')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h1 class="d-inline">Tất cả bài Post</h1>
                    </div>
                </div>
            </div>
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="card">
                <div class="card-header text-right">
                    <button class="btn btn-sm btn-success">
                        <i class="fa fa-solid fa-plus"></i>
                        Thêm Post
                    </button>
                    <button class="btn btn-sm btn-success">
                        <i class="fa fa-save" aria-hidden="true"></i>
                        Thêm vào thùng rác
                    </button>
                </div>
                <div class="card-body">
                    @php
                        $args = ['id' => $post->id];
                    @endphp
                    <form action="{{ route('admin.post.update', $args) }}" enctype="multipart/form-data" method="post">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label>Tên bài viết (*)</label>
                            <input type="text" name="title" id="title" placeholder="Nhập tiêu đề"
                                class="form-control" value="{{ old('title', $post->title) }}">
                            @error('title')
                                {{ $message }}
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label>Topic (*)</label>
                            <select name="topic_id" class="form-control">
                                <option value="">Chọn Topic</option>
                                {{-- @foreach ($topics as $id => $name)
                                    <option value="{{ $id }}">{{ $name }}</option>
                                @endforeach --}}
                                {!! $htmltopics !!}
                            </select>
                        </div>

                        <div class="mb-3">
                            <label>Chi tiết (*)</label>
                            <textarea rows="3" name="detail" id="detail" placeholder="Nhập chi tiết sản phẩm" class="form-control">{{ old('detail', $post->detail) }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label>Hình đại diện</label>
                            <input type="file" name="image" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label>Mô tả (*)</label>
                            <textarea rows="3" name="description" id="description" placeholder="Nhập mô tả danh mục" class="form-control">{{ old('description', $post->description) }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label>Định dạng</label>
                            <select name="type" class="form-control">
                                {{-- <option value="page">Trang</option>
                                        <option value="post">Bài</option> --}}
                                <option value="2" {{ $post->type == 'page' ? 'selected' : '' }}>Trang</option>
                                <option value="1" {{ $post->type == 'post' ? 'selected' : '' }}>Bài</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label>Trạng thái</label>
                            <select name="status" class="form-control">
                                <option value="2" {{ $post->status == 2 ? 'selected' : '' }}>Chưa xuất bản</option>
                                <option value="1" {{ $post->status == 1 ? 'selected' : '' }}>Xuất bản</option>
                            </select>
                        </div>
                        <div class="card-header text-right">
                            <button class="btn btn-sm btn-success">
                                <i class="fa fa-save" aria-hidden="true"></i>
                                Lưu
                            </button>
                        </div>
                    </form>


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
@endsection
