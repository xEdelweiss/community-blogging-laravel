import { Node } from "@tiptap/core";
import { makeNamedEmbedExtension } from "../makeNamedEmbedExtension";

const REGEX_RULE = /^(https?:\/\/)?(www\.)?(vimeo\.com)\/(.+)$/g;

export const isValidUrl = (src: string) => {
    // @todo improve this
    return src.includes("://vimeo.com/");
};

export const Vimeo = Node.create(makeNamedEmbedExtension("vimeo", "setVimeoVideo", REGEX_RULE, isValidUrl));
