// import { WebSocketStatus } from '@hocuspocus/provider'
import { EditorContent, PureEditorContent } from "@tiptap/react";
import React, { useMemo, useRef, useState } from "react";

import { LinkMenu } from "../menus/LinkMenu/LinkMenu";

import { useBlockEditor } from "../../hooks/useBlockEditor";

import "../../styles/index.css";

import { Sidebar } from "../Sidebar";
import { Loader } from "../ui/Loader/Loader";
import { EditorContext } from "../../context/EditorContext";
import ImageBlockMenu from "../../extensions/ImageBlock/components/ImageBlockMenu";
import { ColumnsMenu } from "../../extensions/MultiColumn/menus/ColumnsMenu";
import { TableColumnMenu, TableRowMenu } from "../../extensions/Table/menus";
import { useAIState } from "../../hooks/useAIState";
import { createPortal } from "react-dom";
import { TiptapProps } from "./types";
import { EditorHeader } from "./components/EditorHeader";
import { TextMenu } from "../menus/TextMenu";
import { ContentItemMenu } from "../menus/ContentItemMenu";
import { EditorFooter } from "./components/EditorFooter";

export const BlockEditor = ({ aiToken, ydoc, provider }: TiptapProps) => {
    const aiState = useAIState();
    const menuContainerRef = useRef(null);
    const editorRef = useRef<PureEditorContent | null>(null);
    const [isDebugVisible, setIsDebugVisible] = useState(false);

    const { editor, users, characterCount, collabState, leftSidebar } =
        useBlockEditor({ aiToken, ydoc, provider });

    const displayedUsers = users.slice(0, 3);

    const providerValue = useMemo(() => {
        return {
            isAiLoading: aiState.isAiLoading,
            aiError: aiState.aiError,
            setIsAiLoading: aiState.setIsAiLoading,
            setAiError: aiState.setAiError,
        };
    }, [aiState]);

    if (!editor) {
        return null;
    }

    const aiLoaderPortal = createPortal(
        <Loader label="AI is now doing its job." />,
        document.body,
    );

    return (
        <EditorContext.Provider value={providerValue}>
            <div className="flex h-full" ref={menuContainerRef}>
                <div className="relative flex flex-col flex-1 h-full overflow-hidden">
                    <EditorContent
                        editor={editor}
                        ref={editorRef}
                        className="flex-1 overflow-y-auto"
                    />
                    <EditorFooter
                        characters={characterCount.characters()}
                        words={characterCount.words()}
                    >
                        <ContentItemMenu
                            editor={editor}
                            onToggleDebug={() =>
                                setIsDebugVisible((cur) => !cur)
                            }
                        />
                    </EditorFooter>
                    <LinkMenu editor={editor} appendTo={menuContainerRef} />
                    <TextMenu editor={editor} />
                    <ColumnsMenu editor={editor} appendTo={menuContainerRef} />
                    <TableRowMenu editor={editor} appendTo={menuContainerRef} />
                    <TableColumnMenu
                        editor={editor}
                        appendTo={menuContainerRef}
                    />
                    <ImageBlockMenu
                        editor={editor}
                        appendTo={menuContainerRef}
                    />
                </div>
            </div>
            {aiState.isAiLoading && aiLoaderPortal}

            {isDebugVisible && (
                <div>
                    <pre className={"text-xs"}>
                        {JSON.stringify(editor.getJSON(), null, 2)}
                    </pre>
                </div>
            )}
        </EditorContext.Provider>
    );
};

export default BlockEditor;
