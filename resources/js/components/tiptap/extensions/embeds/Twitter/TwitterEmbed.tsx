import React, { useEffect } from "react";
import { NodeViewWrapper } from "@tiptap/react";
import { jsonp } from "../../../lib/jsonp";

export interface TwitterEmbedProps {
    node: Node & {
        attrs: {
            src: string;
        };
    };
}

const loadTwitterWidgetOrCallIt = () => {
    if (window["twttr"]) {
        console.log("LOADING TWITTER WIDGET");
        window["twttr"].widgets.load();
    } else {
        console.log("LOADING TWITTER WIDGET SCRIPT");
        const script = document.createElement("script");
        script.src = "https://platform.twitter.com/widgets.js";
        document.body.appendChild(script);
    }
};

const TwitterEmbed = ({ node }: TwitterEmbedProps) => {
    const { src } = node.attrs;
    const [html, setHtml] = React.useState("");

    useEffect(() => {
        jsonp("https://publish.twitter.com/oembed?url=" + encodeURIComponent(src)).then((res) => {
            console.log("RES", res);
            setHtml(res.html);

            setTimeout(() => {
                loadTwitterWidgetOrCallIt();
            }, 0);
        });
    }, []);

    return (
        <NodeViewWrapper>
            <div className={"twitter-container"} dangerouslySetInnerHTML={{ __html: html }}></div>
        </NodeViewWrapper>
    );
};

export default TwitterEmbed;
