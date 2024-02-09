import { Node, nodePasteRule } from "@tiptap/core";
import { ReactNodeViewRenderer } from "@tiptap/react";
import { ImageUpload as ImageUploadComponent } from "../ImageUpload/view";
import InstagramEmbed from "./InstagramEmbed";

type SetTelegramOptions = { src: string };
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
            setYoutubeVideo:
                (options: SetTelegramOptions) =>
                ({ commands }) => {
                    // if (!isValidYoutubeUrl(options.src)) {
                    //     return false;
                    // }

                    if (!options.src.includes("://www.instagram.com/")) {
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
        const INSTAGRAM_REGEX_GLOBAL = /^(https?:\/\/)?(www\.instagram\.com)\/(.+)$/g;

        return [
            nodePasteRule({
                find: INSTAGRAM_REGEX_GLOBAL,
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
        return ReactNodeViewRenderer(InstagramEmbed);
    },
});
