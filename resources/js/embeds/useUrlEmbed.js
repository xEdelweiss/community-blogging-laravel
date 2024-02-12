import { Alpine } from "../../../vendor/livewire/livewire/dist/livewire.esm.js";

export const isValidUrl = (src) => {
    // @todo improve this
    return src.includes("://");
};

export default function useUrlEmbed() {
    Alpine.directive("url", async (element, { expression }, { evaluate }) => {
        const src = isValidUrl(expression) ? expression : evaluate(expression);

        if (!isValidUrl(src)) {
            return;
        }

        element.classList.add("url-container");

        const meta = await fetch("/api/fetch-meta?url=" + encodeURIComponent(src)).then((res) => res.json());

        const imgElement = meta.image_url ? `<img class="h-24 rounded" src="${meta.image_url}" title="${meta.title}">` : "";

        element.insertAdjacentHTML(
            "beforeend",
            `
            <figure class="flex justify-start gap-4 rounded-xl border p-4">
                ${imgElement}

                <div class="gap-2 text-left flex-1 flex flex-col">
                    <figcaption>
                        <p class="text-sm font-semibold">${meta.title}</p>
                    </figcaption>

                    <p class="line-clamp-2 text-sm flex-1 ">${meta.description}</p>

                    <div class="flex justify-end gap-1 opacity-75">
                        <img class="h-5 w-5 rounded" src="${meta.icon_url}" alt="${meta.provider}" title="${meta.provider}">
                        <span class="text-sm">${meta.provider}</span>
                    </div>
                </div>
            </figure>
        `,
        );
    });

    return {
        name: "url",
        REGEX_RULE: /^(https?:\/\/)?(.+)$/g,
        isValidUrl,
    };
}
