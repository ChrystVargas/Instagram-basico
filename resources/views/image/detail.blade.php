@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            @include('includes.message')

            <div class="card">
                <div class="card-header home">
                    @if ($image->user->image)
                        <img src="{{ route('user.avatar', ['filename' => $image->user->image]) }}" class="avatar" alt="{{$image->user->image}} descripcion">
                    @endif
                    {{ $image->user->name. ' '. $image->user->surname}}
                    <span class="nickname">{{ ' | @'. $image->user->nick }}</span>
                </div>

                <div class="card-body">
                    <img src="{{ route('image.file', [$image->image_path]) }}" class="w-100" alt="{{ $image->image_path }}">
                    <div class="description p-3">
                        <span class="nickname">{{ '@'.$image->user->nick }}</span>
                        <span class="nickname">{{ ' | '.\FormatTime::LongTimeFilter($image->created_at) }}</span>
                        <p>{{ $image->description }}</p>
                    </div>
                    <div class="likes">
                        @forelse ($image->likes as $like)
                            @if ($like->user->id == Auth::user()->id)
                                <img src="{{ asset('img/heartRed.svg') }}" class="btn-dislike" data-id="{{ $image->id }}" alt="like-icon">
                                @break
                            @else
                                <img src="{{ asset('img/heartBlack.svg') }}" class="btn-like" data-id="{{ $image->id }}" alt="like-icon">
                                @break
                            @endif
                        @empty
                        <img src="{{ asset('img/heartBlack.svg') }}" class="btn-like" data-id="{{ $image->id }}" alt="like-icon">
                        @endforelse
                        <span class="nickname">{{ count($image->likes) }}</span>
                    </div>

                    @if(Auth::user() && Auth::user()->id == $image->user->id)
                        <div class="actions">
                            <a href="{{ route('image.edit',['id'=>$image->id]) }}" class="btn btn-primary btn-sm">Actualizar</a>
                            <a href="" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#eliminarModal">Borrar</a>

                            {{-- Modal de confirmacion --}}
                            <div class="modal fade" id="eliminarModal" tabindex="-1" aria-labelledby="eliminarModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="eliminarModalLabel">Eliminar imagen</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                    <div class="modal-body">
                                    Si eliminas esta imagen nunca podras recuperarla, ¿estas seguro de querer eliminarla?
                                    </div>
                                    <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                    <a href="{{ route('image.delete',['id'=>$image->id]) }}" class="btn btn-primary">Eliminar definitivamente</a>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="clearfix"></div>
                    <div class="comments p-3">
                        <h2>Comentarios({{ count($image->comments) }})</h2>
                        <hr>
                        <form action="{{ route('comment.save') }}" method="POST">
                            @csrf
                            <input type="hidden" name="image_id" value="{{ $image->id }}">
                            <p>
                                <textarea name="content" class="form-control @error('content') is-invalid @enderror" required></textarea>
                                @error('content')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </p>
                            <button type="submit" class="btn btn-success">Enviar</button>
                        </form>
                        <hr>
                        @foreach ($image->comments as $comment)
                            <div class="comment">
                                <span class="nickname">{{ '@'.$comment->user->nick }}</span>
                                <span class="nickname">{{ ' | '.\FormatTime::LongTimeFilter($comment->created_at) }}</span>
                                <p>{{ $comment->content }} <br>
                                    @if (Auth::check() && ($comment->user_id == Auth::user()->id || $comment->image->user->id == Auth::user()->id))
                                        <a href="{{ route('comment.delete', ['id'=>$comment->id]) }}" class="btn btn-sm btn-danger">Eliminar</a>
                                    @endif
                                </p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
