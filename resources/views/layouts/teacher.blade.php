<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include("../common/head")
<body>
    <div id="app" class="login-user">
        <header-teacher-component :csrf="{{json_encode(csrf_token())}}" user-img="{{ Auth::user()->img }}"></header-teacher-component>
        <main>
            <div class="l-wrap--body">
                <div class="l-wrap l-flex">
                    @unless(Request::is('mypage/t'))
                        @include("../common/sidebar-teacher")
                    @endunless
                    <div class="l-wrap--main">
                        <div class="l-wrap--title">
                            <p class="u-color--grayNavy u-text--small">講師管理画面</p>
                            <h1 class="c-headline--screen">@yield('title')</h1>
                        </div>
						<div class="l-wrap--main--inner">
                            @yield('content')
                        </div>
                    </div>
                </div>
            </div>
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
