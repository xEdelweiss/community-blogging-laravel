<div class="instagram-container" x-init="(() => {
    if (window['instgrm']) {
        window['instgrm'].Embeds.process();
    } else {
        const script = document.createElement('script');
        script.src = 'https://www.instagram.com/embed.js';
        document.body.appendChild(script);
    }
})()">
    <div class="screen"></div>
    <div class="embed">
        {{-- data-instgrm-captioned="true" to add captions --}}
        <blockquote class="instagram-media"
            data-instgrm-permalink="{{ $meta->url }}"
            data-instgrm-version="14"></blockquote>
    </div>
</div>
