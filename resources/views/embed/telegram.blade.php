@php
    $postId = preg_match('/^(https?:\\/\\/)?(t\\.me)\\/(?P<postId>[^\\/]+\\/[0-9]+)$/', $meta->url, $matches) ? $matches['postId'] : null;
@endphp

<div class="telegram-container" x-data="{
    init() {
        const observer = new MutationObserver((records) => {
            records.forEach((record) => {
                record.addedNodes.forEach((node) => {
                    if (node.tagName === 'IFRAME') {
                        node.removeAttribute('id');
                        observer.disconnect();
                    }
                });
            });
        });

        observer.observe(this.$refs.embed, { childList: true });

        const script = document.createElement('script');
        script.type = 'text/javascript';
        script.async = true;
        script.src = 'https://telegram.org/js/telegram-widget.js?22';
        script.dataset.telegramPost = '{{ $postId }}';
        script.dataset.width = '100%';

        this.$refs.embed.appendChild(script);
    }
}" x-ref="element">
    <div class="screen"></div>
    <div class="embed" x-ref="embed"></div>
</div>
