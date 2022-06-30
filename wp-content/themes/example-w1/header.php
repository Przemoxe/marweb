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
	<div class="nav-top <?= !is_front_page() ? 'nav-top-not-front' : '' ?>">
		<div class="main-container-px20 nav-container">
			<div>
				<a href="<?= get_home_url() ?>">
					elCode.pl
				</a>
				<a href=""></a>
				<a href=""></a>
				<a href=""></a>

			</div>
			<div class="change-color-container">
				<div class="color-icon ">
					<i class="fa fa-sun-o" aria-hidden="true"></i>
					<i class="fa fa-moon-o " aria-hidden="true"></i>
				</div>
			</div>
			<?php

			wp_nav_menu([
				'theme_location'    => 'main-menu',
				'menu_id'        	=> 'main-menu',
				'container_class'   => 'main-menu',
			]);
			wp_nav_menu([
				'theme_location'    => 'language-menu',
				'menu_id'        	=> 'language-menu',
				'container_class'   => 'language-menu',
			]);

			?>
		</div>
	</div>

	<div class="nav-top-mobile <?= !is_front_page() ? 'nav-top-not-front-mobile' : '' ?>">
		<div class="main-container-px20">
			<div class="nav-mobile">
				<div class="nav-logo">
					<a href="<?= get_home_url() ?>">
						MarWeb.pl
					</a>
					<div class="change-color-container">
						<div class="color-icon color-icon-mobile">
							<i class="fa fa-sun-o" aria-hidden="true"></i>
							<i class="fa fa-moon-o " aria-hidden="true"></i>
						</div>
					</div>
				</div>
				<div class="nav-hamburger">
					<i class="fa fa-bars" aria-hidden="true"></i>
				</div>
				<div class="nav-lists">
					<?php

					wp_nav_menu([
						'theme_location'    => 'main-menu',
						'menu_id'        	=> 'mobile-main-menu',
						'container_class'   => 'mobile-main-menu',
					]);
					wp_nav_menu([
						'theme_location'    => 'language-menu',
						'menu_id'        	=> 'language-menu',
						'container_class'   => 'language-menu',
					]);

					?>
				</div>
			</div>

		</div>
	</div>