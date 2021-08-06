@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2>レッスン参加状況</h2>
            @foreach($lessons as $lesson)
                <p>{{ $lesson->application_cnt }}人</p>
                <p>
                    {{ $lesson->add_week_date }}
                    {{ $lesson->separate_hyphen_time }}
                </p>
                <p>
                    <a class="" href="{{ route('mypage.t.lessons.participation.users', ['lessons_id' => $lesson->id]) }}">
                        {{ $lesson->title }}
                    </a>
                </p>
                <hr>
            @endforeach
        </div>
    </div>
</div>
@endsection
