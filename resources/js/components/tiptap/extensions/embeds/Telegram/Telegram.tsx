import { Node, nodePasteRule } from "@tiptap/core";
import { isValidUrl, REGEX_RULE } from "../../../../../embeds/useTelegramEmbed.js";

type SetOptions = { src: string };

export const Telegram = Node.create({
    name: "telegram",
    selectable: true,
    group: "block",
    inline: false,
    draggable: true,

    addOptions() {
        return {
            HTMLAttributes: {},
        };
    },

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
                getAttrs: (dom) => ({
                    src: dom.getAttribute("x-telegram") ?? "",
                }),
            },
        ];
    },

    renderHTML({ HTMLAttributes, node }) {
        return [
            "div",
            {
                "data-type": this.name,
                "x-telegram": HTMLAttributes.src,
            },
        ];
    },
});
