export type TableOfContentsStorage = {
    content: {
        id: string;
        level: number;
        isActive: boolean;
        itemIndex: number;
        textContent: string;
    }[];
};
