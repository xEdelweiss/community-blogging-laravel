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
    const [position, setPosition] = React.useState({
        y: 0,
        height: 28, // @fixme hardcoded paragraph height
    });

    useEffect(() => {
        const handleNodeChange = () => {
            const node = editor.state.doc.nodeAt(editor.state.selection.$anchor.pos);
            const pos = editor.state.selection.anchor;

            const domNode = editor.view.domAtPos(editor.state.selection.$anchor.pos).node;
            const domNodeHeight = domNode.getBoundingClientRect().height;

            setPosition({
                y: domNode.offsetTop,
                height: domNodeHeight,
            });

            onNodeChange({ node, editor, pos }); // @todo check if it works
        };

        editor.on("selectionUpdate", handleNodeChange);
        editor.on("focus", handleNodeChange);
        editor.on("update", handleNodeChange);

        return () => {
            editor.off("selectionUpdate", handleNodeChange);
            editor.off("focus", handleNodeChange);
            editor.off("update", handleNodeChange);
        };
    }, [editor, onNodeChange, ref]);

    return (
        <div
            ref={ref}
            className={className}
            style={{
                position: "absolute",
                top: `${position.y}px`,
                height: `${position.height}px`,
            }}
        >
            {children}{" "}
        </div>
    );
});
