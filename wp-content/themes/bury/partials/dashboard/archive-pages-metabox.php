<div id="posttype-archive-pages" class="posttypediv">
    <div id="tabs-panel-archive-pages" class="tabs-panel tabs-panel-active">
        <?php if ($post_types): ?>
        <p><?= __('Będą one prowadzić użytkowników bezpośrednio do archiwów typów postów', TEXT_DOMAIN) ?></p>
            <ul id="archive-pages" class="categorychecklist form-no-clear">
                <!--Custom -->
                <?php
                $counter = -1; //negative index to match WP
                foreach($post_types as $post_type):
                    $post_type_obj = get_post_type_object($post_type);
                    $post_type_archive_url = get_post_type_archive_link($post_type);
                    $post_type_name = $post_type_obj->labels->singular_name;
                    ?>
                    <li>
                        <label class="menu-item-title">
                            <input type="checkbox" class="menu-item-checkbox" name="menu-item[<?php echo $counter; ?>][menu-item-object-id]" value="<?= $post_type ?>"/><?php echo $post_type_name; ?>
                        </label>
                        <input type="hidden" class="menu-item-type" name="menu-item[<?php echo $counter; ?>][menu-item-type]" value="<?= $post_type ?>"/>
                        <input type="hidden" class="menu-item-type" name="menu-item[<?php echo $counter; ?>][menu-item-object]" value="post_type_archive"/>
                        <input type="hidden" class="menu-item-title" name="menu-item[<?php echo $counter; ?>][menu-item-title]" value="<?php echo $post_type_name; ?>"/>
                        <input type="hidden" class="menu-item-url" name="menu-item[<?php echo $counter; ?>][menu-item-url]"/>
                        <input type="hidden" class="menu-item-classes" name="menu-item[<?php echo $counter; ?>][menu-item-classes]"/>
                    </li>
                    <?php
                    $counter--;
                endforeach; ?>
            </ul>
        <?php else : ?>
            <p><?= __('Nie znaleziono typów postów z archiwum.', TEXT_DOMAIN) ?></p>
        <?php endif; ?>
    </div>

    <p class="button-controls">
        <span class="add-to-menu">
            <input type="submit" class="button-secondary submit-add-to-menu right" value="<?php _e('Add to Menu') ?>" name="add-post-type-menu-item" id="submit-posttype-archive-pages">
            <span class="spinner"></span>
        </span>
    </p>
</div>