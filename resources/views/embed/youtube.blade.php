<div class="youtube-container" x-ref="embed" x-data="{
    init() {
        class Player {
            constructor(iframe) {
                this.iframe = iframe;
            }

            goToCode(timeCode) {
                const time = timeCode.split(':').reverse().reduce((acc, cur, i) => acc + cur * Math.pow(60, i), 0);
                const cmd = { event: 'command', func: 'seekTo', args: [time, true] };
                this.iframe.contentWindow.postMessage(JSON.stringify(cmd), '*');

                this.play();
            }

            play() {
                const cmd = { event: 'command', func: 'playVideo', args: [] };
                this.iframe.contentWindow.postMessage(JSON.stringify(cmd), '*');
            }
        }

        this.$refs.embed.dispatchEvent(new CustomEvent('embed-injected', {
            bubbles: true,
            detail: {
                type: 'youtube',
                player: new Player(this.$refs.embed.querySelector('iframe')),
            }
        }));
    }
}">
    <div class="screen"></div>
    <div class="embed">
        @php
            $html = $meta->code->html;
            // extract src
            preg_match('/src="([^"]+)"/', $html, $matches);
            $src = $matches[1];
            $src .= (str_contains($src, '?') ? '&' : '?') . 'enablejsapi=1';
            $html = str_replace($matches[1], $src, $html);
        @endphp

        {!! $html !!}
    </div>
</div>
