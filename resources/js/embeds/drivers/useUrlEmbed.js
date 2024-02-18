import { Alpine } from "../../../../vendor/livewire/livewire/dist/livewire.esm.js";
import { fetchEmbed } from "../../utils/fetchEmbed.js";

export const isValidUrl = (src) => {
    // @todo improve this
    return src.includes("://");
};

export default function useUrlEmbed() {
    Alpine.directive("url", async (element, { expression }, { evaluate, Alpine }) => {
        const src = isValidUrl(expression) ? expression : evaluate(expression);

        if (!isValidUrl(src)) {
            return;
        }

        element.classList.add("url-container");

        try {
            const embed = await fetchEmbed(src);
            element.insertAdjacentHTML("beforeend", embed.html);
        } catch (e) {
            console.error("Error fetching meta", e);
        }
    });

    return {
        name: "url",
        REGEX_RULE: /^(https?:\/\/)?(.+)$/g,
        isValidUrl,
        title: "built-in",
    };
}
