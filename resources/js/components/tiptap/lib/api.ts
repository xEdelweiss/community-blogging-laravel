export class API {
    public static uploadImage = async (file: File) => {
        const formData = new FormData();
        formData.append("image", file);

        const response = await fetch("/api/upload-image", {
            method: "POST",
            body: formData,
            headers: {
                "X-CSRF-TOKEN": document.head.querySelector("meta[name=csrf-token]").content,
            },
        });

        const { url } = await response.json();

        return url;
    };
}

export default API;
