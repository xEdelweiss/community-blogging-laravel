import { Alpine } from "../../vendor/livewire/livewire/dist/livewire.esm";
import React from "react";
import { createRoot } from "react-dom/client";
import { Content, Editor } from "@tiptap/react";
import { BlockEditor } from "./components/tiptap/components/BlockEditor";

export default function usePostEditor() {
    Alpine.directive("post-editor", (element: HTMLElement, { expression }, { evaluate, cleanup, Alpine: { watch } }) => {
        const editorRef = React.createRef<Editor>();

        watch(
            () => evaluate(expression),
            (newValue: Content) => {
                editorRef.current.commands.setContent(newValue);
            },
        );

        const root = createRoot(element);
        root.render(
            <BlockEditor
                ref={editorRef}
                value={evaluate(expression)}
                onChange={(newValue) => {
                    evaluate(`${expression} = ${JSON.stringify(newValue)}`);
                }}
            />,
        );

        cleanup(() => {
            root.unmount();
        });
    });
}
