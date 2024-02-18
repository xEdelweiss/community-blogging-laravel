import { Alpine } from "../../../../vendor/livewire/livewire/dist/livewire.esm.js";

export const REGEX_RULE = /^(https?:\/\/)?(www\.reddit\.com)\/(.+)$/g;

export const isValidUrl = (src) => {
    // @todo improve this
    return src.includes("://www.reddit.com/");
};

export default function useRedditEmbed() {
    Alpine.directive("reddit", (element, { expression }, { evaluate }) => {
        const src = expression.match(REGEX_RULE) ? expression : evaluate(expression);

        element.classList.add("reddit-container");
        element.insertAdjacentHTML(
            "beforeend",
            `<div class="screen"></div>
                 <div class="embed">
                    <blockquote class="reddit-embed-bq">
                      <a href="${src}"></a>
                    </blockquote>
                 </div>`,
        );

        const script = document.createElement("script");
        script.src = "https://embed.reddit.com/widgets.js";
        document.body.appendChild(script);
    });

    return {
        name: "reddit",
        REGEX_RULE,
        isValidUrl,
        title: "request",
    };
}
