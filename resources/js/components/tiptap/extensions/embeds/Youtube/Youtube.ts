import { Node, nodePasteRule } from "@tiptap/core";
import { isValidUrl, REGEX_RULE } from "../../../../../embeds/useYoutubeEmbed.js";

type SetOptions = { src: string };

const REGEX_IFRAME = /<iframe.+src="((?:https:\/\/)?(?:www\.)?youtube\.com\/embed\/(?:[^"]+))"(?:.*?)><\/iframe>/g;

export const Youtube = Node.create<{
    inline: boolean;
}>({
    name: "youtube",

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
            setYoutubeVideo:
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
            nodePasteRule({
                find: REGEX_IFRAME,
                type: this.type,
                getAttributes: (match) => {
                    return {
                        src: match[1],
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
                    src: dom.getAttribute("x-youtube") ?? "",
                }),
            },
        ];
    },

    renderHTML({ HTMLAttributes, node }) {
        return [
            "div",
            {
                "data-type": this.name,
                "x-youtube": HTMLAttributes.src,
            },
        ];
    },
});
