import { Node, nodePasteRule } from "@tiptap/core";

type SetTelegramOptions = { src: string };
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

    parseHTML() {
        return [];
    },

    addCommands() {
        return {
            setYoutubeVideo:
                (options: SetTelegramOptions) =>
                ({ commands }) => {
                    // if (!isValidYoutubeUrl(options.src)) {
                    //     return false;
                    // }

                    if (!options.src.includes("://t.me/")) {
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
        // if (!this.options.addPasteHandler) {
        //     return [];
        // }
        const TELEGRAM_REGEX_GLOBAL = /^(https?:\/\/)?(t\.me)\/([^/]+\/[0-9]+)$/g;

        return [
            nodePasteRule({
                find: TELEGRAM_REGEX_GLOBAL,
                type: this.type,
                getAttributes: (match) => {
                    console.log("match", match);
                    return { src: match[3] };
                },
            }),
        ];
    },

    renderHTML({ HTMLAttributes }) {
        return [
            "div",
            [
                "script",
                {
                    type: "text/javascript",
                    async: true,
                    src: "https://telegram.org/js/telegram-widget.js?22",
                    "data-telegram-post": HTMLAttributes.src,
                    "data-width": "100%",
                },
            ],
        ];
    },
});
