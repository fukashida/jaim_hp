<?php get_header() ?>
<main class="guidance">

    <section class="top">
    <h1 class="std7"><?php the_title_attribute(); ?></h1>
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
                <h2 class="std7">会員の種類</h2>
                <ul class="type">
                    <li><p class="std7">正会員A</p><p>…</p><p>医師 / 歯科医師</p></li>
                    <li><p class="std7">正会員B</p><p>…</p><p>国家資格を有する医療従事者・<br>
                    本学会の目的に賛同する施設及び企業等に所属する研究者</p></li>
                    <li><p class="std7">一般会員</p><p>…</p><p>理事2名の推薦を得られた健康・美容業界の方</p></li>
                    <li><p class="std7">学生会員</p><p>…</p><p>上記資格に関わる分野の大学、専門学校に在籍中の学生の方</p></li>
                    <li><p class="std7">賛助会員</p><p>…</p><p>本学会に賛同する一般企業及び医療施設等</p></li>
                    <li><p class="std7">特別賛助会員</p><p>…</p><p class="wide">本学会に賛同する一般企業および医療施設等</p></li>
                </ul>
                <h2 class="n2 std7">会員特典</h2>
                <div class="box">
                    <p class="std7">賛助会員</p>
                    <ul>
                        <li>学会が発行するニュースレター・フライヤー(不定期)に法人名やリンクを掲載</li>
                        <li>学会イベント、セミナー参加費割引及び優先案内</li>
                    </ul>
                </div>
                <div class="box">
                    <p class="std7">特別賛助会員</p>
                    <ul>
                        <li>本学会委員との特別対談と<br class="sp">コラムをホームページに掲載</li>
                        <li>本学会ホームページに<br class="sp">法人名・ロゴ・バナーを掲載</li>
                        <li>本学会イベント・セミナーで<br class="sp">研究発表する権利</li>
                        <li>学会が発行するニュースレター・<br class="sp">フライヤー(不定期)に<br class="sp">法人名やリンクを掲載</li>
                        <li>学会イベント、セミナー参加費<br class="sp">割引及び優先案内</li>
                    </ul>
                </div>
                <h2 class="std7">会費</h2>
                <div class="flex">
                    <div class="box">
                        <p class="std7">正会員A</p>
                        <div class="item">
                            <p class="content">入会金</p>
                            <p class="std5">5,000<span>円</span></p>
                        </div>
                        <div class="item">
                            <p class="content">年会費</p>
                            <p class="std5">10,000<span>円</span></p>
                        </div>
                    </div>
                    <div class="box">
                    <p class="std7">正会員B</p>
                        <div class="item">
                            <p class="content">入会金</p>
                            <p class="std5">5,000<span>円</span></p>
                        </div>
                        <div class="item">
                            <p class="content">年会費</p>
                            <p class="std5">8,000<span>円</span></p>
                        </div>
                    </div>
                    <div class="box">
                    <p class="std7">一般会員</p>
                        <div class="item">
                            <p class="content">入会金</p>
                            <p class="std5">5,000<span>円</span></p>
                        </div>
                        <div class="item">
                            <p class="content">年会費</p>
                            <p class="std5">5,000<span>円</span></p>
                        </div>
                    </div>
                    <div class="box">
                    <p class="std7">学生会員</p>
                        <div class="item">
                            <p class="content">入会金</p>
                            <p class="std5">免除</p>
                        </div>
                        <div class="item">
                            <p class="content">年会費</p>
                            <p class="std5">5,000<span>円</span></p>
                        </div>
                    </div>
                    <div class="box">
                        <p class="std7">賛助会員</p>
                        <div class="item">
                            <p class="content">入会金</p>
                            <p class="std5">100,000<span>円</span></p>
                        </div>
                        <div class="item">
                            <p class="content">年会費</p>
                            <p class="std5">100,000<span>円</span></p>
                        </div>
                    </div>
                    <div class="box">
                        <p class="std7">特別賛助会員</p>
                        <div class="item">
                            <p class="content">入会金</p>
                            <p class="std5">300,000<span>円</span></p>
                        </div>
                        <div class="item">
                            <p class="content">年会費</p>
                            <p class="std5">300,000<span>円</span></p>
                        </div>
                    </div>
                </div>
                <p class="as02">年会費は自動更新され、<br class="sp">毎年入会月に自動決済が行われます</p>
                <a class="button" target="_blank" href="<?php echo esc_url(home_url('joining')); ?>">入会ページに進む</a>
            </div>
            <div class="mini-container">
                <?php get_sidebar(); ?>
            </div>
        </div>
    </section>
</main>
<?php get_footer() ?>