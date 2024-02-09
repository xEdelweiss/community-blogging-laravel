import { Node, nodePasteRule } from "@tiptap/core";
import { ReactNodeViewRenderer } from "@tiptap/react";
import RedditEmbed from "./RedditEmbed";

type SetOptions = { src: string };

const REGEX_RULE = /^(https?:\/\/)?(www\.reddit\.com)\/(.+)$/g;

const isValidUrl = (src: string): bool => {
    // @todo improve this
    return src.includes("://www.reddit.com/")
}

export const Reddit = Node.create<{
    inline: boolean;
}>({
    name: "reddit",
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
            setRedditPost:
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
        return ReactNodeViewRenderer(RedditEmbed);
    },
});
