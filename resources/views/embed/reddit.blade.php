<div class="reddit-container" x-init="(() => {
    const script = document.createElement('script');
    script.src = 'https://embed.reddit.com/widgets.js';
    document.body.appendChild(script);
})()">
    <div class="screen"></div>
    <div class="embed">
        <blockquote class="reddit-embed-bq">
            <a href="{{ $meta->url }}"></a>
        </blockquote>
    </div>
</div>
