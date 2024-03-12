<?php get_header() ?>
<main class="single article">

    <section class="top">
    <h1 class="std7">活動事例</h1>
    </section>
    <div class="breadcrumbs" typeof="BreadcrumbList" vocab="https://schema.org/">
        <div class="container">
            <?php if(function_exists('bcn_display'))
            {
                bcn_display();
            }?>
        </div>
    </div>
    <section class="about">
        <div class="container">
            <div class="sub-container">
                <?php if (have_posts()) :
                while (have_posts()) : the_post(); ?>
                <article>
                    <?php if(has_post_thumbnail()): ?><?php the_post_thumbnail('index_thumbnail'); ?>
                        <?php else: ?>
                            <img src="<?php echo get_template_directory_uri(); ?>/img/noimage.webp" alt="">
                        <?php endif; ?>
                        <h1 class="std7"><?php the_title_attribute(); ?></h1>
                    <div class="content">
                        <?php the_content(); ?>
                    </div>
                </article>
                <?php endwhile; endif;?>
            </div>
            <div class="mini-container">
                <?php get_sidebar() ?>
            </div>
        </div>
    </section>
</main>
<?php get_footer() ?>