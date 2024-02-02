import React from "react";

export interface EmojiItem {
    emoji: string;
    name: string;
    fallbackImage?: string;
}

export type ImageOptions = string;
export type Language = string;
export enum WebSocketStatus {
    "Disconnected" = "disconnected",
}

export type HocuspocusProvider = null;
export type TiptapCollabProvider = null;

export type TableOfContentsStorage = {
    content: {
        id: string;
        level: number;
        title: string;
        isActive: boolean;
        itemIndex: number;
        textContent: string;
    }[];
};
export const DragHandle = ({
    pluginKey,
    editor,
    onNodeChange,
    tippyOptions,
    children,
}: any) => {
    return <>{children} </>;
};
