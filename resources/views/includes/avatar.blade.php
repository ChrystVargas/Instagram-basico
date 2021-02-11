@if (Auth::user()->image)
    <img src="{{ route('user.avatar', [Auth::user()->image]) }}" class="avatar" alt="{{Auth::user()->image}} descripcion">
@endif
