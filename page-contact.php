<?php
/*
Template Name: Page Contact
*/
?>
<?php get_header(); ?>
<section role="main">
  <?php if(have_posts()) : while(have_posts()) : the_post(); ?>
    <h1><?php the_title(); ?></h1>
    <?php the_content(); ?>
 <?php endwhile; endif; wp_reset_query(); ?>
 <?php if(get_field('infos_adresse','option')) { ?>
    <span id="infos_adresse"><?= get_field('infos_adresse','option');  ?></span>
    <?php } ?>
   <?php if(get_field('infos_codepostal','option')) { ?>
    <span id="infos_codepostal"><?= get_field('infos_codepostal','option');  ?> <?= get_field('infos_ville','option');   ?></span>
    <?php } ?>
   <?php if(get_field('infos_telephone','option')) { ?><span>Tél : <?= get_field('infos_telephone','option'); ?></span><?php } ?>
  <?php if(get_field('infos_fax','option')) { ?><span>Fax : <?= get_field('infos_fax','option'); ?></span> <?php } ?>
   <?php if(get_field('infos_email','option')) { ?><span>Email : <?= antispambot(get_field('infos_email','option')); ?></span><?php } ?>
    <div id="map-canvas"></div>
</section>
<?php get_footer(); ?>
