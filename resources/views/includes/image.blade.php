<div class="card">
    <div class="card-header home">
        <a href="{{ route('profile', ['id'=>$image->user->id]) }}">
            @if ($image->user->image)
                <img src="{{ route('user.avatar', ['filename' => $image->user->image]) }}" class="avatar" alt="{{$image->user->image}} descripcion">
            @endif
            <Strong class="user-name">{{ $image->user->name. ' '. $image->user->surname}}</Strong>
            <span class="nickname">{{ ' | @'. $image->user->nick }}</span>
        </a>
    </div>

    <div class="card-body">
        <a href="{{ route('image.detail', ['id'=>$image->id]) }}">
            <img src="{{ route('image.file', [$image->image_path]) }}" class="w-100" alt="{{ $image->image_path }}">
        </a>
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
            <span class="nickname count-like">{{ count($image->likes) }}</span>
        </div>
        <div class="comments">
            <a href="{{ route('image.detail', ['id'=>$image->id]) }}" class="btn btn-warning btn-sm">Comentarios ({{ count($image->comments) }})</a>
        </div>
    </div>
</div>
