
// const textarea = document.querySelector("#autoresizing");
// if(textarea)
// textarea.addEventListener('input', autoResize, false);


// function autoResize() {
//     this.style.height = 'auto';
//     this.style.height = this.scrollHeight + 'px';
    
// }
$(document).on('input', 'textarea', function () {
    $(this).outerHeight(-100).outerHeight(this.scrollHeight); // 38 or '1em' -min-height
});  