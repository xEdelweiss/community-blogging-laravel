import { NodeConfig, nodePasteRule } from "@tiptap/core";

type SetOptions = { src: string };

export function makeNamedEmbedExtension(
    name: string,
    commandName: string,
    regexRule: RegExp,
    urlCheck: (url: string) => boolean,
    additionalPasteRules: Pick<Parameters<typeof nodePasteRule>[0], "find" | "getAttributes">[] = [],
): Partial<NodeConfig> {
    return {
        name,
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
                [commandName]:
                    (options: SetOptions) =>
                    ({ commands }) => {
                        if (!urlCheck(options.src)) {
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
                    find: regexRule,
                    type: this.type,
                    getAttributes: (match) => {
                        return { src: match.input };
                    },
                }),
                ...additionalPasteRules.map((rule) =>
                    nodePasteRule({
                        type: this.type,
                        ...rule,
                    }),
                ),
            ];
        },

        parseHTML() {
            return [
                {
                    tag: `div[data-type="${this.name}"]`,
                    getAttrs: (dom) => ({
                        src: (dom as HTMLElement).getAttribute("x-embed") ?? "",
                    }),
                },
            ];
        },

        renderHTML({ HTMLAttributes, node }) {
            return [
                "div",
                {
                    "data-type": this.name,
                    "x-embed": HTMLAttributes.src,
                },
            ];
        },
    };
}
