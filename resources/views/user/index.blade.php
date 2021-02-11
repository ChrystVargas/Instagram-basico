@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1>Gente</h1>
            <form action="GET" action="{{ route('user.index') }}" id="buscador">
                <div class="form-group row">
                    <input type="text" id="search" class="form-control col-8 container-fluid">
                    <input type="submit" value="Buscar" class="btn btn-success col-3">
                </div>
            </form>
            <hr>
            @foreach ($users as $user)
                <div class="profile-user">
                    @if ($user->image)
                        <div class="container-avatar">
                            <img src="{{ route('user.avatar', ['filename' => $user->image]) }}" class="avatar" alt="{{$user->image}} descripcion">
                        </div>
                    @endif

                    <div class="user-info">
                        <h2>{{ '@'.$user->nick }}</h2>
                        <h3>{{ $user->name.' '.$user->surname }}</h3>
                        <p>{{ 'Se unio hace: '.\FormatTime::LongTimeFilter($user->created_at) }}</p>
                        <a href="{{ route('profile',['id'=>$user->id]) }}" class="btn btn-success">Ver perfil</a>
                    </div>
                </div>
                <div class="clearfix"></div>
                <hr>
            @endforeach
            {{-- Paginacion --}}
            <div class="clearfix"></div>
            {{ $users->links() }}
        </div>
    </div>
</div>
@endsection
