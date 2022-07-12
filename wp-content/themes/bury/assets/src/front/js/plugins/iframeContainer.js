export default class iframeContainer {
    init() {
        var iframe = document.querySelectorAll('[has-iframe] iframe');

        iframe.forEach(el => {
            const newEl = document.createElement("div");
            newEl.classList.add("iframe-container");
            const parent = el.parentNode;
            parent.insertBefore(newEl, el);

            newEl.appendChild(el);
        });    
    }
}