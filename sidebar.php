<div class="back">
    <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/img/logo-2.webp" alt="一般社団法人日本美容内科学会ロゴ">
    <p class="std5"><span>一般社団法人 </span><br>日本美容内科学会</p>
    <p class="access">〒104-0061 <br>
        東京都中央区銀座1-12-4N&E BLD.7階</p>
    <div class="box">
        <p class="ntc">お知らせ</p>
        <?php query_posts("post_type=notice"); ?>
        <?php if(have_posts()): while(have_posts()): the_post(); ?>
        <a href="<?php the_permalink(); ?>">
            <ul>
                <li><time datetime="<?php echo get_the_date('Y-m-d'); ?>"><?php echo get_the_date(); ?></li>
                <li><p class="title"><?php the_title_attribute(); ?></p></li>
            </ul>
        </a>
        <?php endwhile; ?>
        <?php else: //もし、表示すべき記事がなかたら       ?>
            <p class="no_page">お知らせ記事はありません。</p>
        <?php endif; //条件分岐終了 ?>
    </div>
    <a target="_blank" class="button" href="https://lin.ee/tMc4HRi">公式LINEはこちら</a>
</div>