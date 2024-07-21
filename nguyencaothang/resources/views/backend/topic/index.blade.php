@extends('layouts.admin')
@section('title', 'Topic')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12 row">
                        <h1 class="d-inline col-md-10">Tất cả Chủ đề</h1>
                        <div class="col-md-2 text-right">
                            <a href="{{ route('admin.topic.trash') }}" class="text-danger"><i class="fa fa-trash"
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
                    <div class="row">
                        <div class="col-md-3">
                            <form action="{{ route('admin.topic.store') }}" method="post">
                                @csrf
                                <div class="mb-3">
                                    <label for="name">Tên Chủ đề</label>
                                    {{-- old là giữ lại giá trị đó nếu 1 trong cái khác trong bài bị lỗi thì nó sẽ load lại form này, old giúp giữ lại giá trị để khỏi cần nhập lại --}}
                                    <input type="text" value="{{ old('name') }}" name="name" id="name" class="form-control"> 
                                    @error('name')
                                        {{ $message }}
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="slug">Slug</label>
                                    <input name="slug" id="slug" rows="3" class="form-control">{{ old('slug') }}</input>
                                </div>
                                <div class="mb-3">
                                    <label for="sort_order">Sắp xếp</label>
                                    <select name="sort_order" id="sort_order" class="form-control">
                                        <option value="0">Chọn vị trí</option>
                                        {!! $htmlsortorder !!}
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="description">Mô tả</label>
                                    <textarea name="description" id="description" rows="3" class="form-control">{{ old('description') }}</textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="status">Trạng thái</label>
                                    <select name="status" id="status" class="form-control">
                                        <option value="2">Chưa xuất bản</option>
                                        <option value="1">Xuất bản</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-success">Thêm Chủ đề</button>
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
                                        <th>Id</th>
                                        <th>Tên Chủ đề</th>
                                        <th>Tên slug</th>
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
                                            {{$row->id}}
                                        </td>
                                        <td>
                                            {{$row->name}}
                                        </td>
                                        <td>
                                            {{$row->slug}}
                                        </td>
                                        <td>
                                            {{$row->description}}
                                        </td>
                                        @php
                                                    $agrs = ['id' => $row->id];
                                                @endphp
                                        <td>
                                        @if ($row->status == 1)
                                                    <a href="{{ route('admin.topic.status', $agrs) }}"
                                                        class="btn btn-sm btn-success">
                                                        <i class="fa fa-toggle-on" aria-hidden="true"></i>
                                                    </a>
                                                @else
                                                    <a href="{{ route('admin.topic.status', $agrs) }}"
                                                        class="btn btn-sm btn-secondary">
                                                        <i class="fa fa-toggle-off" aria-hidden="true"></i>
                                                    </a>
                                                @endif
                                            <a class="btn btn-sm btn-success" href="{{route('admin.topic.edit',$agrs)}}">
                                                <i class="fa fa-edit" aria-hidden="true"></i>
                                            </a>
                                            <a href="{{ route('admin.topic.show', $agrs) }}"
                                                    class="btn btn-sm btn-info">
                                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                                </a>
                                                <a href="{{ route('admin.topic.delete', $agrs) }}"
                                                    class="btn btn-sm btn-danger">
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

