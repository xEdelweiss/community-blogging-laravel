<div x-data="{
    likesCount: {{ $likesCount }},
    isLiked: {{ json_encode($isLiked) }},
    toggle() {
        const isLiked = this.isLiked;
        this.isLiked = !this.isLiked;
        this.isLiked ? this.likesCount++ : this.likesCount--;

        const likeRoute = '{{ route('like', ['id' => $post->id, 'type' => $post->getMorphClass() ]) }}';
        const unlikeRoute = '{{ route('unlike', ['id' => $post->id, 'type' => $post->getMorphClass() ]) }}';

        axios[isLiked ? 'delete' : 'post'](isLiked ? unlikeRoute : likeRoute)
            .then(response => {
                console.log(response.data);
            })
            .catch(error => {
                console.log(error);
            });
    }
}">
    <div :class="isLiked ? '[&>svg]:fill-primary/80 [&>svg]:stroke-primary-dark/80 hover:[&>svg]:fill-primary hover:[&>svg]:stroke-primary-dark text-black' : ''"
         class="flex cursor-pointer select-none items-center gap-x-1 text-sm hover:text-black"
         @click.stop.throttle.500ms="toggle()"
    >
        <x-icons.heart class="h-6 w-6" />
        <span x-text="likesCount">{{ $likesCount }}</span>
    </div>
</div>
