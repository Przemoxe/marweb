<?php if (empty($color->text) || empty($color->background)) return ?>

<style>

.test {
    color: <?= $color->text ?>
    background-color: <?= $color->background ?>
}

</style>