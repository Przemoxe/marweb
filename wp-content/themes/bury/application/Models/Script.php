<?php
namespace App\Models;

use App\Core\BaseModel;

/**
 * Script class
 */
class Script extends BaseModel
{
    public function getHeadScript()
    {
        $optionName = 'head_script';

        $postScript = get_field($optionName);

        if (empty($postScript))
        {
            $postScript = get_field($optionName, 'option');
        }

        return $postScript;
    }

    public function getBodyStartScript()
    {
        $optionName = 'body_start_script';

        $postScript = get_field($optionName);

        if (empty($postScript))
        {
            $postScript = get_field($optionName, 'option');
        }

        return $postScript;
    }

    public function getBodyEndScript()
    {
        $optionName = 'body_end_script';

        $postScript = get_field($optionName);

        if (empty($postScript))
        {
            $postScript = get_field($optionName, 'option');
        }

        return $postScript;
    }
}
