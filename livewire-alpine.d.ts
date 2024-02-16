import * as AlpineTypes from "@types/alpinejs";

declare module "vendor/livewire/livewire/dist/livewire.esm.js" {
    // Augment the Livewire module with AlpineJS types
    export const Alpine: AlpineTypes.Alpine;
}
