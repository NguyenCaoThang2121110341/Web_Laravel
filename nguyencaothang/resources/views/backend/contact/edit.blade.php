@extends('layouts.admin')
@section('title', 'Contact')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Bảng contact</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
                        <li class="breadcrumb-item active">Bảng contact</li>
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
                        {{-- <a href="#" class="btn btn-sm btn-success">
              <i class="fa fa-plus" aria-hidden="true"></i>Thêm
            </a> --}}
                        <a href="#" class="btn btn-sm btn-danger">
                            <i class="fa fa-trash" aria-hidden="true"></i>Thùng rác
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
            @php
                        $args = ['id' => $contact->id];   
                    @endphp
                    <div class="row">
                     <div class="col-md-4">
                        <form action="{{ route('admin.contact.update', $args) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label>Tên liên hệ (*)</label>
                                <input type="text" name="name" id="name" placeholder="Nhập tên danh mục"
                                    class="form-control" value="{{ old('name',$contact->name) }}">
                                @error('name')
                                    {{ $message }}
                                @enderror
                            </div>
                            <!-- <div class="mb-3">
                            <label>User</label>
                            <select name="user_id" class="form-control">
                                <option value="">Chọn user</option>
                                {{-- @foreach ($users as $id => $name)
                                    <option value="{{ $id }}">{{ $name }}</option>
                                @endforeach --}}
                                {!! $htmlusers !!}
                            </select>
                        </div>
</div> -->
                            <div class="mb-3">
                                <label>User</label>
                                <select name="user_id" class="form-control">
                                <option value="">Chọn user</option>
                                {{-- @foreach ($users as $id => $name)
                                    <option value="{{ $id }}">{{ $name }}</option>
                                @endforeach --}}
                                {!! $htmlusers !!}
                            </select>
                            </div>
                            <div class="mb-3">
                                <label>Email</label>
                                <textarea rows="3" name="email" id="email" placeholder="Nhập email" class="form-control" value="{{$contact->email}}">{{ old('email',$contact->email) }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label>Phone</label>
                                <textarea rows="1"  name="phone" id="phone" placeholder="Type" class="form-control" value="{{$contact->phone}}">{{ old('phone',$contact->phone) }}</textarea>
                            </div>
                            <div class="mb-3">
                            <label>Title</label>
                            <textarea rows="1"  name="title" id="title" placeholder="Type" class="form-control">{{ old('title',$contact->title) }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label>Hình</label>
                                <input type="file" name="image" class="form-control">
                            </div>
                       
                            <div class="mb-3">
                                <label>Content (*)</label>
                                <textarea rows="3" name="content" id="descricontentption" placeholder="Nhập content của contact" class="form-control">{{ old('contant',$contact->content) }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label>Replay Id (*)</label>
                                <input type="number" value="{{ old('replay_id',$contact->replay_id) }}" name="replay_id" id="replay_id" placeholder="Nhập replay id" class="form-control"></input>
                            </div>
                     
                            <div class="mb-3">
                                <label>Trạng thái</label>
                                <select name="status" class="form-control">
                                    <option value="1">Xuất bản</option>
                                    <option value="2">Chưa xuất bản</option>
                                </select>
                            </div>
            
            
                            <div class="card-header text-right">
                                <button class="btn btn-sm btn-success">
                                    <i class="fa fa-save" aria-hidden="true"></i>
                                    Lưu
                                </button>
                            </div>

                        </form>
                    </div> 
        </div>
        </div>
    </section>
@endsection
