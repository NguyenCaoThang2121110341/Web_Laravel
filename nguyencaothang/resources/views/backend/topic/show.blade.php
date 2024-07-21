@extends('layouts.admin')
@section('content')
@section('title', 'Chi tiết chủ đề bài viết')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Chi tiết chủ đề bài viết: {{ $topic->name }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.index') }}">Trang chủ</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.topic.index') }}">Chủ đề bài viết</a></li>
                        <li class="breadcrumb-item active">Chi tiết</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-12 text-right">
                        @if ($topic->posts->count() > 0)
                            <a href="{{ route('admin.topic.trash-post-by-topic-on-show', ['id' => $topic->id]) }}"
                                class="btn btn-sm btn-danger trash-count-post-by-topic-btn">
                                <i class="fa fa-trash" aria-hidden="true"></i> Bài viết
                            </a>
                        @endif
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8">
                        <dl class="row">
                            <dt class="col-sm-4">Tên chủ đề bài viết:</dt>
                            <dd class="col-sm-8">{{ $topic->name }}</dd>

                            <dt class="col-sm-4">Slug:</dt>
                            <dd class="col-sm-8">{{ $topic->slug }}</dd>

                            <dt class="col-sm-4">Mô tả:</dt>
                            <dd class="col-sm-8">{{ $topic->description }}</dd>

                            <dt class="col-sm-4">Trạng thái:</dt>
                            <dd class="col-sm-8">{{ $topic->status == 1 ? 'Xuất bản' : 'Chưa xuất bản' }}</dd>

                            <dt class="col-sm-4">Người tạo:</dt>
                            <dd class="col-sm-8">{{ $topic->createdBy->name ?? 'N/A' }}</dd>

                            <dt class="col-sm-4">Người cập nhật:</dt>
                            <dd class="col-sm-8">{{ $topic->updatedBy->name ?? 'N/A' }}</dd>

                            <dt class="col-sm-4">Ngày tạo:</dt>
                            <dd class="col-sm-8">{{ $topic->created_at }}</dd>

                            <dt class="col-sm-4">Ngày cập nhật:</dt>
                            <dd class="col-sm-8">{{ $topic->updated_at }}</dd>
                        </dl>
                    </div>
                </div>

                <div class="row mt-4">
                    @if ($topic->posts->count() > 0 && $hasActivePost)
                        <div class="col-md-12">
                            <h4>Bài viết thuộc chủ đề bài viết:</h4>
                            <div class="list-group list-group-flush" style="max-height: 300px; overflow-y: auto;">
                                @foreach ($topic->posts as $post)
                                    @if ($post->status != 0 && $post->status != 3)
                                        <div class="list-group-item">
                                            <div class="d-flex w-100 justify-content-between">
                                                <div class="d-flex align-items-center">
                                                    <img src="{{ asset('images/posts/' . $post->image) }}"
                                                        alt="{{ $post->title }}" class="img-thumbnail mr-2"
                                                        style="max-width: 50px;">
                                                    <h5 class="mb-1">{{ $post->title }}</h5>
                                                </div>
                                                <div class="d-flex">
                                                    <div style="display: inline-block;">
                                                        <a href="{{ route('admin.post.edit', ['id' => $post->id]) }}"
                                                            class="btn btn-sm btn-primary">
                                                            <i class="fa fa-edit" aria-hidden="true"></i>
                                                        </a>
                                                    </div>
                                                    <div style="display: inline-block; margin-left: 5px;">
                                                        <a href="{{ route('admin.topic.delete-post-by-topic-on-show', ['id' => $post->id]) }}"
                                                            class="btn btn-sm btn-danger">
                                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    @endif
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
<script>
    $(document).ready(function() {
        $.ajax({
            url: "{{ route('admin.post.by.topic.trash.count', ['id' => $topic->id]) }}",
            method: 'GET',
            success: function(response) {
                $('.trash-count-post-by-topic-btn').append(' (' + response.count + ')');
            },
            error: function() {
                console.error('Lỗi khi lấy số lượng bài viết thuộc chủ đề trong thùng rác.');
            }
        });
    });
</script>
@endsection
