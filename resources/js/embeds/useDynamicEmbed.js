import { Alpine } from "../../../vendor/livewire/livewire/dist/livewire.esm.js";

export const isUrl = (src) => {
    // @todo improve this
    return src.includes("://");
};

export default function useDynamicEmbed(registeredEmbeds) {
    const replaceEmbed = (element, embed, src) => {
        element.childNodes.forEach((child) => child.remove());

        if (!embed || !embed.isValidUrl(src)) {
            return;
        }

        element.insertAdjacentHTML("beforeend", `<div x-${embed.name}="${src}"></div>`);

        element.dispatchEvent(new CustomEvent("embed-inserted", { detail: { embed, src } }));
    };

    Alpine.directive("dynamic-embed", (element, { expression }, { evaluate, Alpine: { watch } }) => {
        const src = isUrl(expression) ? expression : evaluate(expression);
        element.classList.add("embed-container");

        watch(
            () => (isUrl(expression) ? expression : evaluate(expression)),
            (newValue) => {
                replaceEmbed(
                    element,
                    registeredEmbeds.find((embed) => embed.isValidUrl(newValue)),
                    newValue,
                );
            },
        );

        if (!src) {
            return;
        }

        const embed = registeredEmbeds.find((embed) => embed.isValidUrl(src));

        if (!embed) {
            return;
        }

        replaceEmbed(element, embed, src);
    });
}
