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
                <div class="card-header">Liệt kê Slider</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <a href="{{route('slider.create')}}" class='btn btn-success mb-3'>Thêm slider</a>
                    <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Tên slider</th>
                                    <th>Mô tả</th>
                                    <th>Hiển thị</th>
                                    <th>Hình ảnh</th>
                                    <th>Quản lý</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($slider as $key => $sli)
                                    <tr>
                                        <td>{{$sli->id}}</td>
                                        <td>{{$sli->title}}</td>
                                        <td>{{$sli->description}}</td>
                                        <td>
                                            @if($sli->status==0)
                                                không hiển thị
                                            @else
                                                hiển thị
                                            @endif
                                        </td>
                                        <td><img src="{{asset('uploads/slider/'.$sli->image)}}" class="img-fluid img-thumbnail" style="max-width: 150px; max-height: 150px;"></td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <a href="{{route('slider.edit', $sli->id)}}" class="btn btn-warning btn-sm">Sửa</a>
                                                <form action="{{route('slider.destroy',[$sli->id])}}" method="POST" class="d-inline">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button type="submit" onclick="return confirm('Bạn muốn xóa slider này không?');" class="btn btn-danger btn-sm">Xóa</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                    </table> 
                    {{ $slider->links('pagination::bootstrap-4') }}                  
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
