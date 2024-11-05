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
                <div class="card-header">Cập nhập phụ kiện game</div>
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
                    <a href="{{route('accessories.index')}}" class='btn btn-success'>Liệt kê phụ kiện game</a>
                    <a href="{{route('accessories.create')}}" class='btn btn-success'>Thêm phụ kiện game</a>
                    <form action="{{route('accessories.update',$accessories->id)}}" method="POST" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Title</label>
                            <input type="text" class="form-control"  value="{{ $accessories->title }}" name="title" placeholder="...">
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Status</label>
                            <select class="form-control" required name='status'>
                                @if($accessories->status==1)
                                <option value="1" selected>Hiển thị</option>
                                <option value="0">Không hiển thị</option>
                                @else
                                <option value="1" >Hiển thị</option>
                                <option value="0" selected>Không hiển thị</option>
                                @endif
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">thuộc game</label>
                            <select class="form-control" required name='category_id'>
                               @foreach($category as $key => $cate)
                                 <option {{$cate->id==$accessories->category_id ? 'selected' : ''}} value="{{$cate->id}}">{{$cate->title}}</option>
                               @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Cập nhập</button>
                    </form>

                </div>
            </div>
        </div>
</div>
   
@endsection