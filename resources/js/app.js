import "./bootstrap";
import { Livewire } from "../../vendor/livewire/livewire/dist/livewire.esm";
import usePostEditor from "./usePostEditor.tsx";
import useTelegramEmbed from "./embeds/drivers/useTelegramEmbed.js";
import useRedditEmbed from "./embeds/drivers/useRedditEmbed.js";
import useTwitterEmbed from "./embeds/drivers/useTwitterEmbed.js";
import useInstagramEmbed from "./embeds/drivers/useInstagramEmbed.js";
import useYoutubeEmbed from "./embeds/drivers/useYoutubeEmbed.js";
import useDynamicEmbed from "./embeds/useDynamicEmbed.js";
import useUrlEmbed from "./embeds/drivers/useUrlEmbed.js";
import useAutosize from "./useAutosize.js";
import useWatchEmbedTitle from "./embeds/useWatchEmbedTitle.js";

usePostEditor();
useAutosize();

useWatchEmbedTitle();
useDynamicEmbed([useTelegramEmbed(), useRedditEmbed(), useTwitterEmbed(), useInstagramEmbed(), useYoutubeEmbed(), useUrlEmbed()]);

Livewire.start();
