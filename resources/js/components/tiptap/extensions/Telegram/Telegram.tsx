import { Node, nodePasteRule } from "@tiptap/core";

type SetOptions = { src: string };

const REGEX_RULE = /^(https?:\/\/)?(t\.me)\/([^/]+\/[0-9]+)$/g;

const isValidUrl = (src: string): bool => {
    // @todo improve this
    return src.includes("://t.me/");
}

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
    /*
    width: 536px;
    margin: 0 auto;
    padding-right: 36px;

    */

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
        return [
            "div",
            {
                class: "telegram-container",
                'data-type': this.name,
            },
            [
                "script",
                {
                    type: "text/javascript",
                    async: true,
                    src: "https://telegram.org/js/telegram-widget.js?22",
                    "data-telegram-post": REGEX_RULE.exec(node.attrs.src)[3],
                    "data-width": "100%",
                },
            ],
        ];
    },
});
