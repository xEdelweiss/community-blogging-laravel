import { Node } from "@tiptap/core";
import { makeNamedEmbedExtension } from "../makeNamedEmbedExtension";

const REGEX_RULE = /^(https?:\/\/)?(www\.)?(youtube\.com)\/(.+)$/g;
const REGEX_IFRAME = /<iframe.+src="((?:https:\/\/)?(?:www\.)?youtube\.com\/embed\/(?:[^"]+))"(?:.*?)><\/iframe>/g;

export const isValidUrl = (src: string) => {
    // @todo improve this
    return src.includes("://youtube.com/") || src.includes("://www.youtube.com/") || src.includes("://youtu.be/");
};

export const Youtube = Node.create(
    makeNamedEmbedExtension("youtube", "setYoutubeVideo", REGEX_RULE, isValidUrl, [
        {
            find: REGEX_IFRAME,
            getAttributes: (match) => {
                return {
                    src: match[1],
                };
            },
        },
    ]),
);
