import React, { useEffect } from "react";
import { NodeViewWrapper } from "@tiptap/react";
import { jsonp } from "../../../lib/jsonp";

export interface InstagramEmbedProps {
    node: Node & {
        attrs: {
            src: string;
        };
    };
}

const loadInstagramWidgetOrCallIt = () => {
    if (window["instgrm"]) {
        console.log("LOADING TWITTER WIDGET");
        window["instgrm"].Embeds.process();
    } else {
        console.log("LOADING TWITTER WIDGET SCRIPT");
        const script = document.createElement("script");
        script.src = "https://www.instagram.com/embed.js";
        document.body.appendChild(script);
    }
};

const InstagramEmbed = ({ node }: InstagramEmbedProps) => {
    const { src } = node.attrs;

    useEffect(() => {
        setTimeout(() => {
            loadInstagramWidgetOrCallIt();
        }, 0);
    }, []);

    return (
        <NodeViewWrapper>
            <div className={"instagram-container"}>
                <blockquote
                    className="instagram-media"
                    data-instgrm-captioned={true}
                    data-instgrm-permalink={src}
                    data-instgrm-version="14"
                ></blockquote>
            </div>
        </NodeViewWrapper>
    );
};

export default InstagramEmbed;
