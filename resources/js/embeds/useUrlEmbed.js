import { Alpine } from "../../../vendor/livewire/livewire/dist/livewire.esm.js";

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
            const response = await fetch("/api/fetch-meta?url=" + encodeURIComponent(src), {
                method: "GET",
                headers: {
                    Accept: "application/json",
                },
            });

            if (!response.ok) {
                throw new Error("Network response was not ok: " + response.status + " " + response.statusText);
            }

            const meta = await response.json();

            window.dispatchEvent(new CustomEvent("embed-loaded", { detail: { title: meta.title, element } }));
            element.insertAdjacentHTML("beforeend", meta.html);
        } catch (e) {
            console.error("Error fetching meta", e);
        }
    });

    return {
        name: "url",
        REGEX_RULE: /^(https?:\/\/)?(.+)$/g,
        isValidUrl,
    };
}
