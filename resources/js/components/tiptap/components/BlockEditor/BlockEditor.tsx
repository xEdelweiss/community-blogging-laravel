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
import { LeftContentItemMenu, RightContentItemMenu } from "../menus";
import { EditorFooter } from "./components/EditorFooter";

const Debug = ({ editor, type }: { editor: Editor; type: null | "html" | "json" }) => (
    <>
        {type === "json" && (
            <div>
                <pre className={"text-xs whitespace-pre-wrap"}>{JSON.stringify(editor.getJSON(), null, 2)}</pre>
            </div>
        )}

        {type === "html" && (
            <div
                className={"dark:text-gray-100 prose max-w-none text-gray-900 ProseMirror"}
                dangerouslySetInnerHTML={{ __html: editor.getHTML() }}
            />
        )}
    </>
);

function getStyleWithL10n() {
    return `.ProseMirror {
        &.ProseMirror-focused {
            /* Slashmenu Placeholder */

            > p.has-focus.is-empty::before {
                content: "${__("Type \\\\ to browse options")}" !important;
            }

            > [data-type='columns'] > [data-type='column'] > p.is-empty.has-focus::before {
                content: "${__("Type \\\\ to browse options")}" !important;
            }
        }

        & > .is-editor-empty::before {
            content: "${__("Click here to start writing…")}" !important;
        }

        /* Blockquote Placeholder */

        blockquote .is-empty:not(.is-editor-empty):first-child:last-child::before {
            content: "${__("Enter a quote")}" !important;
        }

        blockquote + figcaption.is-empty:not(.is-editor-empty)::before {
            content: "${__("Author")}" !important;
        }
    }`;
}

export const BlockEditor = forwardRef<Editor, TiptapProps>(({ value, onChange }, ref) => {
    const menuContainerRef = useRef(null);
    const editorRef = useRef<HTMLDivElement | null>(null);
    const [debugType, setDebugType] = useState<null | "html" | "json">(null);

    const { editor, characterCount } = useBlockEditor({
        value,
        onChange,
    });

    ref.current = editor;

    if (!editor) {
        return null;
    }

    const style = getStyleWithL10n();

    return (
        <>
            <style>{style}</style>
            <div className="h-full" ref={menuContainerRef}>
                <div className="relative flex flex-col flex-1 h-full">
                    <EditorContent editor={editor} ref={editorRef} className="flex-1 overflow-y-auto whitespace-pre-wrap break-words" />
                    <LeftContentItemMenu editor={editor} />
                    <RightContentItemMenu
                        editor={editor}
                        onToggleDebug={(newValue) => setDebugType((cur) => (cur === newValue ? null : newValue))}
                    />
                    <EditorFooter characters={characterCount.characters()} words={characterCount.words()} />
                    <LinkMenu editor={editor} appendTo={menuContainerRef} />
                    <TextMenu editor={editor} />
                    <ColumnsMenu editor={editor} appendTo={menuContainerRef} />
                    <TableRowMenu editor={editor} appendTo={menuContainerRef} />
                    <TableColumnMenu editor={editor} appendTo={menuContainerRef} />
                    <ImageBlockMenu editor={editor} appendTo={menuContainerRef} />
                </div>
            </div>

            <Debug editor={editor} type={debugType} />
        </>
    );
});

export default BlockEditor;
