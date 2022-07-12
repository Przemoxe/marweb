<?php if (empty($post->gallery)) return ?>

<?php
    $count = count($post->gallery);
    $template = 'default';
    if ($count == 1)
    {
        $template = '1';
    }
    if ($count >= 2 && $count <= 4)
    {
        $template = '2-4';
    }
?>

<section class="product-gallery product-gallery--template-<?= $template ?>">

    <div class="container">
        <?php partial('product/single/gallery/' . $template, ['items' => $post->gallery]) ?>
    </div>
    
</section>