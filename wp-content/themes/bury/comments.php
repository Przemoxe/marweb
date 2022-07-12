<?php
if (post_password_required() || !comments_open()) {
    return;
}
global $post;
?>

<div class="your-comment-box">
    <div class="container">
        <div class="row">
            <div id="comments" class="col-12 col-sm-12 col-md-12 col-lg-9 offset-lg-3">
                <div class="comments-add-box">
                    <div class="comments-title-box">
                        <h2><?= __('Wasze komentarze', TEXT_DOMAIN); ?></h2>
                    </div>
                    <?php if (! is_user_logged_in()): ?>
                        <form action="<?= site_url( '/wp-comments-post.php' ) ?>" method="post">
                            <div class="add-comment-box">
                                <div class="mat-div">
                                    <label for="author" class="mat-label"><?= __('Imię i nazwisko', TEXT_DOMAIN) ?></label>
                                    <input type="text" id="author" class="mat-input" autocomplete="off" name="author" value="" required="" aria-required="true">
                                </div>
                                <div class="mat-div textarea-with-label">
                                    <label for="comment" class="mat-label"><?= __('Twój komentarz', TEXT_DOMAIN) ?></label>
                                    <textarea class="mat-input" name="comment"></textarea>
                                </div>
                                <div class="add-comment-btn">
                                    <button name="submit" type="submit" id="submit" class="button button--primary button--small with-icon"><?= __('dodaj', TEXT_DOMAIN); ?><i class="icon-button-arrow-right"></i></button>
                                </div>
                                <input id="url" name="url" type="hidden" value="<?= get_permalink() ?>" size="30" maxlength="200">
                                <input type="hidden" name="comment_post_ID" value="<?= $post->ID ?>" id="comment_post_ID">
                                <input type="hidden" name="comment_parent" id="comment_parent" value="0">
                                <p class="terms">
                                    <small><?= __('Ta strona jest chroniona przez reCAPTCHA i obowiązują na niej <a href="https://policies.google.com/privacy">polityka prywatności</a> oraz <a href="https://policies.google.com/terms">warunki korzystania z usługi</a> firmy Google.', TEXT_DOMAIN) ?></small>
                                </p>
                            </div>
                            <?= do_action( 'anr_captcha_form_field' ) ?>
                        </form>
                    <?php endif; ?>
                </div>
                <?php if (have_comments()) : ?>
                    <div class="cite-main-box">
                        <?php wp_list_comments(); ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>