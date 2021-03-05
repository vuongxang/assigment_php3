@extends('backend.layouts.main')
@section('page-title','quản lý bài viết')
@section('content')
    <div class="container">
        <table id="example2" class="table table-bordered table-hover dataTable" role="grid"
            aria-describedby="example2_info">
            <thead>
                <h3>Import file</h3>
                <form action="{{route('post.import')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="post_file" id="">
                    <button type="submit">Save</button>
                </form>
                <tr role="row">
                    <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
                        aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">ID</th>
                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
                        aria-label="Browser: activate to sort column ascending">Tiêu đề</th>
                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
                        aria-label="Platform(s): activate to sort column ascending">Ảnh</th>
                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
                        aria-label="Engine version: activate to sort column ascending">Danh mục</th>
                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
                        aria-label="CSS grade: activate to sort column ascending">Tác giả</th>
                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
                    aria-label="CSS grade: activate to sort column ascending">
                        <a href="{{route('post.create')}}" class="fa fa-plus-square btn btn-primary">Add new</a>
                        <a href="{{route('post.export')}}" class="btn btn-outline-info">Export</a>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $item)
                <tr role="row" class="odd">
                    <td class="sorting_1">{{$item->id}}</td>
                    <td>{{$item->title}}</td>
                    <td>
                        <img src="{{asset($item->image)}}" alt="" width="70">
                    </td>
                    <td>{{$item->category->name}}</td>
                    <td>{{$item->author}}</td>
                    <td>
                        <div class="btn-group">
                            <a href="{{route('post.edit', ['id' => $item->id])}}" class="fa fa-edit btn btn-success">Edit</a>
                            <a  onclick="return confirm('Bạn chắc chắn xóa')" href="{{route('post.destroy',$item->id)}}" class="fas fa-trash-alt btn btn-danger">remove</a>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="col-xs-4 offset-xs-8 pull-right">
            {{$posts->links()}}
        </div>
    </div>
@endsection
