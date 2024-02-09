import { Node, nodePasteRule } from "@tiptap/core";
import { ReactNodeViewRenderer } from "@tiptap/react";
import { ImageUpload as ImageUploadComponent } from "../ImageUpload/view";
import TwitterEmbed from "./TwitterEmbed";

type SetTelegramOptions = { src: string };
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
                (options: SetTelegramOptions) =>
                ({ commands }) => {
                    // if (!isValidYoutubeUrl(options.src)) {
                    //     return false;
                    // }

                    if (!options.src.includes("://twitter.com/")) {
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
        const TWITTER_REGEX_GLOBAL = /^(https?:\/\/)?(twitter\.com)\/(.+)$/g;

        return [
            nodePasteRule({
                find: TWITTER_REGEX_GLOBAL,
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
        return ReactNodeViewRenderer(TwitterEmbed);
    },
});
