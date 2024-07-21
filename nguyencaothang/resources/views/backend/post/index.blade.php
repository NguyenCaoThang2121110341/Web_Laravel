@extends('layouts.admin')
@section('title', 'Post')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12 row">
                        <h1 class="d-inline col-md-10">Tất cả Bài đăng</h1>
                        <div class="col-md-2 text-right">
                            <a href="{{ route('admin.post.trash') }}" class="text-danger"><i class="fa fa-trash" aria-hidden="true"></i><sup>0</sup></a>
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
                        <form action="{{ route('admin.post.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="title">Tiêu đề</label>
                                    <input type="text" value="{{ old('title') }}" name="title" id="title" class="form-control">
                                    @error('title')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="slug">Slug</label>
                                    <input type="text" value="{{ old('slug') }}" name="slug" id="slug" class="form-control">
                                    @error('slug')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="detail">Chi Tiết</label>
                                    <input type="text" value="{{ old('detail') }}" name="detail" id="detail" class="form-control">
                                    @error('detail')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="image">Hình ảnh</label>
                                    <input type="file" name="image" id="image" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label for="type">Type</label>
                                    <select name="type" id="type" class="form-control">
                                        <option value="post">Post</option>
                                        <option value="page">Page</option>
                                    </select>
                                    @error('type')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="mb-3">
                                    <label for="description">Mô tả</label>
                                    <textarea name="description" id="description" rows="3" class="form-control">{{ old('description') }}</textarea>
                                    @error('description')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="topic_id">Chủ đề</label>
                                    <select name="topic_id" id="topic_id" class="form-control">
                                        @foreach ($topics as $topic)
                                            <option value="{{ $topic->id }}">{{ $topic->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('topic_id')
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
                                        <th>Tiêu đề</th>
                                        <th>Hinh anh</th>
                                        <th>Slug</th>
                                        <th>Mô tả</th>
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
                                            {{ $row->title }}
                                        </td>
                                        <td class="text-center">
                            <img src="{{asset('images/posts/'.$row->image)}}" alt="post.jpg" style="width: 200px; height: 150px;">
                         
                            </td>
                                        <td>
                                            {{ $row->slug }}
                                        </td>
                                        <td>
                                            {{ $row->description }}
                                        </td>
                                        @php
                                        $agrs = ['id' => $row->id];
                                    @endphp
                                        <td>
                                        @if ($row->status == 1)
                                        <a href="{{ route('admin.post.status', $agrs) }}"
                                            class="btn btn-sm btn-success">
                                            <i class="fa fa-toggle-on" aria-hidden="true"></i>
                                        </a>
                                    @else
                                        <a href="{{ route('admin.post.status', $agrs) }}"
                                            class="btn btn-sm btn-secondary">
                                            <i class="fa fa-toggle-off" aria-hidden="true"></i>
                                        </a>
                                    @endif
                                            <a class="btn btn-sm btn-success" href="{{route('admin.post.edit',$agrs)}}">
                                                <i class="fa fa-edit" aria-hidden="true"></i>
                                            </a>
                                            <a href="{{ route('admin.post.show', $agrs) }}" class="btn btn-sm btn-info">
                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                    </a>
                                    <a href="{{ route('admin.post.delete', $agrs) }}" class="btn btn-sm btn-danger">
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
