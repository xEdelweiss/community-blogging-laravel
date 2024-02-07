import { Editor } from "@tiptap/core";
import * as icons from "../../lib/icons";

export interface Group {
    name: string;
    title: string;
    commands: Command[];
}

export interface Command {
    name: string;
    label: string;
    description: string;
    aliases?: string[];
    iconName: keyof typeof icons;
    action: (editor: Editor) => void;
    shouldBeHidden?: (editor: Editor) => boolean;
}

export interface MenuListProps {
    editor: Editor;
    items: Group[];
    command: (command: Command) => void;
}
