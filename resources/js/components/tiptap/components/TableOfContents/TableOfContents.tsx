import React from "react";
import { Editor as CoreEditor } from "@tiptap/core";
import { memo, useEffect, useState } from "react";
// import { TableOfContentsStorage } from '@tiptap-pro/extension-table-of-contents'
import { TableOfContentsStorage } from "../../extensions/TableOfContentsNode";

import { cn } from "../../lib/utils";

export type TableOfContentsProps = {
    editor: CoreEditor;
    onItemClick?: () => void;
};

const scrollSmoothly = (e: React.MouseEvent<HTMLAnchorElement>, id: string) => {
    e.preventDefault();
    document.getElementById(id)?.scrollIntoView({
        behavior: "smooth",
    });
};

export const TableOfContents = memo(({ editor, onItemClick }: TableOfContentsProps) => {
    const [data, setData] = useState<TableOfContentsStorage | null>(null);

    useEffect(() => {
        const handler = ({ editor: currentEditor }: { editor: CoreEditor }) => {
            let newData: TableOfContentsStorage = { content: [] };
            editor.state.doc.descendants((node) => {
                if (node.type.name === "heading") {
                    newData = {
                        content: [
                            ...newData.content,
                            {
                                id: node.attrs.id,
                                isActive: false,
                                itemIndex: newData.content.length + 1,
                                level: node.attrs.level,
                                textContent: node.textContent,
                            },
                        ],
                    };
                }

                return false;
            });
            setData(newData);
        };

        handler({ editor });

        editor.on("update", handler);
        editor.on("selectionUpdate", handler);

        return () => {
            editor.off("update", handler);
            editor.off("selectionUpdate", handler);
        };
    }, [editor]);

    return (
        <>
            <div className="mb-2 text-xs font-semibold uppercase text-neutral-500 dark:text-neutral-400">Table of contents</div>
            {data?.content && data.content.length > 0 ? (
                <div className="flex flex-col gap-1">
                    {data.content.map((item) => (
                        <a
                            key={item.id}
                            href={`#${item.id}`}
                            style={{
                                paddingLeft: `${+item.level - 1}rem`,
                            }}
                            onClick={onItemClick ?? ((e) => scrollSmoothly(e, item.id))}
                            className={cn(
                                "block no-underline font-medium text-neutral-500 dark:text-neutral-300 p-1 rounded bg-opacity-10 text-sm hover:text-neutral-800 transition-all hover:bg-black hover:bg-opacity-5 truncate w-full",
                                item.isActive && "text-neutral-800 bg-neutral-100 dark:text-neutral-100 dark:bg-neutral-900",
                            )}
                        >
                            {item.itemIndex}. {item.textContent}
                        </a>
                    ))}
                </div>
            ) : (
                <div className="text-sm text-neutral-500">{__("Start adding headlines to your document…")}</div>
            )}
        </>
    );
});

TableOfContents.displayName = "TableOfContents";
