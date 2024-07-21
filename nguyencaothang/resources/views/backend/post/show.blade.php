@extends('layouts.admin')
@section('content')
@section('title', 'Chi tiết bài viết')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Chi Tiết Bài Viết: {{ $post->title }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.index') }}">Trang chủ</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.post.index') }}">Bài viết</a></li>
                        <li class="breadcrumb-item active">Chi tiết</li>
                    </ol>
                </div>
                <a href="{{ route('admin.post.index') }}" class="btn btn-sm btn-secondary">
                                <i class="fa fa-arrow-left" aria-hidden="true"></i> Quay về
                            </a>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <img src="{{ asset('images/posts/' . $post->image) }}" alt="{{ $post->title }}"
                            class="card-img-top">
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <h2 class="card-title">{{ $post->title }}</h2>
                            <p class="card-text"><strong>Slug:</strong> {{ $post->slug }}</p>

                            <hr>
                            <h3 class="card-title"><strong>Thuộc chủ đề:</strong> </h3>
                            <p class="card-text">
                                {{ $post->topic->name }}
                            </p>
                            <hr>

                            <div class="card-text">
                                <strong>Chi tiết: </strong>{!! $post->detail !!} </div>
                            <hr>
                            <h3 class="card-title">Thông tin bổ sung:</h3>
                            <dl class="row">
                                <dt class="col-sm-4">Mô tả:</dt>
                                <dd class="col-sm-8">{{ $post->description }}</dd>

                                <dt class="col-sm-4">Trạng thái:</dt>
                                <dd class="col-sm-8">
                                    <span class="badge badge-{{ $post->status == 1 ? 'success' : 'secondary' }}">
                                        {{ $post->status == 1 ? 'Xuất bản' : 'Chưa xuất bản' }}
                                    </span>
                                </dd>

                                <dt class="col-sm-4">Người tạo:</dt>
                                <dd class="col-sm-8">{{ $post->createdBy->name ?? 'N/A' }}</dd>

                                <dt class="col-sm-4">Người cập nhật:</dt>
                                <dd class="col-sm-8">{{ $post->updatedBy->name ?? 'N/A' }}</dd>

                                <dt class="col-sm-4">Ngày tạo:</dt>
                                <dd class="col-sm-8">{{ $post->created_at }}</dd>

                                <dt class="col-sm-4">Ngày cập nhật:</dt>
                                <dd class="col-sm-8">{{ $post->updated_at }}</dd>
                            </dl>
                        </div>
                        <div class="card-footer">
                           
                        </div>
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
@endsection
