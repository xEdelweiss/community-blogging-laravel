import { Alpine } from "../../vendor/livewire/livewire/dist/livewire.esm";

export default function useLimitIndicator() {
    Alpine.data("limit", (limit) => ({
        value: "",
        limit,
        get indicatorColor() {
            if (this.value.length < this.limit * 0.4) {
                return "bg-green-500";
            }

            if (this.value.length < this.limit * 0.7) {
                return "bg-yellow-500";
            }

            return "bg-red-500";
        },
    }));

    Alpine.directive("limit-value", (el, { expression }, { evaluateLater, effect, Alpine: { watch, $data }, cleanup }) => {
        const getValue = evaluateLater(expression);

        effect(() => {
            getValue((value) => ($data(el).value = value));
        });
    });
}
