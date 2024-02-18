import { Content, Editor, useEditor } from "@tiptap/react";
import { ExtensionKit } from "../extensions/extension-kit";

declare global {
    interface Window {
        editor: Editor | null;
    }
}

export const useBlockEditor = ({ value, onChange }: { value: Content; onChange: (value: object) => void }) => {
    const editor = useEditor(
        {
            autofocus: true,
            onCreate: ({ editor }) => {
                if (editor.isEmpty) {
                    editor.commands.setContent(value);
                    onChange(editor.getJSON());
                }
            },
            onUpdate: ({ editor }) => onChange(editor.getJSON()),
            extensions: [...ExtensionKit()],
            editorProps: {
                attributes: {
                    autocomplete: "off",
                    autocorrect: "off",
                    autocapitalize: "off",
                    class: "min-h-full prose max-w-none",
                },
            },
        },
        [],
    );

    const characterCount = editor?.storage.characterCount || {
        characters: () => 0,
        words: () => 0,
    };

    window.editor = editor;

    return { editor, characterCount };
};
