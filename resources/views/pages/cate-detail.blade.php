@extends('layouts.main')
@section('content')
<div class="text-center">
    <h2 class="section-heading text-uppercase">{{$cate->name}}</h2>
    <h3 class="section-subheading text-muted">Tin tức mới nhất</h3>
</div>
<div class="row">
    @foreach ($posts as $item)
        <div class="col-lg-4 col-sm-6 mb-4">
            <div class="portfolio-item">
                <a class="portfolio-link" href="{{route('post.detail',$item->id)}}">
                    <div class="portfolio-hover">
                        <div class="portfolio-hover-content"><i class="fas fa-plus fa-3x"></i></div>
                    </div>
                    <img class="img-fluid" src="{{asset($item->image)}}" alt="" />
                </a>
                <div class="portfolio-caption">
                    <a href="{{route('post.detail',$item->id)}}" class="portfolio-caption-heading text-dark">{{$item->title}}</a>
                    <div class="portfolio-caption-subheading text-muted">Chuyên mục: {{$item->category->name}}</div>
                </div>
            </div>
        </div>
    @endforeach
    {{$posts->links()}}
</div>
@endsection