import { Alpine } from "../../../vendor/livewire/livewire/dist/livewire.esm.js";
import { jsonp } from "../utils/jsonp.ts";

export const REGEX_RULE = /^(https?:\/\/)?(twitter\.com)\/(.+)$/g;

export const isValidUrl = (src) => {
    // @todo improve this
    return src.includes("://twitter.com/");
};

const loadTwitterWidgetOrCallIt = () => {
    if (window["twttr"]) {
        window["twttr"].widgets.load();
    } else {
        const script = document.createElement("script");
        script.src = "https://platform.twitter.com/widgets.js";
        document.body.appendChild(script);
    }
};

export default function useTwitterEmbed() {
    Alpine.directive("twitter", async (element, { expression }, { evaluate }) => {
        const src = expression.match(REGEX_RULE) ? expression : evaluate(expression);
        element.classList.add("twitter-container");

        jsonp("https://publish.twitter.com/oembed?url=" + encodeURIComponent(src)).then((res) => {
            element.insertAdjacentHTML("beforeend", res.html);

            setTimeout(() => {
                // blockquote.twitter-tweet -> div.twitter-tweet.twitter-tweet-rendered
                loadTwitterWidgetOrCallIt();
            }, 0);
        });
    });

    return {
        name: "twitter",
        REGEX_RULE,
        isValidUrl,
    };
}
