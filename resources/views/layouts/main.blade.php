<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>News - Quoc vuong start news</title>
        @include('layouts.link')
    </head>
    <body id="page-top">
        <!-- Navigation-->
        @include('layouts.nav')
        <!-- Masthead-->
        @yield('header')
        <!-- Services-->
        
        <!-- Portfolio Grid-->
        <section class="page-section bg-light" id="portfolio">
            <div class="container">
                @yield('content')
            </div>
        </section>
        
        <!-- Footer-->
        @include('layouts.footer')
        <!-- Portfolio Modals-->
        <!-- Modal 1-->
        <!-- Bootstrap core JS-->
        @include('layouts.script')
        @yield('page-script')
    </body>
</html>
