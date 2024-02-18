export async function fetchEmbed(src) {
    const response = await fetch("/api/embed?url=" + encodeURIComponent(src), {
        method: "GET",
        headers: {
            Accept: "application/json",
        },
    });

    if (!response.ok) {
        throw new Error("Network response was not ok: " + response.status + " " + response.statusText);
    }

    const embed = await response.json();

    window.dispatchEvent(new CustomEvent("embed-loaded", { detail: { embed, src } }));

    return embed;
}
