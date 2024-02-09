import React, { useEffect } from "react";
import { NodeViewWrapper } from "@tiptap/react";

export interface RedditEmbedProps {
    node: Node & {
        attrs: {
            src: string;
        };
    };
}

const loadRedditWidgetOrCallIt = () => {
    // if (window["instgrm"]) {
    //     console.log("LOADING TWITTER WIDGET");
    //     window["instgrm"].Embeds.process();
    // } else {
    //     console.log("LOADING TWITTER WIDGET SCRIPT");
    const script = document.createElement("script");
    script.src = "https://embed.reddit.com/widgets.js";
    document.body.appendChild(script);
    // }
};

const RedditEmbed = ({ node }: RedditEmbedProps) => {
    const { src } = node.attrs;

    useEffect(() => {
        setTimeout(() => {
            loadRedditWidgetOrCallIt();
        }, 0);
    }, []);

    return (
        <NodeViewWrapper>
            <div className={"reddit-container"}>
                <blockquote className="reddit-embed-bq">
                    <a href={src}></a>
                </blockquote>
            </div>
        </NodeViewWrapper>
    );
};

export default RedditEmbed;
