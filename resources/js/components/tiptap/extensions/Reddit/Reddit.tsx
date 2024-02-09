import { Node, nodePasteRule } from "@tiptap/core";
import { ReactNodeViewRenderer } from "@tiptap/react";
import RedditEmbed from "./RedditEmbed";

type SetRedditOptions = { src: string };
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
            setYoutubeVideo:
                (options: SetRedditOptions) =>
                ({ commands }) => {
                    // if (!isValidYoutubeUrl(options.src)) {
                    //     return false;
                    // }

                    if (!options.src.includes("://www.reddit.com/")) {
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
        const REDDIT_REGEX_GLOBAL = /^(https?:\/\/)?(www\.reddit\.com)\/(.+)$/g;

        return [
            nodePasteRule({
                find: REDDIT_REGEX_GLOBAL,
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

    renderHTML({ HTMLAttributes }) {
        return ["div", { "data-type": this.name }];
    },

    addNodeView() {
        return ReactNodeViewRenderer(RedditEmbed);
    },
});
