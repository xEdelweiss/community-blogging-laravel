import { Node } from "@tiptap/pm/model";
import { NodeSelection } from "@tiptap/pm/state";
import { Editor } from "@tiptap/react";
import { useCallback } from "react";
import { TRIGGER } from "../../../../extensions/SlashCommand";

const useContentItemActions = (editor: Editor, currentNode: Node | null, currentNodePos: number) => {
    const resetTextFormatting = useCallback(() => {
        const chain = editor.chain();

        chain.setNodeSelection(currentNodePos).unsetAllMarks();

        if (currentNode?.type.name !== "paragraph") {
            chain.setParagraph();
        }

        chain.run();
    }, [editor, currentNodePos, currentNode?.type.name]);

    const duplicateNode = useCallback(() => {
        editor.commands.setNodeSelection(currentNodePos);

        const { $anchor } = editor.state.selection;
        const selectedNode = $anchor.node(1) || (editor.state.selection as NodeSelection).node;

        editor
            .chain()
            .setMeta("hideDragHandle", true)
            .insertContentAt(currentNodePos + (currentNode?.nodeSize || 0), selectedNode.toJSON())
            .run();
    }, [editor, currentNodePos, currentNode?.nodeSize]);

    const copyNodeToClipboard = useCallback(() => {
        editor.chain().setMeta("hideDragHandle", true).setNodeSelection(currentNodePos).run();

        document.execCommand("copy");
    }, [editor, currentNodePos]);

    const deleteNode = useCallback(() => {
        editor.chain().setMeta("hideDragHandle", true).setNodeSelection(currentNodePos).deleteSelection().run();
    }, [editor, currentNodePos]);

    const handleAdd = useCallback(() => {
        const activeNode = editor.state.selection.$anchor.parent;
        const activeNodePos = editor.state.selection.$anchor.pos;

        const isEmptyParagraph = activeNode?.type.name === "paragraph" && activeNode?.content.size === 0;

        const outsidePos = editor.state.selection.$anchor.end(1);
        const focusPos = isEmptyParagraph ? activeNodePos + 1 : outsidePos + 3;

        editor
            .chain()
            .command(({ dispatch, tr, state }) => {
                if (dispatch) {
                    if (isEmptyParagraph) {
                        tr.insertText(TRIGGER, activeNodePos, activeNodePos + 1);
                    } else {
                        tr.insert(outsidePos, state.schema.nodes.paragraph.create(null, [state.schema.text(TRIGGER)]));
                    }

                    return dispatch(tr);
                }

                return true;
            })
            .focus(focusPos)
            .run();
    }, [currentNode, currentNodePos, editor]);

    return {
        resetTextFormatting,
        duplicateNode,
        copyNodeToClipboard,
        deleteNode,
        handleAdd,
    };
};

export default useContentItemActions;
