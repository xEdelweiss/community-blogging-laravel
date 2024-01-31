import { Alpine } from "../../vendor/livewire/livewire/dist/livewire.esm";
import React from "react";
import { createRoot } from "react-dom/client";
import PostEditor from "./components/PostEditor.jsx";

export default function usePostEditor() {
    Alpine.directive("post-editor", (element) => {
        createRoot(element).render(<PostEditor />);
    });
}
