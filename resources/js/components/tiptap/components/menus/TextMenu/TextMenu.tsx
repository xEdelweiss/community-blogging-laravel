import React from "react";
import { Icon } from "../../ui/Icon";
import { Toolbar } from "../../ui/Toolbar";
import { useTextmenuCommands } from "./hooks/useTextmenuCommands";
import { useTextmenuStates } from "./hooks/useTextmenuStates";
import { BubbleMenu, Editor } from "@tiptap/react";
import { memo } from "react";
import * as Popover from "@radix-ui/react-popover";
import { Surface } from "../../ui/Surface";
import { ColorPicker } from "../../panels";
import { FontFamilyPicker } from "./components/FontFamilyPicker";
import { FontSizePicker } from "./components/FontSizePicker";
import { useTextmenuContentTypes } from "./hooks/useTextmenuContentTypes";
import { ContentTypePicker } from "./components/ContentTypePicker";
import { EditLinkPopover } from "./components/EditLinkPopover";

// We memorize the button so each button is not rerendered
// on every editor state change
const MemoButton = memo(Toolbar.Button);
const MemoColorPicker = memo(ColorPicker);
const MemoFontFamilyPicker = memo(FontFamilyPicker);
const MemoFontSizePicker = memo(FontSizePicker);
const MemoContentTypePicker = memo(ContentTypePicker);

export type TextMenuProps = {
    editor: Editor;
};

export const TextMenu = ({ editor }: TextMenuProps) => {
    const commands = useTextmenuCommands(editor);
    const states = useTextmenuStates(editor);
    const blockOptions = useTextmenuContentTypes(editor);

    return (
        <BubbleMenu
            tippyOptions={{ popperOptions: { placement: "top-start" } }}
            editor={editor}
            pluginKey="textMenu"
            shouldShow={states.shouldShow}
            updateDelay={100}
        >
            <Toolbar.Wrapper>
                <MemoContentTypePicker options={blockOptions} />
                <MemoButton tooltip={__("Bold")} tooltipShortcut={["Mod", "B"]} onClick={commands.onBold} active={states.isBold}>
                    <Icon name="Bold" />
                </MemoButton>
                <MemoButton tooltip={__("Italic")} tooltipShortcut={["Mod", "I"]} onClick={commands.onItalic} active={states.isItalic}>
                    <Icon name="Italic" />
                </MemoButton>
                <MemoButton
                    tooltip={__("Underline")}
                    tooltipShortcut={["Mod", "U"]}
                    onClick={commands.onUnderline}
                    active={states.isUnderline}
                >
                    <Icon name="Underline" />
                </MemoButton>
                <Toolbar.Divider />
                <MemoButton
                    tooltip={__("Strikehrough")}
                    tooltipShortcut={["Mod", "X"]}
                    onClick={commands.onStrike}
                    active={states.isStrike}
                >
                    <Icon name="Strikethrough" />
                </MemoButton>
                <MemoButton tooltip={__("Code")} tooltipShortcut={["Mod", "E"]} onClick={commands.onCode} active={states.isCode}>
                    <Icon name="Code" />
                </MemoButton>
                <Toolbar.Divider />
                <MemoButton tooltip={__("Code block")} onClick={commands.onCodeBlock}>
                    <Icon name="Code2" />
                </MemoButton>
                <EditLinkPopover onSetLink={commands.onLink} />
                <Popover.Root>
                    <Popover.Trigger asChild>
                        <MemoButton tooltip={__("More options")}>
                            <Icon name="MoreVertical" />
                        </MemoButton>
                    </Popover.Trigger>
                    <Popover.Content side="top" asChild>
                        <Toolbar.Wrapper>
                            <MemoButton
                                tooltip={__("Subscript")}
                                tooltipShortcut={["Mod", "."]}
                                onClick={commands.onSubscript}
                                active={states.isSubscript}
                            >
                                <Icon name="Subscript" />
                            </MemoButton>
                            <MemoButton
                                tooltip={__("Superscript")}
                                tooltipShortcut={["Mod", ","]}
                                onClick={commands.onSuperscript}
                                active={states.isSuperscript}
                            >
                                <Icon name="Superscript" />
                            </MemoButton>
                            <Toolbar.Divider />
                            <MemoButton
                                tooltip={__("Align left")}
                                tooltipShortcut={["Shift", "Mod", "L"]}
                                onClick={commands.onAlignLeft}
                                active={states.isAlignLeft}
                            >
                                <Icon name="AlignLeft" />
                            </MemoButton>
                            <MemoButton
                                tooltip={__("Align center")}
                                tooltipShortcut={["Shift", "Mod", "E"]}
                                onClick={commands.onAlignCenter}
                                active={states.isAlignCenter}
                            >
                                <Icon name="AlignCenter" />
                            </MemoButton>
                            <MemoButton
                                tooltip={__("Align right")}
                                tooltipShortcut={["Shift", "Mod", "R"]}
                                onClick={commands.onAlignRight}
                                active={states.isAlignRight}
                            >
                                <Icon name="AlignRight" />
                            </MemoButton>
                            <MemoButton
                                tooltip={__("Justify")}
                                tooltipShortcut={["Shift", "Mod", "J"]}
                                onClick={commands.onAlignJustify}
                                active={states.isAlignJustify}
                            >
                                <Icon name="AlignJustify" />
                            </MemoButton>
                        </Toolbar.Wrapper>
                    </Popover.Content>
                </Popover.Root>
            </Toolbar.Wrapper>
        </BubbleMenu>
    );
};
