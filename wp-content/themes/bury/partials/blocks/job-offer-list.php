<?php if (!empty($offers)): ?>
    <div class="br-block job-offer-list">
        <div class="container">
            <div class="row section-header__container">
                <div class="col-md-12">
                    <?= partial('section-header', compact('title', 'link')) ?>
                </div>
            </div>
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
                            <?php $offers = array_reverse($offers)?>
                            <?php foreach ($offers as $count => $offer): ?>
                                <?php if($count < 4) : ?>
                                    <tr class="ae-select">
                                        <td>
                                            <table>
                                            <tr class="job-offer-list__row justify-content-between">
                                                <td class="job-offer-list__position"><?= $offer->post_title; ?></td>
                                                <td class="ae-select-arrow"></td>
                                            </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr class="job-offer-list__row nav flex-column ae-hide">
                                                <td class="job-offer-list__position"><?= $offer->post_title; ?></td>
                                                <td class="job-offer-list__city"><?= $offer->city; ?></td>
                                                <td class="job-offer-list__thumbnail"><?= get_the_post_thumbnail($offer->employee, [60, 60]) ?></td>
                                                <td class="job-offer-list__employee">
                                                    <div class="employee-name"><strong><?= $offer->employee->post_title ?></strong></div>
                                                    <div class="employee-position"><small><?= $offer->employee->position ?></small></div>
                                                </td>
                                                <?php if (!empty($writeToUsLink)): ?>
                                                <td class="job-offer-list__write-to-us">
                                                    <a href="<?= $writeToUsLink ?>"><?= $writeToUsDescription ?></a>
                                                </td>
                                                <?php endif; ?>
                                                <td class="job-offer-list__more">
                                                    <a href="<?= get_permalink($offer) ?>" class="button button-inverted"><?= __('Więcej', TEXT_DOMAIN) ?></a>
                                                </td>
                                    </tr>
                                    <tr class="space"><td colspan="6"></td></tr>
                                <?php else : break; ?>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>                   
                </div>
            </div>
            <div class="row job-offer-list__button-container">
                <div class="col-md-12">
                    <?= the_page_link($link, ['class' => 'button-inverted job-offer-list__button']) ?>
                </div>
            </div>
        </div>
    </div>
<?php elseif ($is_preview): ?>
    <?= __('Nie znaleziono ofert pracy', TEXT_DOMAIN) ?>
<?php endif; ?>