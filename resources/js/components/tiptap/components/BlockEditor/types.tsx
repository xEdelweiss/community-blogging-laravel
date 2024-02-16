import { Language } from "../../extensions/fake-pro";
import { Content } from "@tiptap/react";

export interface TiptapProps {
    value: Content;
    onChange: (value: Content) => void;
}

export type LanguageOption = {
    name: string;
    label: string;
    value: Language;
};
