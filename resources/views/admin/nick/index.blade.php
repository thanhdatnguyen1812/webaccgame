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
                <div class="card-header">Liệt kê nick game</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <a href="{{route('nick.create')}}" class='btn btn-success mb-3'>Thêm nick game</a>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Tên nick</th>
                                    <th>Mã số</th>
                                    <th>Mô tả</th>
                                    <th>Hiển thị</th>
                                    <th>Hình ảnh</th>
                                    <th>Thuộc game</th>
                                    <th>Thuộc tính </th>
                                    <th>Quản lý</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($nicks as $key => $nick)
                                    <tr>
                                        <td>{{$nick->id}}</td>
                                        <td>{{$nick->title}}</td>
                                        <td>{{$nick->ms}}</td>
                                        <td>{{$nick->description}}</td>
                                        <td>
                                            @if($nick->status==0)
                                                không hiển thị
                                            @else
                                                hiển thị
                                            @endif
                                        </td>
                                        <td><img src="{{asset('uploads/nick/'.$nick->image)}}" class="img-fluid img-thumbnail" style="max-width: 150px; max-height: 150px;"></td>
                                        <td>{{$nick->category->title}}</td>
                                        <td>
                                            @php
                                            $attribute = json_decode($nick->attribute,true);
                                            @endphp
                                            @foreach($attribute as $attr)
                                               <span class="badge badge-dark">{{$attr}}</span>
                                            @endforeach
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <a href="{{route('nick.edit', $nick->id)}}" class="btn btn-warning btn-sm">Sửa</a>
                                                <form action="{{route('nick.destroy',[$nick->id])}}" method="POST" class="d-inline">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button type="submit" onclick="return confirm('Bạn muốn xóa nick game này không?');" class="btn btn-danger btn-sm">Xóa</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $nicks->links('pagination::bootstrap-4') }}
                    </div> <!-- Kết thúc table-responsive -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
