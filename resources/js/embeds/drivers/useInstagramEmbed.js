import { Alpine } from "../../../../vendor/livewire/livewire/dist/livewire.esm.js";

export const REGEX_RULE = /^(https?:\/\/)?(www\.)?(instagram\.com)\/(.+)$/g;

export const isValidUrl = (src) => {
    // @todo improve this
    return src.includes("://www.instagram.com/") || src.includes("://instagram.com/");
};

const loadScriptOrCallIt = () => {
    if (window["instgrm"]) {
        window["instgrm"].Embeds.process();
    } else {
        const script = document.createElement("script");
        script.src = "https://www.instagram.com/embed.js";
        document.body.appendChild(script);
    }
};

export default function useInstagramEmbed() {
    Alpine.directive("instagram", async (element, { expression }, { evaluate }) => {
        const src = expression.match(REGEX_RULE) ? expression : evaluate(expression);
        element.classList.add("instagram-container");

        // data-instgrm-captioned="true"
        element.insertAdjacentHTML(
            "beforeend",
            `<div class="screen"></div>
                 <div class="embed">
                    <blockquote
                        class="instagram-media"
                        data-instgrm-permalink="${src}"
                        data-instgrm-version="14"
                    ></blockquote>
                 </div>`,
        );

        setTimeout(() => {
            loadScriptOrCallIt();
        }, 0);
    });

    return {
        name: "instagram",
        REGEX_RULE,
        isValidUrl,
        title: "none",
    };
}
