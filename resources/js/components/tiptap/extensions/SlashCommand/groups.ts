import { Group } from "./types";

export const GROUPS: Group[] = [
    {
        name: "format",
        title: __("Format"),
        commands: [
            {
                name: "heading2",
                label: __("Heading 2"),
                iconName: "Heading2",
                description: __("Medium priority section title"),
                aliases: ["h2"],
                action: (editor) => {
                    editor.chain().focus().setHeading({ level: 2 }).run();
                },
            },
            {
                name: "heading3",
                label: __("Heading 3"),
                iconName: "Heading3",
                description: __("Low priority section title"),
                aliases: ["h3"],
                action: (editor) => {
                    editor.chain().focus().setHeading({ level: 3 }).run();
                },
            },
            {
                name: "bulletList",
                label: __("Bullet list"),
                iconName: "List",
                description: __("Unordered list of items"),
                aliases: ["ul"],
                action: (editor) => {
                    editor.chain().focus().toggleBulletList().run();
                },
            },
            {
                name: "numberedList",
                label: __("Numbered list"),
                iconName: "ListOrdered",
                description: __("Ordered list of items"),
                aliases: ["ol"],
                action: (editor) => {
                    editor.chain().focus().toggleOrderedList().run();
                },
            },
            {
                name: "blockquote",
                label: __("Blockquote"),
                iconName: "Quote",
                description: __("Element for quoting"),
                action: (editor) => {
                    editor.chain().focus().setBlockquote().run();
                },
            },
            {
                name: "codeBlock",
                label: __("Code Block"),
                iconName: "SquareCode",
                description: __("Code block with syntax highlighting"),
                shouldBeHidden: (editor) => editor.isActive("columns"),
                action: (editor) => {
                    editor.chain().focus().setCodeBlock().run();
                },
            },
        ],
    },
    {
        name: "insert",
        title: __("Insert"),
        commands: [
            {
                name: "image",
                label: __("Image"),
                iconName: "Image",
                description: __("Insert an image"),
                aliases: ["img"],
                action: (editor) => {
                    editor.chain().focus().setImageUpload().run();
                },
            },
            // {
            //     name: "toc",
            //     label: __("Table of Contents"),
            //     iconName: "Book",
            //     aliases: ["outline"],
            //     description: __("Insert a table of contents"),
            //     shouldBeHidden: (editor) => editor.isActive("columns"),
            //     action: (editor) => {
            //         editor.chain().focus().insertTableOfContents().run();
            //     },
            // },
        ],
    },
];

export default GROUPS;
