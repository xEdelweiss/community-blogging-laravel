let index = 0;

export function jsonp(url: string, timeout: number = 5000): Promise {
    return new Promise((resolve, reject) => {
        const callbackName = "jsonp_callback_" + index++;
        const script = document.createElement("script");

        const timeoutId = setTimeout(() => {
            reject(new Error("JSONP request to " + url + " timed out"));
        }, timeout);

        window[callbackName] = function (data) {
            clearTimeout(timeoutId);
            document.getElementsByTagName("head")[0].removeChild(script);
            delete window[callbackName];
            resolve(data);
        };

        script.src = url + (url.indexOf("?") >= 0 ? "&" : "?") + "callback=" + callbackName;
        document.getElementsByTagName("head")[0].appendChild(script);
    });
}
