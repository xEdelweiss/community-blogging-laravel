import "./bootstrap";
import * as Sentry from "@sentry/browser";
import { Livewire } from "../../vendor/livewire/livewire/dist/livewire.esm";
import usePostEditor from "./usePostEditor.jsx";
import useEmbed from "./useEmbed.js";
import useAutosize from "./useAutosize.js";
import useLimitIndicator from "./useLimitIndicator.js";
import useHiddenFailedImage from "./useHiddenFailedImage.js";
import useViewTrack from "./useViewTrack.js";

usePostEditor();
useAutosize();
useLimitIndicator();
useEmbed();
useHiddenFailedImage();
useViewTrack();

Sentry.init({
    dsn: import.meta.env.VITE_SENTRY_DSN_PUBLIC,
});

Livewire.start();
