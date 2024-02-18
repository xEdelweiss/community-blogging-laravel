import { Node, nodePasteRule } from "@tiptap/core";
import { isValidUrl, REGEX_RULE } from "../../../../../embeds/drivers/useInstagramEmbed";

type SetOptions = { src: string };

export const Instagram = Node.create<{
    inline: boolean;
}>({
    name: "instagram",
    isolating: true,
    defining: true,
    group: "block",
    draggable: true,
    selectable: true,
    inline: false,

    addOptions() {
        return {
            HTMLAttributes: {},
            inline: false,
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
            setInstagramPost:
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
                    src: dom.getAttribute("x-instagram") ?? "",
                }),
            },
        ];
    },

    renderHTML({ HTMLAttributes, node }) {
        return [
            "div",
            {
                "data-type": this.name,
                "x-instagram": HTMLAttributes.src,
            },
        ];
    },
});
