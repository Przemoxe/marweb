<?php

namespace App\Composers\Blocks;

use App\Core\BaseBlock;

/**
 * ContactForm7 class
 */
class ContactForm7 extends BaseBlock
{
    /**
    * Rejestracja bloczka
    */
    public function register(): array
    {
        return array(
            'name'              => 'contact-form-7',
            'title'             => __('Formularz (CF7)', TEXT_DOMAIN),
            'description'       => __('Formularz (CF7)', TEXT_DOMAIN),
            'category'          => TEXT_DOMAIN,
            'icon'              => 'email'
        );
    }

    public function renderFront( $block, $content = '', $is_preview = false, $post_id = 0 ): void
    {
        $formId = get_field('cf7_form') ?: null;
        $formShortcode = '';
        $image = '';
        if (function_exists('wpcf7_contact_form'))
        {
            $form = wpcf7_contact_form($formId);
            if (!empty($form))
            {
                $formShortcode = '[contact-form-7 id="'.$form->id().' title="'.$form->title().'"]';
            }
            $image = get_field('image');

            if (!empty($image))
            {
                $image = wp_get_attachment_image($image, 'full');
            }
        }

        partial('blocks/contact-form-7', compact('formShortcode', 'image', 'is_preview'));
    }
}
