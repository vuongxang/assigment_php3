@extends('backend.layouts.main')
@section('page-title')
@section('content')
    <div class="container">
        <table id="example2" class="table table-bordered table-hover dataTable" role="grid"
            aria-describedby="example2_info">
            <thead>
                <tr role="row">
                    <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
                        aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">ID</th>
                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
                        aria-label="Browser: activate to sort column ascending">Tên danh mục</th>
                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
                        aria-label="Platform(s): activate to sort column ascending">Ảnh</th>
                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
                        aria-label="Engine version: activate to sort column ascending">Tổng số bài viết</th>
                    <th class="sorting text-center" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
                        aria-label="CSS grade: activate to sort column ascending">
                        <a href="{{route('cate.create')}}" class="fa fa-plus-square btn btn-primary">Add new</a>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cates as $item)
                <tr role="row" class="odd">
                    <td class="sorting_1">{{$item->id}}</td>
                    <td>{{$item->name}}</td>
                    <td>
                        <img src="{{asset($item->logo)}}" alt="" width="70">
                    </td>
                    <td>{{count($item->posts)}}</td>
                    <td>
                        <div class="btn-group">
                            <a href="{{route('cate.edit',['id' => $item->id])}}" class="fa fa-edit btn btn-success">Edit</a>
                            <a onclick="return confirm('Bạn chắc chắn xóa')" href="{{route('cate.destroy',['id' => $item->id])}}" class="fas fa-trash-alt btn btn-danger">remove</a>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
