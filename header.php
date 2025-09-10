<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="author" content="Evgenii Zhirnov (jirnov@gmail.com)">
<meta name="mailru-domain" content="dGc1lnWu41fTfKFo">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="icon" type="image/x-icon" href="/favicon.ico" >
<link rel="author" href="/about" >
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div class="header">
<nav class="menu">
<?php wp_nav_menu(array(
    'theme_location' => 'header-menu',
    'container_class' => 'header-menu',
    'container_id' => 'header-menu'
)); ?>
</nav> <!-- menu --!>
</div> <!-- header --!>
<?php wp_body_open(); ?>
<div id="page" class="site">
    <div id="content" class="site-content grid grid--bleed-lg">
