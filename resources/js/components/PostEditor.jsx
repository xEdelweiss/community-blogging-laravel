import React from "react";
import { BlockEditor } from "./tiptap/components/BlockEditor/BlockEditor.tsx";

function PostEditor() {
    const [value, setValue] = React.useState("");

    return <BlockEditor />;
}

export default PostEditor;
