import { Alpine } from "../../vendor/livewire/livewire/dist/livewire.esm.js";

export const isUrl = (src) => {
    // @todo improve this
    return src.includes("://");
};

async function fetchEmbed(src) {
    const response = await fetch("/api/embed?url=" + encodeURIComponent(src), {
        method: "GET",
        headers: {
            Accept: "application/json",
        },
    });

    if (!response.ok) {
        throw new Error("Network response was not ok: " + response.status + " " + response.statusText);
    }

    return await response.json();
}

export default function useEmbed() {
    const reload = async (element, src) => {
        element.childNodes.forEach((child) => child.remove());

        if (!isUrl(src)) {
            return;
        }

        const embed = await fetchEmbed(src);
        element.insertAdjacentHTML("beforeend", embed.html);
        element.dispatchEvent(new CustomEvent("embed-loaded", { detail: { embed, src } }));
    };

    Alpine.directive("embed", async (element, { expression }, { evaluate, Alpine: { watch } }) => {
        const src = isUrl(expression) ? expression : evaluate(expression);
        element.classList.add("embed-container");

        watch(
            () => (isUrl(expression) ? expression : evaluate(expression)),
            async (newValue) => {
                await reload(element, newValue);
            },
        );

        await reload(element, src);
    });

    Alpine.data("embedIntro", (intro) => ({
        introContent: intro,
        embedDetail: null,
        init() {
            this.$watch('embedDetail', value => {
                if (value?.type === 'youtube') {
                    this.introContent = this.introContent.replace(/(\d+:\d+)/g, `<a href="#" class="text-primary" @click="embedDetail.player.goToCode('$1')">$1</a>`);
                }
            });
        },

        intro: {
            ['x-html']() {
                return this.introContent;
            }
        },

        embed: {
            ['x-on:embed-injected']($event) {
                this.embedDetail = $event.detail;
            }
        }
    }))
}
