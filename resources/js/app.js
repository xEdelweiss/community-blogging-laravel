import "./bootstrap";
import { Livewire } from "../../vendor/livewire/livewire/dist/livewire.esm";
import usePostEditor from "./usePostEditor.tsx";
import useTelegramEmbed from "./embeds/useTelegramEmbed.js";
import useRedditEmbed from "./embeds/useRedditEmbed.js";
import useTwitterEmbed from "./embeds/useTwitterEmbed.js";
import useInstagramEmbed from "./embeds/useInstagramEmbed.js";
import useYoutubeEmbed from "./embeds/useYoutubeEmbed.js";

usePostEditor();

useTelegramEmbed();
useRedditEmbed();
useTwitterEmbed();
useInstagramEmbed();
useYoutubeEmbed();

Livewire.start();
