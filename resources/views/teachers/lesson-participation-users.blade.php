@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2>レッスン参加ユーザ一覧</h2>
            @foreach($users as $user)
                <p>
                    {{ $user->name }}
                    {{ $user->img }}
                </p>
                <p>
                    {{ $user->account }}
                    {{ $user->sex_name }}
                    {{ $user->age }}歳
                    {{ $user->prefectures_name }}
                </p>
                <p>
                    {{ $user->profile }}
                </p>
            @endforeach
        </div>
    </div>
</div>
@endsection
