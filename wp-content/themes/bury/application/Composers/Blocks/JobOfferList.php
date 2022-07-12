<?php

namespace App\Composers\Blocks;

use App\Core\BaseBlock;

/**
 * JobOfferList class
 */
class JobOfferList extends BaseBlock
{
    /**
    * Rejestracja bloczka
    */
    public function register(): array
    {
        return array(
            'name'              => 'job-offer-list',
            'title'             => __('Oferty pracy', TEXT_DOMAIN),
            'description'       => __('Oferty pracy', TEXT_DOMAIN),
            'category'          => TEXT_DOMAIN,
            'icon'              => 'welcome-widgets-menus',
            'mode'              => 'preview',
            'align'             => false,
        );
    }

    public function renderFront( $block, $content = '', $is_preview = false, $post_id = 0 ): void
    {
        $writeToUsLink = array_get(theme()->config()->customPostOptions('job_offers'), 'write_to_us_link');
        $writeToUsDescription = array_get(theme()->config()->customPostOptions('job_offers'), 'write_to_us_description');
        $title = get_field('header_title');
        $link = get_field('header_link');
        $offers = theme()->jobOfferModel()->getAllPublished(['before_deactivation_date' => true], 4)->posts;
        $offers = array_filter($offers, function ($post) {
            return !empty($post->employee);
        });
        if (empty($link))
        {
            $link = [
                'url'   => get_post_type_archive_link('job_offers'),
                'title' => __('Wszystkie', TEXT_DOMAIN)
            ];
        }
        partial('blocks/job-offer-list', compact('offers', 'title', 'link', 'is_preview', 'writeToUsLink', 'writeToUsDescription'));
    }
}
