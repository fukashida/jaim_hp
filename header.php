<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head prefix="og:http://ogp.me/ns#">
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="discription" content="<?php bloginfo('discription'); ?>">
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css"/>
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.css">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/select2.min.css" type="text/css">
    <link rel="stylesheet" href="<?php echo esc_url( get_template_directory_uri() ); ?>/style.css">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo esc_url( get_template_directory_uri() ); ?>/favicon_package_v0.16/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo esc_url( get_template_directory_uri() ); ?>/favicon_package_v0.16/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo esc_url( get_template_directory_uri() ); ?>/favicon_package_v0.16/favicon-16x16.png">
    <link rel="manifest" href="<?php echo esc_url( get_template_directory_uri() ); ?>/favicon_package_v0.16/site.webmanifest">
    <link rel="mask-icon" href="<?php echo esc_url( get_template_directory_uri() ); ?>/favicon_package_v0.16/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="theme-color" content="#ffffff">
    <title><?php 
            if (is_home()) {
                echo '一般社団法人日本美容内科学会';
            } elseif (is_page()) {
                echo the_title_attribute();
            } elseif (is_category()) {
                echo post_type_archive_title();
            } elseif (is_archive()) {
                echo post_type_archive_title();
            }
        ?></title>
    <meta name="description" content="<?php 
            if (is_home()) {
                echo '日本美容内科学会（JAIM）は、美容内科という分野を明確にしつつ、本来、内科が大切にしてきたEBMに基づく真に効果的で安全な美容内科医療を構築していくことを目的としています。';
            } elseif (is_page('organization')) {
                echo '日本美容内科学会（JAIM）の組織概要です。当学会は今後、学会会員全員で学問的な議論を活発に行い、美容医療領域における美容内科の普及に全力で努めていきます。';
            } elseif (is_page('guidance')) {
                echo '日本美容内科学会（JAIM）の入会案内です。各会員の会費、入会方法等はこちらからご確認いただけます。';
            } elseif (is_page('inquiry')) {
                echo '日本美容内科学会（JAIM）のお問い合わせ窓口です。当学会に関するご相談・理事など、当学会に関してお気付きの点がございましたらお問い合わせください。';
            } elseif (is_page('joining')) {
                echo '日本美容内科学会（JAIM）の入会フォームです。当学会へのご入会は、こちらからお願い致します。';
            } elseif (is_archive('article')) {
                echo '日本美容内科学会（JAIM）の活動事例です。過去の活動事例は、こちらからご確認いただけます。';
            }
        ?>" >
    <meta property="og:title" content="日本美容内科学会（JAIM）">
    <meta property="og:description" content="'日本美容内科学会（JAIM）は、美容内科という分野を明確にしつつ、本来、内科が大切にしてきたEBMに基づく真に効果的で安全な美容内科医療を構築していくことを目的としています。'">
    <meta property="og:url" content="https://jaim2023.com/">
    <meta property="og:image" content="https://jaim2023.com/ogp/">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="一般社団法人日本美容内科学会">
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
    <header>
        <div class="left">
            <a href="<?php echo esc_url(home_url()); ?>">
                <img src="<?php echo esc_url(get_template_directory_uri()); ?>/img/logo.webp" alt="一般社団法人日本美容内科学会ロゴ">
            </a>
            <h1 class="std5">
                <span class="std7">一般社団法人</span>日本美容内科学会
            </h1>
        </div>
        <nav class="spnone">
            <ul class="std5">
                <li><a href="<?php echo esc_url(home_url('organization')); ?>">組織概要</a></li>
                <li><a href="<?php echo esc_url(home_url('article')); ?>">活動事例</a></li>
                <li><a href="<?php echo esc_url(home_url('guidance')); ?>">入会案内</a></li>
                <li><a href="<?php echo esc_url(home_url('inquiry')); ?>">お問い合わせ</a></li>
            </ul>
        </nav>
        <div class="sp">
            <div id="openbtn1">
                <span></span>
                <span></span>
                <span></span>
            </div>
            <div id="nav-bg"></div>
            <nav id="g-nav">
            <div class="g-nav-list">
            <ul class="std5">
                <li><a href="<?php echo esc_url(home_url('organization')); ?>">組織概要</a></li>
                <li><a href="<?php echo esc_url(home_url('article')); ?>">活動事例</a></li>
                <li><a href="<?php echo esc_url(home_url('guidance')); ?>">入会案内</a></li>
                <li><a href="<?php echo esc_url(home_url('inquiry')); ?>">お問い合わせ</a></li>
            </ul>
          </div>
    </header>
