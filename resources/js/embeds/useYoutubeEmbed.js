import { Alpine } from "../../../vendor/livewire/livewire/dist/livewire.esm.js";

export const REGEX_RULE = /^(https?:\/\/)?(www\.)?(youtube\.com)\/(.+)$/g;

export const isValidUrl = (src) => {
    // @todo improve this
    return src.includes("://youtube.com/") || src.includes("://www.youtube.com/") || src.includes("://youtu.be/");
};

export default function useYoutubeEmbed() {
    Alpine.directive("youtube", async (element, { expression }, { evaluate }) => {
        const src = expression.match(REGEX_RULE) ? expression : evaluate(expression);
        const embedSrc = src.replace("watch?v=", "embed/");

        element.classList.add("youtube-container");

        element.insertAdjacentHTML(
            "beforeend",
            `<div class="screen"></div>
                 <div class="embed">
                    <iframe width="100%" height="100%"
                        allowfullscreen="true"
                        autoplay="false"
                        disablekbcontrols="false"
                        enableiframeapi="false"
                        endtime="0"
                        ivloadpolicy="0"
                        loop="false"
                        modestbranding="false"
                        origin=""
                        playlist=""
                        src="${embedSrc}"
                        start="0"
                        class="w-full aspect-video rounded-xl overflow-hidden"
                    ></iframe>
                 </div>`,
        );
    });

    return {
        name: "youtube",
        REGEX_RULE,
        isValidUrl,
    };
}
