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
    onToggleDebug: (type: "html" | "json") => void;
};

export const RightContentItemMenu = ({ editor, onToggleDebug }: ContentItemMenuProps) => {
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
            className="right-[-2rem] flex items-start"
        >
            <div className="flex items-center gap-0.5 h-full z-20">
                <Popover.Root open={menuOpen} onOpenChange={setMenuOpen}>
                    <Popover.Trigger asChild>
                        <Toolbar.Button className={"min-w-[1rem] px-1"}>
                            <Icon name="GripVertical" className={"w-3 h-3"} />
                        </Toolbar.Button>
                    </Popover.Trigger>
                    <Popover.Content side="bottom" align="start" sideOffset={8}>
                        <Surface className="p-2 flex flex-col min-w-[16rem]">
                            <Popover.Close>
                                <DropdownButton onClick={() => onToggleDebug("json")}>
                                    <Icon name="Eye" />
                                    {__("Toggle JSON debug")}
                                </DropdownButton>
                            </Popover.Close>
                            <Popover.Close>
                                <DropdownButton onClick={() => onToggleDebug("html")}>
                                    <Icon name="Eye" />
                                    {__("Toggle HTML debug")}
                                </DropdownButton>
                            </Popover.Close>
                            <Popover.Close>
                                <DropdownButton onClick={actions.resetTextFormatting}>
                                    <Icon name="RemoveFormatting" />
                                    {__("Clear formatting")}
                                </DropdownButton>
                            </Popover.Close>
                            <Popover.Close>
                                <DropdownButton onClick={actions.copyNodeToClipboard}>
                                    <Icon name="Clipboard" />
                                    {__("Copy to clipboard")}
                                </DropdownButton>
                            </Popover.Close>
                            <Popover.Close>
                                <DropdownButton onClick={actions.duplicateNode}>
                                    <Icon name="Copy" />
                                    {__("Duplicate")}
                                </DropdownButton>
                            </Popover.Close>
                            <Toolbar.Divider horizontal />
                            <Popover.Close>
                                <DropdownButton
                                    onClick={actions.deleteNode}
                                    className="text-red-500 bg-red-500 dark:text-red-500 hover:bg-red-500 dark:hover:text-red-500 dark:hover:bg-red-500 bg-opacity-10 hover:bg-opacity-20 dark:hover:bg-opacity-20"
                                >
                                    <Icon name="Trash2" />
                                    {__("Delete")}
                                </DropdownButton>
                            </Popover.Close>
                        </Surface>
                    </Popover.Content>
                </Popover.Root>
            </div>
        </DragHandle>
    );
};
