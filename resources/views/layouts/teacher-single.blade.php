<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include("../common/head")
<!-- CSS -->
<body>
    <div id="app" class="login-user @if(request()->is('*messages*')) l-message @endif">
        <header-teacher-component :csrf="{{json_encode(csrf_token())}}" user-img="{{ Auth::user()->img }}"></header-teacher-component>
        <main>
            @yield('content')
        </main>
    </div>

     <!-- Global site tag (gtag.js) - Google Analytics -->
     <script type="application/javascript" async src="https://www.googletagmanager.com/gtag/js?id=G-7YT2K7JN1P"></script>
     <script>
         window.dataLayer = window.dataLayer || [];
         function gtag(){dataLayer.push(arguments);}
         gtag('js', new Date());
         gtag('config', 'G-7YT2K7JN1P', { 'send_page_view': false });
     </script>
     <!-- End Google Analytics -->
     
    @include("../common/footer-teacher")
</body>
</html>
