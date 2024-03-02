import { Alpine } from "../../vendor/livewire/livewire/dist/livewire.esm.js";

export default function useHiddenFailedImage() {
    Alpine.directive("hide-if-failed", (el) => {
        el.addEventListener("error", () => {
            el.style.display = "none";
        });
    });
}
