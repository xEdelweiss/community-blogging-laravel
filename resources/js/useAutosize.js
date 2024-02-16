import { Alpine } from "../../vendor/livewire/livewire/dist/livewire.esm.js";

export default function useAutosize() {
    Alpine.directive("autosize", async (element, { expression }, { cleanup }) => {
        if (element.tagName !== "TEXTAREA") {
            throw new Error("The autosize directive can only be used on textarea elements.");
        }

        element.classList.add("whitespace-pre-wrap", "h-auto"); // h-auto fixes a bug when scrollHeight is 4px larger than it should be
        element.style.overflow = "hidden";
        element.style.resize = "none";

        const resize = () => {
            console.log("TRIGGERED");

            element.style.height = "auto";
            element.style.height = element.scrollHeight + "px";
        };

        element.addEventListener("input", resize);
        element.addEventListener("change", resize);
        element.addEventListener("scroll", resize);

        resize();

        cleanup(() => {
            element.removeEventListener("input", resize);
            element.removeEventListener("change", resize);
            element.removeEventListener("scroll", resize);
        });
    });
}
