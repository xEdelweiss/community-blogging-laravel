import React from "react";
import { EditorInfo } from "./EditorInfo";

export type EditorHeaderProps = {
    characters: number;
    words: number;
    children?: React.ReactNode;
};

export const EditorFooter = ({
    characters,
    words,
    children,
}: EditorHeaderProps) => {
    return (
        <div className="flex flex-row items-center justify-between flex-none py-2 text-black bg-white border-t border-neutral-200 dark:bg-black dark:text-white dark:border-neutral-800">
            <div className="flex flex-row gap-x-1.5 items-center"></div>
            <div className={"flex gap-x-2"}>
                <EditorInfo characters={characters} words={words} />
                {children}
            </div>
        </div>
    );
};
