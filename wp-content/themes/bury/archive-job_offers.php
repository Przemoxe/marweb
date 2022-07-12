<?php
    get_header();
    $title = is_category() ? single_term_title( '', false ) : post_type_archive_title( '', false );
    $jobOffers = theme()->jobOfferModel()->getAllPublished(['before_deactivation_date' => true], 15);
?>

<main class="posts job-offers">
    <div class="container"><?php theme()->templateTags()->breadrumbs(); ?></div>
    <?php theme()->templateTags()->printCareerMenu('job_offers', false); ?>
    <?php if ( $jobOffers->have_posts() ): ?>
    <div class="br-block job-offer-list">
        <div class="container">   
            <div class="row">
                <div class="col-md-12">
                    <table class="job-offer-list__table" drop-down-container>
                        <tbody>
                            <tr class="job-offer-list__heading">
                                <th><?= __('NAZWA STANOWISKA'); ?></th>
                                <th><?= __('LOKALIZACJA'); ?></th>
                                <th colspan='2'><?= __('REKRUTER PROWADZĄCY'); ?></th>
                                <th><?= __('SZCZEGÓŁY'); ?></th>
                            </tr>
                            <tr class="space"><td colspan="6"></td></tr>
                            <?php foreach($jobOffers->posts as $post): ?>
                                    <tr class="ae-select">
                                        <td>
                                            <table>
                                            <tr class="job-offer-list__row justify-content-between">
                                                <td class="job-offer-list__position"><?= get_the_title($post); ?></td>
                                                <td class="ae-select-arrow"></td>
                                            </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr class="job-offer-list__row nav flex-column ae-hide">
                                                <td class="job-offer-list__position"><?= get_the_title($post); ?></td>
                                                <td class="job-offer-list__city"><?= $post->city ?></td>
                                                <td class="job-offer-list__thumbnail"><?= get_the_post_thumbnail($post->employee, [60, 60]) ?></td>
                                                <td class="job-offer-list__employee">
                                                    <div class="employee-name"><strong><?= $post->employee->post_title ?></strong></div>
                                                    <div class="employee-position"><small><?= $post->employee->position ?></small></div>
                                                </td>
                                                <?php if (!empty($writeToUsLink)): ?>
                                                <td class="job-offer-list__write-to-us">
                                                    <a href="<?= $writeToUsLink ?>"><?= $writeToUsDescription ?></a>
                                                </td>
                                                <?php endif; ?>
                                                <td class="job-offer-list__more">
                                                    <a href="<?= get_permalink($post) ?>" class="button button-inverted"><?= __('Więcej', TEXT_DOMAIN) ?></a>
                                                </td>
                                    </tr>
                                    <tr class="space"><td colspan="6"></td></tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="container">   
            <div class="row">
                <div class="job-offer-list__discousure">
                    <p><?= __("Jeżeli nie znalazłeś interesującej Cię oferty pracy, prześlij nam aplikację z własnej inicjatywy:"); ?></p>
                </div>
                <div class="job-offer-list__buttons">
                <?php if( !empty(theme()->config()->options()->link_aplikuj_do_bazy) ): ?>
                    <a href="<?= theme()->config()->options()->link_aplikuj_do_bazy; ?>" class="button button-inverted"><?= __('APLIKUJ DO BAZY'); ?></a>
                <?php endif; ?>
                <?php if( !empty(theme()->config()->options()->link_aplikuj_na_staz) ): ?>
                    <a href="<?= theme()->config()->options()->link_aplikuj_na_staz; ?>" class="button button-inverted"><?= __('APLIKUJ NA STAŻ'); ?></a>
                <?php endif; ?>
                <?php if( !empty(theme()->config()->options()->link_aplikuj_na_produkcji) ): ?>
                    <a href="<?= theme()->config()->options()->link_aplikuj_na_produkcji; ?>" class="button button-inverted"><?= __('PRACUJ NA PRODUKCJI'); ?></a>
                <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>
    <div class="container">
        <div class="pagination-row row justify-content-center">
            <nav class="pagination">
                <?php
                    $templateTags->pagination($jobOffers);
                ?>
            </nav>
        </div>  
    </div>
</main>

<?php
    get_footer();
?>