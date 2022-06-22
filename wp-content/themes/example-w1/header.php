<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Nineteen
 * @since Twenty Nineteen 1.0
 */
?>
<!doctype html>
<html>

<head>
	<meta charset="" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="profile" href="https://gmpg.org/xfn/11" />
	<?php wp_head(); ?>
</head>

<body>
	<div class=" nav-top <?= !is_front_page() ? 'nav-top-not-front' : '' ?>">
		<div class="main-container-px20 nav-container">
			<div>
				<a href="<?= get_home_url() ?>">
					LOGO
				</a>
				<a href=""></a>
				<a href=""></a>
				<a href=""></a>
			</div>
			<?php

			wp_nav_menu([
				'theme_location'    => 'main-menu',
				'menu_id'        	=> 'main-menu',
				'container_class'   => 'main-menu',

				// 'after'             => '</div><button class="more"></button>'
				
			]);
			?>
		</div>
	</div>

