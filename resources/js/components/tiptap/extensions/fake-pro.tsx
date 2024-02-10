import React, { forwardRef, useEffect } from "react";
import { Editor } from "@tiptap/react";
import { Node } from "@tiptap/pm/model";

export interface EmojiItem {
    emoji: string;
    name: string;
    fallbackImage?: string;
}

export type ImageOptions = string;
export type Language = string;

export enum WebSocketStatus {
    "Disconnected" = "disconnected",
}

export type HocuspocusProvider = null;
export type TiptapCollabProvider = null;

export const DragHandle = forwardRef<
    HTMLDivElement,
    {
        pluginKey: string;
        editor: Editor;
        onNodeChange: (data: { node: Node | null; editor: Editor; pos: number }) => void;
        tippyOptions: {
            offset: [number, number];
            zIndex: number;
        };
        children: React.ReactNode;
        className: string;
    }
>(({ pluginKey, editor, onNodeChange, tippyOptions, children, className }: any, ref) => {
    const [position, setPosition] = React.useState({ x: 0, y: 0 });

    useEffect(() => {
        const handleNodeChange = () => {
            const node = editor.state.doc.nodeAt(editor.state.selection.$anchor.pos);
            const pos = editor.state.selection.anchor;

            const cursorCoords = editor.view.coordsAtPos(editor.state.selection.$anchor.pos);
            const { top, left } = cursorCoords;

            // @fixme: this is a hack to fix the position of the drag handle
            setPosition({
                // x: menuPos === "left" ? -24 - 22 : editor.view.dom.getBoundingClientRect().width - 10 + 22,
                y: top + editor.view.dom.scrollTop - editor.view.dom.getBoundingClientRect().top - 10,
            });

            onNodeChange({ node, editor, pos });
        };

        editor.on("selectionUpdate", handleNodeChange);
        handleNodeChange();

        return () => {
            editor.off("selectionUpdate", handleNodeChange);
        };
    }, [editor, onNodeChange]);

    return (
        <div
            ref={ref}
            className={className}
            style={{
                position: "absolute",
                top: `${position.y}px`,
            }}
        >
            {children}{" "}
        </div>
    );
});
