@extends('layouts.main')
@section('header')
<header class="masthead">
    <div class="container">
        <div class="masthead-subheading">Welcome To Our Studio!</div>
        <div class="masthead-heading text-uppercase">It's Nice To Meet You</div>
        <a class="btn btn-primary btn-xl text-uppercase js-scroll-trigger" href="#services">Tell Me More</a>
    </div>
</header>
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-8 offset-2">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase">Liên hệ</h2>
                    <h3 class="section-subheading text-muted">Gửi liên hệ cho chúng tôi</h3>
                </div>
                <form action="" method="post">
                    @csrf
                    <div class="form-group">
                      <label for="">Tên liên hệ</label>
                      <input type="text" name="name" id="" class="form-control" placeholder="" >
                    </div>
                    <div class="form-group">
                        <label for="">Email liên hệ</label>
                        <input type="email" name="email" id="" class="form-control" placeholder="" >
                      </div>
                      <div class="form-group">
                        <label for="">Số điện thoại</label>
                        <input type="text" name="phone" id="" class="form-control" placeholder="" >
                      </div>
                      <div class="form-group">
                        <label for="">Nội dung liên hệ</label>
                        <textarea name="content" id="tinymce" cols="30" rows="10"></textarea>
                      </div>
                      <div>
                          @isset($message)
                          <div class="alert alert-light" role="alert">
                                {{$message}}
                          </div>
                          @endisset
                      </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-outline-info">Gửi mail</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection