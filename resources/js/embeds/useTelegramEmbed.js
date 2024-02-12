import { Alpine } from "../../../vendor/livewire/livewire/dist/livewire.esm.js";

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
                record.addedNodes.forEach((node) => {
                    if (node.tagName === "IFRAME") {
                        node.removeAttribute("id");
                        observer.disconnect();
                    }
                });
            });
        });

        observer.observe(element, { childList: true });

        REGEX_RULE.lastIndex = 0;
        const postId = REGEX_RULE.exec(src)?.groups?.postId;
        REGEX_RULE.lastIndex = 0;

        element.classList.add("telegram-container");

        const script = document.createElement("script");
        script.type = "text/javascript";
        script.async = true;
        script.src = "https://telegram.org/js/telegram-widget.js?22";
        script.dataset.telegramPost = postId;
        script.dataset.width = "100%";
        element.appendChild(script);
        element.id = `nnn${postId}nnn`;
    });

    return {
        name: "telegram",
        REGEX_RULE,
        isValidUrl,
    };
}
