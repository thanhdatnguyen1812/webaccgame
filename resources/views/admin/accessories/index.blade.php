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
                <div class="card-header">Liệt kê phụ kiện game</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <a href="{{route('accessories.create')}}" class='btn btn-success mb-3'>Thêm phụ kiện game</a>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Tên phụ kiện</th>
                                    <th>Hiển thị</th>
                                    <th>Thuộc game</th>
                                    <th>Quản lý</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($accessories as $key => $access)
                                    <tr>
                                        <td>{{$access->id}}</td>
                                        <td>{{$access->title}}</td>
                                        <td>
                                            @if($access->status==0)
                                                không hiển thị
                                            @else
                                                hiển thị
                                            @endif
                                        </td>
                                        <td>{{$access->category->title}}</td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <a href="{{route('accessories.edit', $access->id)}}" class="btn btn-warning btn-sm">Sửa</a>
                                                <form action="{{route('accessories.destroy',[$access->id])}}" method="POST" class="d-inline">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button type="submit" onclick="return confirm('Bạn muốn xóa phụ kiện game này không?');" class="btn btn-danger btn-sm">Xóa</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $accessories->links('pagination::bootstrap-4') }}
                    </div> <!-- Kết thúc table-responsive -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
