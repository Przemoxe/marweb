<?php if (!empty($formShortcode)): ?>
    <div class="br-block contact-form-7">
        <?= $image ?>
        <div class="container">
            <div class="row">
                <div class="col-12 content">                  
                    <?= do_shortcode($formShortcode); ?>
                </div>
            </div>
        </div>
    </div>
<?php elseif ($is_preview): ?>
    <?= __('Nie znaleziono formularza', TEXT_DOMAIN) ?>
<?php endif; ?>