<?php if (!empty($employees)): ?>
    <div class="br-block block__employees-list">
        <div class="container">
            <div class="row no-gutters">
                <?php foreach($employees as $employee): ?>
                    <div class="col-4 employee">
                        <div class="block__employees-list__image" style="background-image: url('<?= get_the_post_thumbnail_url($employee) ?>');"></div>
                        <div class="block__employees-list__title"><?= $employee->post_title; ?></div>
                        <div class="block__employees-list__position"><?= $employee->position; ?></div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
<?php elseif ($is_preview): ?>
    <?= __('Nie znaleziono pracowników', TEXT_DOMAIN) ?>
<?php endif; ?>