<?php
/**
 * The header for Astra Theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Astra
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

?><!DOCTYPE html>
<?php astra_html_before(); ?>
<html <?php language_attributes(); ?>>
<head>
<?php astra_head_top(); ?>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php 
if ( apply_filters( 'astra_header_profile_gmpg_link', true ) ) {
	?>
	 <link rel="profile" href="https://gmpg.org/xfn/11"> 
	 <?php
} 
?>
<style>
.footer_div .menu-link{
	margin-bottom: 20px;
}
.footer_div div,.footer_div a,.footer_div p{
	font-size: 18px !important;
    line-height: 1.5 !important;
    font-weight: 400 !important;
}
	.footer_div .menu-link{
		font-weight: 600 !important;
		color:white !important;
		 
	}

	.widget55 .elementor-column{
		background-color: #0c1e60;
		border-radius: 24px;
		margin-left:10px;
	}
	.elementor a{
		color:white;
	}
	.footer-width-fixer .elementor-container {
		width: 90% !important;
		max-width: 90% !important;
	}
	.flatpickr-calendar{display: none;}

	@media (max-width: 599px) {
		#main_menu_primary .custom-button1 a{
			padding-left:90px;
			padding-right:90px;
			fill: #FFFFFF;
			color: #FFFFFF;
			border-color:white;
			background-color: transparent;
			border-style: solid; 
			border-width: 2px 2px 2px 2px;
			border-radius: 32px 32px 32px 32px;

		}

		#main_menu_primary .custom-button2 a{
			padding-left:90px;
			padding-right:90px;
			margin-top:5px;
			margin-bottom:5px;
			color: #FFFFFF;
			background-color: #0285CE;
			border-style: solid;  
			border-width: 2px 2px 2px 2px;
			border-radius: 32px 32px 32px 32px; 
		}
	}
 
	#main_menu_primary .hfe-nav-menu-icon i{
	color:white;
	}
	#main_menu_primary li{
		border-bottom-color: #010b30;
	}

	#main_menu_primary   .hfe-nav-menu__layout-horizontal .hfe-nav-menu > li.menu-item{
		margin-right: 20px;
	}

	.custom-button1 a{
		fill: #FFFFFF;
		color: #FFFFFF;
		border-color:white;
		background-color: transparent;
		border-style: solid; 
		border-width: 2px 2px 2px 2px;
		border-radius: 32px 32px 32px 32px;
		
	}

	.custom-button1{
		padding-left:50px;
		padding-right:50px;
	}

	.custom-button2 a{
		color: #FFFFFF;
		background-color: #0285CE;
		border-style: solid;  
		border-width: 2px 2px 2px 2px;
		border-radius: 32px 32px 32px 32px; 
	}

	.custom-button2{
		padding-left:50px;
		padding-right:50px;
	}

	@media (max-width:1000px){
		.custom-button1{
			margin-left:5px;
		}
		.custom-button2{
			margin-left:5px;
		}
	}
   
	
</style>
<?php wp_head(); ?>
<?php astra_head_bottom(); ?>
</head>

<body <?php astra_schema_body(); ?> <?php body_class(); ?>>
<?php astra_body_top(); ?>
<?php wp_body_open(); ?>

<a
	class="skip-link screen-reader-text"
	href="#content"
	title="<?php echo esc_attr( astra_default_strings( 'string-header-skip-link', false ) ); ?>">
		<?php echo esc_html( astra_default_strings( 'string-header-skip-link', false ) ); ?>
</a>

<div
<?php
	echo astra_attr(
		'site',
		array(
			'id'    => 'page',
			'class' => 'hfeed site',
		)
	);
	?>
> 
	<?php
	astra_header_before();

	astra_header();
 
	astra_header_after();
	 
	astra_content_before();
	 
	?>
	<div id="content" class="site-content">
		<div class="ast-container">
			 
		<?php astra_content_top(); ?>
