import "./bootstrap";
import { Livewire } from "../../vendor/livewire/livewire/dist/livewire.esm";
import usePostEditor from "./usePostEditor.tsx";
import useEmbed from "./useEmbed.js";
import useAutosize from "./useAutosize.js";

usePostEditor();
useAutosize();
useEmbed();

Livewire.start();
