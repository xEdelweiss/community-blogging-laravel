import Youtube from "@tiptap/extension-youtube";

export const FullWidthYoutube = Youtube.extend({
    renderHTML(config) {
        return this.parent?.({
            ...config,
            HTMLAttributes: {
                ...config.HTMLAttributes,
                class: "w-full aspect-video rounded-xl overflow-hidden",
                width: "100%",
                height: "100%",
            },
        });
    },
});
