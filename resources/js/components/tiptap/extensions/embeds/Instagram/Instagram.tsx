import { Node } from "@tiptap/core";
import { makeNamedEmbedExtension } from "../makeNamedEmbedExtension";

const REGEX_RULE = /^(https?:\/\/)?(www\.)?(instagram\.com)\/(.+)$/g;

const isValidUrl = (src: string) => {
    // @todo improve this
    return src.includes("://www.instagram.com/") || src.includes("://instagram.com/");
};

export const Instagram = Node.create(makeNamedEmbedExtension("instagram", "setInstagramPost", REGEX_RULE, isValidUrl));
