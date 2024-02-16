import { mergeAttributes, textblockTypeInputRule } from "@tiptap/core";
import type { Level } from "@tiptap/extension-heading";
import TiptapHeading from "@tiptap/extension-heading";
import { slugify } from "../../lib/slugify";
import { Plugin } from "@tiptap/pm/state";

export const Heading = TiptapHeading.extend({
    addAttributes() {
        return {
            ...this.parent?.(),
            id: {
                default: null,
                parseHTML: (element) => {
                    return {
                        id: element.getAttribute("id"),
                    };
                },
                renderHTML: (attributes) => {
                    if (!attributes.id) {
                        return {};
                    }
                    return {
                        id: attributes.id,
                    };
                },
            },
        };
    },
    renderHTML({ node, HTMLAttributes }) {
        const nodeLevel = parseInt(node.attrs.level, 10) as Level;
        const hasLevel = this.options.levels.includes(nodeLevel);
        const level = hasLevel ? nodeLevel : this.options.levels[0];

        return [`h${level}`, mergeAttributes(this.options.HTMLAttributes, HTMLAttributes), 0];
    },
    addInputRules() {
        return this.options.levels.map((level) => {
            return textblockTypeInputRule({
                find: new RegExp(`^(#{${level}})\\s$`),
                type: this.type,
                getAttributes: {
                    level,
                },
            });
        });
    },
    addProseMirrorPlugins() {
        return [
            new Plugin({
                appendTransaction: (_transactions, oldState, newState) => {
                    if (newState.doc === oldState.doc) {
                        return;
                    }

                    const tr = newState.tr;

                    newState.doc.descendants((node, pos, parent) => {
                        if (node.type.name === this.name) {
                            tr.setNodeAttribute(pos, "id", slugify(node.textContent ?? null));
                        }

                        return false;
                    });

                    return tr;
                },
            }),
        ];
    },
});

export default Heading;
