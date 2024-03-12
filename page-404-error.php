<?php get_header() ?>
<main class="single article">
    <section class="about">
        <div class="container">
            <div class="sub-container error">
                <?php if (have_posts()) :
                while (have_posts()) : the_post(); ?>
                <article>
                    <h1 class="std7"><?php the_title_attribute(); ?></h1>
                    <div class="content">
                    <ul>
                        <li><a href="<?php echo esc_url(home_url('/')); ?>">HOME</a></li>
                        <li><a href="<?php echo esc_url(home_url('organization')); ?>">組織概要</a></li>
                        <li><a href="<?php echo esc_url(home_url('article')); ?>">活動事例</a></li>
                        <li><a href="<?php echo esc_url(home_url('guidance')); ?>">入会案内</a></li>
                        <li><a href="<?php echo esc_url(home_url('inquiry')); ?>">お問い合わせ</a></li>
                    </ul>
                    </div>
                </article>
                <?php endwhile; endif;?>
            </div>
        </div>
    </section>
</main>
<?php get_footer() ?>