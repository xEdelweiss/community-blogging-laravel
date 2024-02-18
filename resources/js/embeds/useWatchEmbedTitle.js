import { Alpine } from "../../../vendor/livewire/livewire/dist/livewire.esm.js";
import { fetchEmbed } from "../utils/fetchEmbed.js";

export default function useWatchEmbedTitle() {
    Alpine.directive("watch-embed-title", async (element, { expression }, { evaluate, Alpine }) => {
        element.addEventListener("embed-inserted", (event) => {
            const { embed, src } = event.detail;

            if (embed.title === "request") {
                fetchEmbed(src);
            }
        });
    });
}
