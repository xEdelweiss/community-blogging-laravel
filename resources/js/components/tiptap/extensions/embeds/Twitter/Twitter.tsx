import { Node } from "@tiptap/core";
import { makeNamedEmbedExtension } from "../makeNamedEmbedExtension";

const REGEX_RULE = /^(https?:\/\/)?(twitter\.com)\/(.+)$/g;

const isValidUrl = (src: string) => {
    // @todo improve this
    return src.includes("://twitter.com/");
};

export const Twitter = Node.create(makeNamedEmbedExtension("twitter", "setTwitterPost", REGEX_RULE, isValidUrl));
