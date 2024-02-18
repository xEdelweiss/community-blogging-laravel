<div class="twitter-container" x-init="(() => {
    if (window['twttr']) {
        window['twttr'].widgets.load();
    } else {
        const script = document.createElement('script');
        script.src = 'https://platform.twitter.com/widgets.js';
        document.body.appendChild(script);
    }
})()">
    <div class="screen"></div>
    <div class="embed">{!! $meta->code->html !!}</div>
</div>
