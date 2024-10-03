<?php

/**
 * Template Name: Custom Homepage
 * Template Post Type: post, page
 *
 * @package WordPress
 * @subpackage Atom Blog
 * @since Atom Blog 2.0
 */
?>

<?php
get_header();

get_template_part('include/body', 'header');
?>

<div class="homepage">
	<div class="home-top">
		<div class="home-slider">
			<div class="home-icon">
				<i class="fa-regular fa-face-grin-hearts"></i>
			</div>
			<h1 class="home-title">Building digital products, brands and websites.</h1>
			<a href="/blog" class="home-button">Read more</a>
		</div>

		<div class="home-skils">
			<div class="home-skil"><i class="fa-brands fa-php"></i></div>
			<div class="home-skil"><i class="fa-brands fa-laravel"></i></div>
			<div class="home-skil"><i class="fa-brands fa-vuejs"></i></div>
			<div class="home-skil"><i class="fa-brands fa-square-js"></i></div>
			<div class="home-skil"><i class="fa-brands fa-css3-alt"></i></div>
			<div class="home-skil"><i class="fa-brands fa-wordpress-simple"></i></div>
			<div class="home-skil"><i class="fa-brands fa-git"></i></div>
			<div class="home-skil"><i class="fa-brands fa-html5"></i></div>
		</div>
	</div>

	<div class="home-mid">
		<h2 class="home-h2-mid">Collaborate with brands and agencies to create impactfull results.</h2>

		<div class="home-subtitle">
			<span>Skills</span>
		</div>

		<div class="home-techology">
			<div class="home-item-tech">
				<i class="fa-solid fa-pen"></i>
				<h3>UX & UI</h3>
				<p>Lorem ipsum dolor, sit amet consectetur lacost oreso adipisicing elit.</p>
			</div>

			<div class="home-item-tech">
				<i class="fa-solid fa-tablet-screen-button"></i>
				<h3>Web & Mobile</h3>
				<p>Lorem ipsum dolor, sit lacost oreso amet consectetur adipisicing elit.</p>
			</div>

			<div class="home-item-tech">
				<i class="fa-solid fa-swatchbook"></i>
				<h3>Design</h3>
				<p>Lorem ipsum lacost oreso dolor, sit amet consectetur adipisicing elit.</p>
			</div>

			<div class="home-item-tech">
				<i class="fa-solid fa-rocket"></i>
				<h3>Development</h3>
				<p>Lorem ipsum dolor, sit amet consectetur adipisicing lacost oreso elit.</p>
			</div>
		</div>
	</div>

	<div class="home-bot">
		<div class="home-icon home-icon-dark">
			<i class="fa-regular fa-handshake"></i>
		</div>
		<h2 class="home-h2-bot">Tell me about Your next project</h2>
		<a href="/contact-us" class="home-button">Write Message</a>
	</div>
</div>

<?php
get_template_part('include/body', 'footer');

get_footer();
?>