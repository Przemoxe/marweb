<script>
    (function () {
        jQuery(document).ready(function () {
            $('#excerpt').attr('maxlength', '<?= $limit ?>');
            $('#excerpt').css('min-height', '100');
            $('#postexcerpt h2 span').append('<span> (max: <?= $limit ?> znaków)</span>');
        });
    })();
</script>