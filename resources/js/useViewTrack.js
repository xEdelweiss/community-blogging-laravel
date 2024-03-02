import { Alpine } from "../../vendor/livewire/livewire/dist/livewire.esm.js";

class Dispatcher {
    constructor(interval = 1000, once = true) {
        this.queue = [];
        this.once = once;

        setInterval(() => {
            const batch = [...this.queue];
            this.queue = [];

            if (batch.length === 0) {
                return;
            }

            this._dispatch(batch);
        }, interval);
    }

    add({ action, viewableType, viewableId }) {
        if (this.once && localStorage.getItem(`vt-${action}-${viewableType}.${viewableId}`)) {
            return;
        }

        this.queue.push({ action, viewableType, viewableId });
    }

    async _dispatch(batch) {
        await fetch("/api/view-track", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                Accept: "application/json",
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
            },
            body: JSON.stringify({
                batch: batch.map(({ action, viewableType, viewableId }) => ({
                    action,
                    viewable_type: viewableType,
                    viewable_id: viewableId,
                })),
            }),
        });

        if (this.once) {
            batch.forEach(({ action, viewableType, viewableId }) => {
                localStorage.setItem(`vt-${action}-${viewableType}.${viewableId}`, "1");
            });
        }
    }
}

export default function useViewTrack() {
    const ACTIONS = ["listing", "view", "read"];

    const dispatcher = new Dispatcher(1000);

    function parseModifiers(modifiers) {
        const result = {
            delay: "100ms",
            action: null,
            viewableType: null,
        };

        modifiers.forEach((m) => {
            if (m.endsWith("ms")) {
                result.delay = m;
                return;
            }

            if (ACTIONS.includes(m)) {
                result.action = m;
                return;
            }

            result.viewableType = m;
        });

        return result;
    }

    Alpine.directive("view-track", async (element, { expression, value, type, modifiers, original }, { cleanup, evaluate }) => {
        const { delay, action, viewableType } = parseModifiers(modifiers);
        const viewableId = expression;

        let timeout;

        if (!action) {
            throw new Error("The view-track directive must have an action type: " + ACTIONS.join(", "));
        }

        if (!viewableType) {
            throw new Error("The view-track directive must have a type");
        }

        const observer = new IntersectionObserver((entries, observer) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    if (timeout) {
                        return;
                    }

                    timeout = setTimeout(() => {
                        observer.disconnect();
                        dispatcher.add({
                            action,
                            viewableType,
                            viewableId,
                        });
                    }, delay);
                } else {
                    if (!timeout) {
                        return;
                    }

                    clearTimeout(timeout);
                }
            });
        });

        observer.observe(element);

        // element.addEventListener("scroll", resize);

        cleanup(() => {
            // element.removeEventListener("scroll", resize);
            observer.disconnect();
        });
    });
}
