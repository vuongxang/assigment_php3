@extends('layouts.main')
@section('header')
<header class="masthead">
    <div class="container-fluid">
        <div class="row">
            <div class="col-8">
                <div class="masthead-subheading">Welcome To Start News!</div>
                <div class="masthead-heading text-uppercase">All news in the world</div>
                <a class="btn btn-primary btn-xl text-uppercase js-scroll-trigger" href="#services">Tell Me More</a>
            </div>
            <div class="col-4 list-group">
                <h2 class="mt-2 mb-4">Top news</h2>
                @foreach ($postOrderViews as $item)
                    @foreach ($allPosts as $post)
                        @if ($item->id==$post->id)
                            <a href="{{route('post.detail',$post->id)}}" class="text-left row pt-2 pb-2 border-bottom">
                                <div class="col-3"><img src="{{asset($post->image)}}" alt="" width="100" height="60" class="img-thumbnail"></div>
                                <div class="col-9"><span>{{$post->title}}</span></div>
                            </a>
                        @endif
                    @endforeach
                @endforeach
                
            </div>
        </div>
    </div>
</header>
@endsection
@section('content')
    <div class="text-center">
        <h2 class="section-heading text-uppercase">Tin tức</h2>
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
                        <div class="image-box">
                            <img class="img-fluid img-400" width="100%" height="400" src="{{asset($item->image)}}" alt="" />
                        </div>
                    </a>
                    <div class="portfolio-caption">
                        <a href="{{route('post.detail',$item->id)}}"><div class="portfolio-caption-heading text-dark">{{$item->title}}</div></a>
                        <div class="portfolio-caption-subheading text-muted">Chuyên mục: {{$item->category->name}}</div>
                        <div class="portfolio-caption-subheading text-muted">Date: {{$item->created_at->format('d-m-Y')}}</div>
                    </div>
                </div>
            </div>
        @endforeach
        <div class="col-xs-4 offset-xs-8 pull-right">
            {{$posts->links()}}
        </div>
    </div>
@endsection