import React from "react";
import { Icon } from "../../ui/Icon";
import { Toolbar } from "../../ui/Toolbar";
// import DragHandle from '@tiptap-pro/extension-drag-handle-react'
import { DragHandle } from "../../../extensions/fake-pro";
import { Editor } from "@tiptap/react";

import * as Popover from "@radix-ui/react-popover";
import { Surface } from "../../ui/Surface";
import { DropdownButton } from "../../ui/Dropdown";
import useContentItemActions from "./hooks/useContentItemActions";
import { useData } from "./hooks/useData";
import { useEffect, useState } from "react";

export type ContentItemMenuProps = {
    editor: Editor;
};

export const LeftContentItemMenu = ({ editor }: ContentItemMenuProps) => {
    const [menuOpen, setMenuOpen] = useState(false);
    const data = useData();
    const actions = useContentItemActions(editor, data.currentNode, data.currentNodePos);

    useEffect(() => {
        if (menuOpen) {
            editor.commands.setMeta("lockDragHandle", true);
        } else {
            editor.commands.setMeta("lockDragHandle", false);
        }
    }, [editor, menuOpen]);

    return (
        <DragHandle
            pluginKey="ContentItemMenu"
            editor={editor}
            onNodeChange={data.handleNodeChange}
            tippyOptions={{
                offset: [-2, 16],
                zIndex: 99,
            }}
            className="left-[-2rem] sm:left-[-2.5rem]"
        >
            <div className="flex items-center gap-0.5">
                <Toolbar.Button onClick={actions.handleAdd} className={"sm:bg-white sm:shadow-sm"}>
                    <Icon name="Plus" className={"w-3 h-3"} />
                </Toolbar.Button>
            </div>
        </DragHandle>
    );
};
