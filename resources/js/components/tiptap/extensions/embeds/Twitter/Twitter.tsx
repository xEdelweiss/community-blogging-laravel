import { Node, nodePasteRule } from "@tiptap/core";
import { ReactNodeViewRenderer } from "@tiptap/react";
import TwitterEmbed from "./TwitterEmbed";

type SetOptions = { src: string };

const REGEX_RULE = /^(https?:\/\/)?(twitter\.com)\/(.+)$/g;

const isValidUrl = (src: string): bool => {
    // @todo improve this
    return src.includes("://twitter.com/");
};

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
            },
        ];
    },

    renderHTML() {
        return ["div", { "data-type": this.name }];
    },

    addNodeView() {
        return ReactNodeViewRenderer(TwitterEmbed);
    },
});
