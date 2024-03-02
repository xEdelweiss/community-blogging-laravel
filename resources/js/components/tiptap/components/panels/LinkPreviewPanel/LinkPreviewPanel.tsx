import React from "react";
import { Icon } from "../../ui/Icon";
import { Surface } from "../../ui/Surface";
import { Toolbar } from "../../ui/Toolbar";
import Tooltip from "../../../components/ui/Tooltip";

export type LinkPreviewPanelProps = {
    url: string;
    onEdit: () => void;
    onClear: () => void;
};

export const LinkPreviewPanel = ({ onClear, onEdit, url }: LinkPreviewPanelProps) => {
    return (
        <Surface className="flex items-center gap-2 p-2">
            <a href={url} target="_blank" rel="noopener noreferrer" className="text-sm underline break-all">
                {url}
            </a>
            <Toolbar.Divider />
            <Tooltip title={__("Edit link")}>
                <Toolbar.Button onClick={onEdit}>
                    <Icon name="Pen" />
                </Toolbar.Button>
            </Tooltip>
            <Tooltip title={__("Remove link")}>
                <Toolbar.Button onClick={onClear}>
                    <Icon name="Trash2" />
                </Toolbar.Button>
            </Tooltip>
        </Surface>
    );
};
