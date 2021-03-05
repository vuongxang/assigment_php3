@extends('backend.layouts.main')
@section('title','Add post')
@section('page-title','Bài viết')

@section('content')
<div class="row">
    <div class="col-10 offset-1 mt-4">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Thêm Bài viết</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="POST" action="" enctype="multipart/form-data">
                @csrf
                <div class="box-body">
                    <div class="form-group">
                        <label for="exampleInputName">Tiêu đề</label>
                        <input type="text" class="form-control" id="exampleInputName" placeholder="tiêu đề" name="title" value="{{old('title')}}">
                        @if ($errors->has('title'))
                            <span class="text-danger">{{$errors->first('title')}}</span>
                        @endif
                    </div>
                    <div class="form-group">
                      <label>Danh mục bài viết</label>
                        <select name="cate_id" id="">
                            @foreach ($cates as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Nội dung bài viết</label>
                        <br>
                        <textarea name="content" id="" rows="5">{{old('content')}}</textarea>
                        @if ($errors->has('content'))
                            <span class="text-danger">{{$errors->first('content')}}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="exampleInputFile">Ảnh</label>
                        <input type="file" id="exampleInputFile" name="image">
                        @if ($errors->has('image'))
                            <span class="text-danger">{{$errors->first('image')}}</span>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <label for="">Mô tả ngắn</label>
                    <br>
                    <textarea name="short_desc" id="" rows="5">{{old('short_desc')}}</textarea>
                    @if ($errors->has('short_desc'))
                        <span class="text-danger">{{$errors->first('short_desc')}}</span>
                    @endif
                </div>
                <!-- /.box-body -->
                <div class="form-group">
                    <label for="">Tác giả</label>
                    <br>
                    <input type="text" class="form-control" name="author" value="{{old('author')}}">
                    @if ($errors->has('author'))
                        <span class="text-danger">{{$errors->first('author')}}</span>
                    @endif
                </div>

                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Lưu</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection