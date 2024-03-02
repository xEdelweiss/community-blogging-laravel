@if ($comments->where('parent_id', $parentId)->count() > 0)
    <div class="comments-level">
        @foreach ($comments->where('parent_id', $parentId) as $comment)
            <div class="comment-container">
                @include('components.post._comment', [
                    'post' => $post,
                    'comment' => $comment,
                ])

                @include('components.post._comments-level', [
                    'parentId' => $comment->id,
                    'comments' => $post->comments,
                    'level' => $level + 1,
                ])
            </div>
        @endforeach
    </div>
@endif
