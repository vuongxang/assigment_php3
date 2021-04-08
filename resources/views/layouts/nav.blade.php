<nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
    <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="#page-top"
            ><img src="{{ asset('assets/img/navbar-logo.svg') }}" alt=""
        /></a>
        <button
            class="navbar-toggler navbar-toggler-right"
            type="button"
            data-toggle="collapse"
            data-target="#navbarResponsive"
            aria-controls="navbarResponsive"
            aria-expanded="false"
            aria-label="Toggle navigation"
        >
            Menu
            <i class="fas fa-bars ml-1"></i>
        </button>

        <form class="input-group mt-4" method="get" action="">
            @csrf
            <div class="form-outline">
                <input
                    id="search-input"
                    name="keyword"
                    type="search"
                    id="form1"
                    class="form-control"
                    value="@php
                        if(isset($keyword)) echo $keyword
                    @endphp"
                />
                <label class="form-label" for="form1">Search</label>
            </div>
            <button
                id="search-button"
                type="submit"
                class="btn btn-primary h-100"
            >
                <i class="fas fa-search"></i>
            </button>
        </form>

        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav text-uppercase ml-auto">
                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="{{route('home')}}">Home</a
                    >
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link js-scroll-trigger dropdown-toggle" href="" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">News</a>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        @foreach ($menu_cates as $item)
                        <a class="dropdown-item" href="{{route('cate.detail',$item->id)}}">{{$item->name}}</a>
                        @endforeach
                        
                        {{-- <a class="dropdown-item" href="#">Thời sự</a>
                        <a class="dropdown-item" href="#">Thế giới</a>
                        <a class="dropdown-item" href="#">Thể thao</a>
                        <a class="dropdown-item" href="#">Giải trí</a>
                        <a class="dropdown-item" href="#">Giáo dục</a>
                        <a class="dropdown-item" href="#">Pháp luật</a> --}}
                      </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="#about">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="{{route('contact')}}">Contact</a>
                </li>
            </ul>
            <div class="">
                @if (Route::has('login'))
                <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block d-flex justify-content-center ml-4">
                    @auth
                        <form action="{{route('logout')}}" method="post">
                            @csrf
                            <button type="submit" class="btn btn-outline-danger">logout</button>
                        </form>
            @else
                            <a href="{{ route('login') }}" class="text-sm text-gray-700 underline login-icon">Log in</a>

                        @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 underline">Register</a>
                        @endif
                    @endauth
                </div>
            @endif
            </div>
        </div>
    </div>
</nav>
