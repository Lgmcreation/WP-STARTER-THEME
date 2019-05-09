<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<!--[if IE]>
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<![endif]-->
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
<meta name="format-detection" content="telephone=no" />
<link rel="shortcut icon" type="image/x-icon" href="/favicon.ico" />
<!--[if lt IE 9]>
<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<?php wp_head();?>
</head>
<body <?php body_class(); ?>>
<header role="banner">
<div class="skipnav">
    <a href="#site_content" class="visuallyhidden" aria-controls="site_content">Aller au contenu principal </a>
</div>
<button id="burger" class="burger" aria-label="Déplier le menu de navigation"><span>Menu</span></button>
<div class="wrapper main-menu">
    <a href="<?= home_url(); ?>" class="logo">Logo</a>
    <nav id="site-navigation" class="main-navigation" role="navigation">
    <?php wp_nav_menu( array(
        'theme_location' => 'main-menu',
        'container' => '',
        'menu_class' => '',
        'menu_id' => '',
        'container_id' => '',
        'items_wrap' => '<ul>%3$s</ul>'
    )); ?>
    </nav>
</div>
</header>
<main class="site_content" role="main" id="site_content">

