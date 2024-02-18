import { Node } from "@tiptap/core";
import { makeNamedEmbedExtension } from "../makeNamedEmbedExtension";

const REGEX_RULE = /^(https?:\/\/)?(t\.me)\/(?<postId>[^/]+\/[0-9]+)$/g;

const isValidUrl = (src: string) => {
    // @todo improve this
    return src.includes("://t.me/");
};

export const Telegram = Node.create(makeNamedEmbedExtension("telegram", "setTelegramPost", REGEX_RULE, isValidUrl));
