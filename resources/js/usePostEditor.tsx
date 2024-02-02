import { Alpine } from "../../vendor/livewire/livewire/dist/livewire.esm";
import { Content, Editor } from "@tiptap/react";

export default function usePostEditor() {
    Alpine.directive("post-editor", async (element: HTMLElement, { expression }, { evaluate, cleanup, Alpine: { watch } }) => {
        const { BlockEditor } = await import("./components/tiptap/components/BlockEditor/BlockEditor");
        const React = await import("react");
        const { createRoot } = await import("react-dom/client");

        const editorRef = React.createRef<Editor>();

        watch(
            () => evaluate(expression),
            (newValue: Content) => {
                if (editorRef.current) {
                    editorRef.current.commands.setContent(newValue);
                }
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
