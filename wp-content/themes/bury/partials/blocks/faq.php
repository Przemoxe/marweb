<!--Accordion wrapper-->
<div class="accordion md-accordion br-block container" id="accordionEx" role="tablist" aria-multiselectable="true">
<?php if (!empty($items)) :?>
    <?php foreach($items as $index => $item): ?>
  <!-- Accordion card -->
    <div class="card faq-block">
    <!-- Card header -->
        <div class="card-header faq-block-title" role="tab" id="heading-faq-<?= $index ?>">
        <button type="button" data-toggle="collapse" class="tab collapsed" data-parent="#accordionEx" data-target="#collapse-<?= $index ?>" aria-expanded="true" aria-controls="#collapse-<?= $index ?>">
            <span>
                <?= array_get($item, 'question') ?>
            </span>
        </button>
        </div>
        <!-- Card body -->
        <div id="collapse-<?= $index ?>" class="collapse" role="tabpanel" aria-labelledby="heading-faq-<?= $index ?>" data-parent="#accordionEx">
            <div class="card-body faq-block-answer">
                <?= array_get($item, 'answer') ?>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
  <!-- Accordion card -->
</div>
<!-- Accordion wrapper -->
<?php endif; ?>
