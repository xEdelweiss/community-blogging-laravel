import "./bootstrap";
import { Livewire } from "../../vendor/livewire/livewire/dist/livewire.esm";
import usePostEditor from "./usePostEditor.jsx";
import useEmbed from "./useEmbed.js";
import useAutosize from "./useAutosize.js";
import useLimitIndicator from "./useLimitIndicator.js";

usePostEditor();
useAutosize();
useLimitIndicator();
useEmbed();

Livewire.start();
