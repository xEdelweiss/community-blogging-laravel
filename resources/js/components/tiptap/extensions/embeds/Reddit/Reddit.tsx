import { Node } from "@tiptap/core";
import { makeNamedEmbedExtension } from "../makeNamedEmbedExtension";

const REGEX_RULE = /^(https?:\/\/)?(www\.reddit\.com)\/(.+)$/g;

const isValidUrl = (src: string) => {
    // @todo improve this
    return src.includes("://www.reddit.com/");
};

export const Reddit = Node.create(makeNamedEmbedExtension("reddit", "setRedditPost", REGEX_RULE, isValidUrl));
