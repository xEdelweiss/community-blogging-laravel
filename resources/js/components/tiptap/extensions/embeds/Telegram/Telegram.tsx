import { Node, nodePasteRule } from "@tiptap/core";

type SetOptions = { src: string };

export const REGEX_RULE = /^(https?:\/\/)?(t\.me)\/(?<postId>[^/]+\/[0-9]+)$/g;

const isValidUrl = (src: string): bool => {
    // @todo improve this
    return src.includes("://t.me/");
};

/**
 * Telegram prevents multiple posts from being loaded.
 * It looks for the "telegram-post-<id>" attribute in the DOM.
 */
function removeIdAttributes() {
    document.querySelectorAll('[id^="telegram-post-"]').forEach(function (element) {
        element.removeAttribute("id");
    });
}

const telegramPostListener = function (event: MessageEvent) {
    if (event.origin === "https://t.me") {
        const data = JSON.parse(event.data);
        if (data.event === "ready") {
            removeIdAttributes();
        }
    }
};

export const Telegram = Node.create<{
    inline: boolean;
}>({
    name: "telegram",

    addOptions() {
        return {
            HTMLAttributes: {},
            inline: false,
        };
    },

    inline() {
        return this.options.inline;
    },

    group() {
        return this.options.inline ? "inline" : "block";
    },

    draggable: true,

    addAttributes() {
        return {
            src: {
                default: null,
            },
        };
    },

    onBeforeCreate() {
        // Event listener for the "load" event on the widget's iframe
        window.addEventListener("message", telegramPostListener);
    },

    onDestroy() {
        // Remove the event listener for the "load" event on the widget's iframe
        window.removeEventListener("message", telegramPostListener);
    },

    addCommands() {
        return {
            setTelegramPost:
                (options: SetOptions) =>
                ({ commands }) => {
                    if (!isValidUrl(options.src)) {
                        return false;
                    }

                    return commands.insertContent({
                        type: this.name,
                        attrs: options,
                    });
                },
        };
    },

    addPasteRules() {
        return [
            nodePasteRule({
                find: REGEX_RULE,
                type: this.type,
                getAttributes: (match) => {
                    return {
                        src: match.input,
                    };
                },
            }),
        ];
    },

    parseHTML() {
        return [
            {
                tag: `div[data-type="${this.name}"]`,
            },
        ];
    },

    renderHTML({ HTMLAttributes, node }) {
        // regexp should be reset to return the first match
        REGEX_RULE.lastIndex = 0;
        const postId = REGEX_RULE.exec(HTMLAttributes.src)?.groups?.postId;
        REGEX_RULE.lastIndex = 0;
        return [
            "div",
            {
                class: "telegram-container",
                "data-type": this.name,
            },
            [
                "script",
                {
                    type: "text/javascript",
                    async: true,
                    src: "https://telegram.org/js/telegram-widget.js?22",
                    "data-telegram-post": postId,
                    "data-width": "100%",
                },
            ],
        ];
    },
});
