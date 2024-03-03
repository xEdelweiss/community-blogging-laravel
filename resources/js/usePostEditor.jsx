import { Alpine } from "../../vendor/livewire/livewire/dist/livewire.esm";
import { Editor } from "@tiptap/react";

export default function usePostEditor() {
    Alpine.data("postForm", (initialValue = {}) => ({
        editorOpen: false,
        url: initialValue?.url ?? "",
        title: initialValue?.title ?? "",
        maxTitleLength: 150,
        intro: initialValue?.intro ?? "",
        maxIntroLength: 300,
        postContent: initialValue?.postContent ? JSON.parse(initialValue?.postContent) : { type: "doc", content: [] },

        get valid() {
            return true; // @fixme remove
            return this.title.length > 0 && this.intro.length > 0 && (!this.url || this.url.contains("://"));
        },

        submitForm() {
            this.$refs.form.submit();
        },

        openEditor() {
            this.editorOpen = true;
            this.$nextTick(() => this.$refs.editor.dispatchEvent(new Event("editor-open")));
        },

        updateTitle(newTitle) {
            if (this.title.length > 0) {
                return;
            }

            this.title = newTitle.substring(0, this.maxTitleLength);
            this.$nextTick(() => this.$refs.title.dispatchEvent(new Event("input")));
        },

        init() {
            this.$watch("postContent.content", (value) => {
                const valuePreset =
                    value.length > 1 ||
                    (value.length === 1 && value[0].type !== "paragraph") ||
                    (value.length === 1 && value[0].type === "paragraph" && value[0].content?.length > 0);

                if (valuePreset) {
                    this.editorOpen = true;
                }
            });
        },
    }));

    Alpine.directive("post-editor", async (element, { expression }, { evaluate, cleanup, Alpine: { watch } }) => {
        const { BlockEditor } = await import("./components/tiptap/components/BlockEditor/BlockEditor");
        const React = await import("react");
        const { createRoot } = await import("react-dom/client");

        const focusHandler = () => {
            editorRef.current?.view?.focus();
        };
        element.addEventListener("editor-open", focusHandler);

        /** @type {RefObject<Editor>} */
        const editorRef = React.createRef();

        // @fixme this moves cursor to the end of the document
        // watch(
        //     () => evaluate(expression),
        //     (newValue: Content) => {
        //         if (editorRef.current) {
        //             editorRef.current.commands.setContent(newValue);
        //         }
        //     },
        // );

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

            element.removeEventListener("editor-open", focusHandler);
        });
    });
}
