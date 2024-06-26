<?php get_header() ?>
<main class="article">

    <section class="top">
    <h1 class="std7"><?php post_type_archive_title(); ?></h1>
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
                <div class="flex">
                    <?php
                    $paged = ( get_query_var('paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;
                    if (isset($_GET['page'])) {
                        $paged = $_GET['page'];
                    }
                    ?>
                    <?php query_posts("post_type=article&posts_per_page=4&paged=".$paged); ?>
                    <?php $counter = 0;?> 
                    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                        <a href="<?php the_permalink(); ?>">
                            <?php if(has_post_thumbnail()): ?><?php the_post_thumbnail('index_thumbnail'); ?>
                            <?php else: ?>
                            <img src="<?php echo get_template_directory_uri(); ?>/img/noimage.webp" alt="">
                            <?php endif; ?>
                            <ul>
                                <li><?php the_time('Y/m/d') //2011-01-05(); ?></li>
                                <li><p class="std7"><?php the_title_attribute(); ?></p></li>
                            </ul>
                        </a>
                    <?php $counter++;?>
                    <?php endwhile; ?>
                    <!--ページャーの部分-->
                    <?php else: //もし、表示すべき記事がなかたら       ?>
                        <p class="no_page">まだ記事はありません。</p>
                        <?php endif;  //条件分岐終了 ?>
                </div>
                <div class="pagination">
                    <?php global $wp_rewrite;
                    $paginate_base = get_pagenum_link(1);
                    $paginate_format='';
                    if(strpos($paginate_base, '?') || ! $wp_rewrite->using_permalinks()){
                        $paginate_format = '';
                        $paginate_base = add_query_arg('paged','%#%');
                    }
                    else{
                        $paginate_format = (substr($paginate_base,-1,1) == '/' ? '' : '/') .
                            user_trailingslashit('page/%#%/','paged');
                        $paginate_base .= '%_%';
                    }
                    if(isset($_GET['page'])) {
                        $paged = $_GET['page'];
                    }
                    echo paginate_links(array(
                        'base' => esc_url(home_url('/article/?page=')).'%#%',
                        'total' => $wp_query->max_num_pages,
                        'show_all' => False,
                        'end_size' => 1,
                        'mid_size' => 2,
                        'current' => ($paged ? $paged : 1),
                        'prev_text' => 'Prev',
                        'next_text' => 'Next',
                    )); ?>
                </div>
                <?php wp_reset_query(); ?>
            </div>
            <div class="mini-container">
                <?php get_sidebar() ?>
            </div>
        </div>
    </section>
</main>
<?php get_footer() ?>