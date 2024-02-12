import { Alpine } from "../../../vendor/livewire/livewire/dist/livewire.esm.js";

export const REGEX_RULE = /^(https?:\/\/)?(www\.)?(instagram\.com)\/(.+)$/g;

export const isValidUrl = (src) => {
    // @todo improve this
    return src.includes("://www.instagram.com/");
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
            `<blockquote
                    class="instagram-media"
                    data-instgrm-permalink="${src}"
                    data-instgrm-version="14"
                ></blockquote>`,
        );

        setTimeout(() => {
            loadScriptOrCallIt();
        }, 0);
    });

    return {
        name: "instagram",
        REGEX_RULE,
        isValidUrl,
    };
}
