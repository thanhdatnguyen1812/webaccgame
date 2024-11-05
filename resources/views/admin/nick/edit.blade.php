@extends('layouts.app')
@section('navbar')
  <div class='container'>
  @include('admin.include.navbar')
  </div>
@endsection<form>
@section('content')
<div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Cập nhập nick game</div>
                @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <a href="{{route('nick.index')}}" class='btn btn-success'>Liệt kê nick game</a>
                    <a href="{{route('nick.create')}}" class='btn btn-success'>Thêm nick game</a>
                    <form action="{{route('nick.update',$nick->id)}}" method="POST" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Title</label>
                            <input type="text" class="form-control"  value="{{ $nick->title }}" name="title" placeholder="...">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Price</label>
                            <input type="text" class="form-control" name="price"  value="{{ $nick->price }}" placeholder="...">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Image</label>
                            <input type="file"  class="form-control-file" name='image' >
                            <td><img src="{{asset('uploads/nick/'.$nick->image)}}" class="img-thumbnail"></td>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Description</label>
                            <textarea class="form-control"  name='description' placeholder="...">{{$nick->description}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Status</label>
                            <select class="form-control" name='status'>
                                @if($nick->status==1)
                                <option value="1" selected>Hiển thị</option>
                                <option value="0">Không hiển thị</option>
                                @else
                                <option value="1" >Hiển thị</option>
                                <option value="0" selected>Không hiển thị</option>
                                @endif
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="status">Thuộc game</label>
                            <select class="form-control " name="category_id">
                                <option value="0">----chọn game cần thêm----</option>
                                @foreach($category as $key=>$cate)
                                <option value="{{$cate->id}}" {{$cate->id==$nick->category_id ? 'selected': ''}}>{{$cate->title}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">thuộc game</label>
                            <textarea class="form-control"  name='attribute' placeholder="...">{{$nick->attribute}}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Cập nhập</button>
                    </form>

                </div>
            </div>
        </div>
</div>
   
@endsection