@if (count($breadcrumbs))
    <nav id="breadcrumbs">
        <div class="l-allWrapper">
            <ol class="breadcrumbs__list l-flex l-start l-v__center">
                <!-- <li><a href="/"><img src="{{ asset('/img/icon-home-black.png') }}" alt="ホーム画面のアイコン"></a></li> -->
                @foreach ($breadcrumbs as $breadcrumb)
                @if ($breadcrumb->url && !$loop->last)
                    <li class="breadcrumb-item"><a href="{{ $breadcrumb->url }}">{{ $breadcrumb->title }}</a></li>
                @else
                    <li class="breadcrumb-item active">{{ $breadcrumb->title }}</li>
                @endif
                @endforeach
            </ol>
        </div>
    </nav>
@endif
