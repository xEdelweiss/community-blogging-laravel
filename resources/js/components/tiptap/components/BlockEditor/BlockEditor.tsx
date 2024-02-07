// import { WebSocketStatus } from '@hocuspocus/provider'
import { Editor, EditorContent, PureEditorContent } from "@tiptap/react";
import React, { forwardRef, useEffect, useMemo, useRef, useState } from "react";
import { createPortal } from "react-dom";
import { LinkMenu } from "../menus/LinkMenu/LinkMenu";
import { useBlockEditor } from "../../hooks/useBlockEditor";
import "../../styles/index.css";
import { Loader } from "../ui/Loader/Loader";
import { EditorContext } from "../../context/EditorContext";
import ImageBlockMenu from "../../extensions/ImageBlock/components/ImageBlockMenu";
import { ColumnsMenu } from "../../extensions/MultiColumn/menus/ColumnsMenu";
import { TableColumnMenu, TableRowMenu } from "../../extensions/Table/menus";
import { TiptapProps } from "./types";
import { TextMenu } from "../menus";
import { ContentItemMenu } from "../menus";
import { EditorFooter } from "./components/EditorFooter";

export const BlockEditor = forwardRef<Editor, TiptapProps>(({ value, onChange }, ref) => {
    const menuContainerRef = useRef(null);
    const editorRef = useRef<PureEditorContent | null>(null);
    const [isDebugVisible, setIsDebugVisible] = useState<boolean>(false);

    const { editor, characterCount } = useBlockEditor({
        value,
        onChange,
    });

    ref.current = editor;

    if (!editor) {
        return null;
    }

    return (
        <>
            <div className="h-full" ref={menuContainerRef}>
                <div className="relative flex flex-col flex-1 h-full">
                    <EditorContent editor={editor} ref={editorRef} className="flex-1 overflow-y-auto whitespace-pre-wrap break-words" />
                    <EditorFooter characters={characterCount.characters()} words={characterCount.words()}>
                        <ContentItemMenu editor={editor} onToggleDebug={() => setIsDebugVisible((cur) => !cur)} />
                    </EditorFooter>
                    <LinkMenu editor={editor} appendTo={menuContainerRef} />
                    <TextMenu editor={editor} />
                    <ColumnsMenu editor={editor} appendTo={menuContainerRef} />
                    <TableRowMenu editor={editor} appendTo={menuContainerRef} />
                    <TableColumnMenu editor={editor} appendTo={menuContainerRef} />
                    <ImageBlockMenu editor={editor} appendTo={menuContainerRef} />
                </div>
            </div>

            {isDebugVisible && (
                <div>
                    <pre className={"text-xs"}>{JSON.stringify(editor.getJSON(), null, 2)}</pre>
                </div>
            )}
        </>
    );
});

export default BlockEditor;
