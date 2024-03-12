<div class="d-flex align-items-center flex-column">
    <post
        is-auth="{{ isset(Auth::user()->id) }}"
        auth-user-id="{{ isset(Auth::user()->id) ? Auth::user()->id : ""}}"
        :user-id="{{ $post->user->id }}"
        user-name="{{ $post->user->name }}"
        :likes-count="{{ $post->likes_count }}"
        :post-views-count="{{ $post->views_count }}"
        is-liked="{{ $post->isLiked }}"
        is-viewed="{{ $post->isViewed }}"
        :id="{{ $post->id }}"
        avatar-url="{{ $post->user->avatar_url }}"
        created-at="{{ $post->created_at }}"
    >
        <div class="post-body">
            @foreach ($blocks = json_decode($post->content_data)->blocks as $block)
                @if(isset($block->data->text))
                    <p class="m-0">{{ $block->data->text }}</p>
                @else
                    <img class="w-100 rounded-3 mt-3" src="{{ $block->data->file->url }}"
                         alt="post image">
                @endif
            @endforeach
        </div>
    </post>
</div>
