@extends('layouts.app')
@section('navbar')
  <div class='container'>
    @include('admin.include.navbar')
  </div>
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Liệt kê danh mục game</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <a href="{{route('category.create')}}" class='btn btn-success mb-3'>Thêm danh mục game</a>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Tên danh mục</th>
                                    <th>Slug danh mục</th>
                                    <th>Mô tả</th>
                                    <th>Hiển thị</th>
                                    <th>Hình ảnh</th>
                                    <th>Quản lý</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($category as $key => $cate)
                                    <tr>
                                        <td>{{$cate->id}}</td>
                                        <td>{{$cate->title}}</td>
                                        <td>{{$cate->slug}}</td>
                                        <td>{{$cate->description}}</td>
                                        <td>
                                            @if($cate->status==0)
                                                không hiển thị
                                            @else
                                                hiển thị
                                            @endif
                                        </td>
                                        <td><img src="{{asset('uploads/category/'.$cate->image)}}" class="img-fluid img-thumbnail" style="max-width: 150px; max-height: 150px;"></td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <a href="{{route('category.edit', $cate->id)}}" class="btn btn-warning btn-sm">Sửa</a>
                                                <form action="{{route('category.destroy',[$cate->id])}}" method="POST" class="d-inline">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button type="submit" onclick="return confirm('Bạn muốn xóa danh mục game này không?');" class="btn btn-danger btn-sm">Xóa</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $category->links('pagination::bootstrap-4') }}
                    </div> <!-- Kết thúc table-responsive -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
