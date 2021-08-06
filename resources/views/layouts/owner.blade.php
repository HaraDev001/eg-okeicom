<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include("../common/head")
<link rel="stylesheet" href="{{ asset('css/foundation/single/owner.css') }}">
<body>
	<div id="app" class="l-wrap--owner">
		@include("../common/sidebar-owner")
        @yield('content')
	</div>
    @include("../common/footer-owner")
    <script src="{{ asset('ckeditor/ckeditor.js')}}"></script>
    <script>
        CKEDITOR.replace('ckeditor');
    </script>
</body>
</html>
