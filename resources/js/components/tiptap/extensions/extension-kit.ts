import {
    BlockquoteFigure,
    CharacterCount,
    Color,
    Column,
    Columns,
    Document,
    Dropcursor,
    Figcaption,
    Focus,
    FontFamily,
    FontSize,
    Highlight,
    HorizontalRule,
    ImageBlock,
    Link,
    Placeholder,
    Selection,
    SlashCommand,
    StarterKit,
    Subscript,
    Superscript,
    Table,
    TableCell,
    TableHeader,
    TableRow,
    TaskItem,
    TaskList,
    TextAlign,
    TextStyle,
    TrailingNode,
    Typography,
    Underline,
} from ".";
import { CodeBlockLowlight } from "@tiptap/extension-code-block-lowlight";
import { ImageUpload } from "./ImageUpload";
import { TableOfContentsNode } from "./TableOfContentsNode";
import { lowlight } from "lowlight";

interface ExtensionKitProps {}

export const ExtensionKit = (props: ExtensionKitProps = {}) => [
    Document,
    Columns,
    TaskList,
    TaskItem.configure({
        nested: true,
    }),
    Column,
    Selection,
    HorizontalRule,
    StarterKit.configure({
        document: false,
        dropcursor: false,
        heading: {
            levels: [2, 3],
        },
        horizontalRule: false,
        blockquote: false,
        history: {
            newGroupDelay: 500,
            depth: 100,
        },
        codeBlock: false,
    }),
    CodeBlockLowlight.configure({
        lowlight,
        defaultLanguage: null,
    }),
    TextStyle,
    FontSize,
    FontFamily,
    Color,
    TrailingNode,
    Link.configure({
        openOnClick: false,
    }),
    Highlight.configure({ multicolor: true }),
    Underline,
    CharacterCount.configure({ limit: 50000 }),
    // TableOfContents,
    TableOfContentsNode,
    ImageUpload.configure(),
    ImageBlock,
    // FileHandler.configure({
    //   allowedMimeTypes: ['image/png', 'image/jpeg', 'image/gif', 'image/webp'],
    //   onDrop: (currentEditor, files, pos) => {
    //     files.forEach(async () => {
    //       const url = await API.uploadImage()
    //
    //       currentEditor.chain().setImageBlockAt({ pos, src: url }).focus().run()
    //     })
    //   },
    //   onPaste: (currentEditor, files) => {
    //     files.forEach(async () => {
    //       const url = await API.uploadImage()
    //
    //       return currentEditor
    //         .chain()
    //         .setImageBlockAt({ pos: currentEditor.state.selection.anchor, src: url })
    //         .focus()
    //         .run()
    //     })
    //   },
    // }),
    // Emoji.configure({
    //   enableEmoticons: true,
    //   suggestion: emojiSuggestion,
    // }),
    TextAlign.extend({
        addKeyboardShortcuts() {
            return {};
        },
    }).configure({
        types: ["heading", "paragraph"],
    }),
    Subscript,
    Superscript,
    Table,
    TableCell,
    TableHeader,
    TableRow,
    Typography,
    Placeholder.configure({
        includeChildren: true,
        showOnlyCurrent: false,
        placeholder: () => "",
    }),
    SlashCommand,
    Focus,
    Figcaption,
    BlockquoteFigure,
    Dropcursor.configure({
        width: 2,
        class: "ProseMirror-dropcursor border-black",
    }),
];

export default ExtensionKit;
