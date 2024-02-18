import { Node, nodePasteRule } from "@tiptap/core";
import { isValidUrl, REGEX_RULE } from "../../../../../embeds/drivers/useTwitterEmbed";

type SetOptions = { src: string };

export const Twitter = Node.create<{
    inline: boolean;
}>({
    name: "twitter",
    isolating: true,
    defining: true,
    group: "block",
    draggable: true,
    selectable: true,
    inline: false,

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
            setTwitterPost:
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
                    return { src: match.input };
                },
            }),
        ];
    },

    parseHTML() {
        return [
            {
                tag: `div[data-type="${this.name}"]`,
                getAttrs: (dom) => ({
                    src: dom.getAttribute("x-twitter") ?? "",
                }),
            },
        ];
    },

    renderHTML({ HTMLAttributes, node }) {
        return [
            "div",
            {
                "data-type": this.name,
                "x-twitter": HTMLAttributes.src,
            },
        ];
    },
});
