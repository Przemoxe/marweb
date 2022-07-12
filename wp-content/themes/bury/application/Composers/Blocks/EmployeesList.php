<?php

namespace App\Composers\Blocks;

use App\Core\BaseBlock;

/**
 * EmployeesList class
 */
class EmployeesList extends BaseBlock
{
    /**
    * Rejestracja bloczka
    */
    public function register(): array
    {
        return array(
            'name'              => 'employees-list',
            'title'             => __('Pracownicy', TEXT_DOMAIN),
            'description'       => __('Pracownicy', TEXT_DOMAIN),
            'category'          => TEXT_DOMAIN,
            'icon'              => 'groups',
            'mode'              => 'preview',
            'align'             => false,
        );
    }

    public function renderFront( $block, $content = '', $is_preview = false, $post_id = 0 ): void
    {
        $employeeIds = get_field('employees');
        if (empty($employeeIds))
        {
            return;
        }
        $employees = theme()->employeeModel()->getByIds($employeeIds)->posts;

        partial('blocks/employees-list', compact('employees', 'is_preview'));
    }
}
