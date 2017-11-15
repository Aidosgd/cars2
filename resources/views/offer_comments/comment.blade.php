    @forelse($offer_comments as $child)
        @if($child->children->count())
            <div class="child_comment one-comment">
                <div class="comment">
                    <hr>
                    <div class="author">
                        <b>{{ $child->name }}</b>
                    </div>
                    <div class="text">
                        {{ $child->text }}
                    </div>
                    <div class="date">{{ $child->created_at }}</div>
                    <a href="#" data-comment-id="{{ $child->id }}" class="btn btn-info btn-xs reply-с">ответить</a>
                    {{-- recursively include this view, passing in the new collection of comments to iterate --}}
                    @include('offer_comments.comment', ['offer_comments' => $child->children])
                </div>
            </div>
        @else
            <div class="child_comment one-comment">
                <hr>
                <div class="author">
                    <b>{{ $child->name }}</b>
                </div>
                <div class="text">
                    {{ $child->text }}
                </div>
                <div class="date">{{ $child->created_at }}</div>
                <a href="#" data-comment-id="{{ $child->id }}" class="btn btn-info btn-xs reply-с">ответить</a>
            </div>
        @endif
    @empty
        нету комментарий
    @endforelse