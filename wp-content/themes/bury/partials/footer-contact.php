<?php if( !empty(theme()->config()->options()->footer->title) ): ?>
    <p class="title"> <?php echo theme()->config()->options()->footer->title ?></p>
<?php endif ?>
<?php if( !empty(theme()->config()->options()->footer->addres1) ): ?>
    <p> <?php echo theme()->config()->options()->footer->addres1 ?></p>
<?php endif ?>
<?php if( !empty(theme()->config()->options()->footer->addres2) ): ?>
    <p> <?php echo theme()->config()->options()->footer->addres2 ?></p>
<?php endif ?>
<?php if( !empty(theme()->config()->options()->footer->e_mail) ): ?>
    <p> <?php echo theme()->config()->options()->footer->e_mail?></p>
<?php endif ?>
<?php if( !empty(theme()->config()->options()->footer->phone_number) ): ?>
    <p> <?php echo theme()->config()->options()->footer->phone_number ?></p>
<?php endif ?>
