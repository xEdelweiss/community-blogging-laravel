import { Extension } from "@tiptap/core";
import { Plugin, PluginKey } from "@tiptap/pm/state";
import { Decoration, DecorationSet } from "@tiptap/pm/view";

export const Selection = Extension.create({
    name: "selection",

    addProseMirrorPlugins() {
        const { editor } = this;

        return [
            new Plugin({
                key: new PluginKey("selection"),
                props: {
                    decorations(state) {
                        const decorations = [];

                        if (!editor.isFocused && !state.selection.empty) {
                            decorations.push(
                                Decoration.inline(state.selection.from, state.selection.to, {
                                    class: "selection",
                                }),
                            );
                        }

                        state.doc.nodesBetween(state.selection.from, state.selection.to, (node, pos) => {
                            decorations.push(
                                Decoration.node(pos, pos + node.nodeSize, {
                                    class: "node-selection",
                                }),
                            );
                        });

                        return DecorationSet.create(state.doc, decorations);
                    },
                },
            }),
        ];
    },
});

export default Selection;
