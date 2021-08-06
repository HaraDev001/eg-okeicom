<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include("../common/head")
<body>
  <div id="app">
    @if(Auth::user())
        @if( Auth::user()->status == 0 )
          <header-user-component logout="{{ route('logout') }}" :csrf="{{ json_encode(csrf_token()) }}" user-img="{{ Auth::user()->img }}"></header-user-component>
        @elseif( Auth::user()->status == 1 )
          <header-teacher-component teacher-link="1" logout="{{ route('logout') }}" :csrf="{{ json_encode(csrf_token()) }}" user-img="{{ Auth::user()->img }}"></header-teacher-component>
        @endif
    @else
      <header-component :csrf="{{ json_encode(csrf_token()) }}"></header-component>
    @endif

    <main id="l-main">
      @yield('content')
      @unless(Request::is('/'))
        @include("../common/lead")
      @endunless
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
   
  @include("../common/footer")
</body>
</html>
