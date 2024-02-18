import { Alpine } from "../../../../vendor/livewire/livewire/dist/livewire.esm.js";

export const REGEX_RULE = /^(https?:\/\/)?(t\.me)\/(?<postId>[^/]+\/[0-9]+)$/g;

export const isValidUrl = (src) => {
    // @todo improve this
    return src.includes("://t.me/");
};

export default function useTelegramEmbed() {
    Alpine.directive("telegram", (element, { expression }, { evaluate, cleanup }) => {
        const src = expression.match(REGEX_RULE) ? expression : evaluate(expression);

        const observer = new MutationObserver((records) => {
            records.forEach((record) => {
                console.log("RECORD", record);

                record.addedNodes.forEach((node) => {
                    console.log("NODE UPDATED", node);

                    if (node.tagName === "IFRAME") {
                        node.removeAttribute("id");
                        observer.disconnect();
                    }
                });
            });
        });

        element.classList.add("telegram-container");

        element.insertAdjacentHTML("beforeend", `<div class="screen"></div><div class="embed"></div>`);

        observer.observe(element.querySelector(".embed"), { childList: true });

        REGEX_RULE.lastIndex = 0;
        const postId = REGEX_RULE.exec(src)?.groups?.postId;
        REGEX_RULE.lastIndex = 0;

        const script = document.createElement("script");
        script.type = "text/javascript";
        script.async = true;
        script.src = "https://telegram.org/js/telegram-widget.js?22";
        script.dataset.telegramPost = postId;
        script.dataset.width = "100%";

        element.querySelector(".embed").appendChild(script);
    });

    return {
        name: "telegram",
        REGEX_RULE,
        isValidUrl,
        title: "none",
    };
}
