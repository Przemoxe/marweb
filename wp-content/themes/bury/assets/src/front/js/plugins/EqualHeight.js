export default class EqualHeight {
    init() {
        document.addEventListener('equalize-heights', this.matchHeight);
        this.matchHeight();
    }

    matchHeight() {
        const elements = document.querySelectorAll('[equal-height]');
        elements.forEach(element => {
            const children = element.querySelectorAll('[equal-height-watch]');
            if (children.length === 0) return;

            children.forEach(child => {
                child.style.height = null;
            });

            var maxHeight = children[0].offsetHeight;
            children.forEach(child => {
                if (child.offsetHeight > maxHeight) {
                    maxHeight = child.offsetHeight;
                }
            });
            children.forEach(child => {
                child.style.height = `${maxHeight}px`;
            });
        });
    }
}