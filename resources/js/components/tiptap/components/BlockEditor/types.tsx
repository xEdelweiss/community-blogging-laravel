// import { TiptapCollabProvider } from '@hocuspocus/provider'
// import { Language } from '@tiptap-pro/extension-ai'
import { Language, TiptapCollabProvider } from "../../extensions/fake-pro";
import * as Y from "yjs";
import { Content } from "@tiptap/react";

export interface TiptapProps {
    value: Content;
    onChange: (value: Content) => void;
    aiToken: string;
    hasCollab: boolean;
    ydoc: Y.Doc;
    provider?: TiptapCollabProvider | null | undefined;
}

export type EditorUser = {
    clientId: string;
    name: string;
    color: string;
    initials?: string;
};

export type LanguageOption = {
    name: string;
    label: string;
    value: Language;
};

export type AiTone =
    | "academic"
    | "business"
    | "casual"
    | "childfriendly"
    | "conversational"
    | "emotional"
    | "humorous"
    | "informative"
    | "inspirational"
    | string;

export type AiPromptType = "SHORTEN" | "EXTEND" | "SIMPLIFY" | "TONE";

export type AiToneOption = {
    name: string;
    label: string;
    value: AiTone;
};

export type AiImageStyle = {
    name: string;
    label: string;
    value: string;
};
