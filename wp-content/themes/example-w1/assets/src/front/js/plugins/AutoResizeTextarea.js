export default function(){
    $(document).on('input', 'textarea', function () {
        $(this).outerHeight(-100).outerHeight(this.scrollHeight); // 38 or '1em' -min-height
    });  
}
