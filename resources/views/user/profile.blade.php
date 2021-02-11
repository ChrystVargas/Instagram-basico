@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="profile-user">
                @if ($user->image)
                    <div class="container-avatar">
                        <img src="{{ route('user.avatar', ['filename' => $user->image]) }}" class="avatar" alt="{{$user->image}} descripcion">
                    </div>
                @endif

                <div class="user-info">
                    <h1>{{ '@'.$user->nick }}</h1>
                    <h2>{{ $user->name.' '.$user->surname }}</h2>
                    <p>{{ 'Se unio hace: '.\FormatTime::LongTimeFilter($user->created_at) }}</p>
                </div>
            </div>
            <div class="clearfix"></div>
            <hr>
            @foreach ($user->images as $image)
                @include('includes.image')
            @endforeach
        </div>
    </div>
</div>
@endsection
