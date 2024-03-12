<?php get_header() ?>
<main class="law">
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
        <div class="sub-container">
            <table>
                <tr>
                    <th>販売事業者名</th>
                    <td>一般社団法人日本美容内科学会</td>
                </tr>
                <tr>
                    <th>運営責任者名</th>
                    <td>伊藤　明子(イトウアキコ)</td>
                </tr>
                <tr>
                    <th>所在地</th>
                    <td>〒104-0061 <br>
                        東京都中央区銀座1-12-4 <br class="sp">N&E BLD. 7階</td>
                </tr>
                <tr>
                    <th>問い合わせ先</th>
                    <td>090-3813-7241</td>
                </tr>
                <tr>
                    <th>メールアドレス</th>
                    <td>ask@jaim2023.com</td>
                </tr>
                <tr>
                    <th>HPアドレス</th>
                    <td><a href="http://jaim2023.com/" target="_blank">http://jaim2023.com/</a></td>
                </tr>
                <tr>
                    <th>キャンセル・<br class="sp">返金</th>
                    <td>決済後のキャンセル・返金は受付できません。</td>
                </tr>
                <tr>
                    <th>お支払い方法</th>
                    <td>クレジットカード決済</td>
                </tr>
                <tr>
                    <th>販売価格<br>(代金・利用料)</th>
                    <td>お申込ページに料金を各々記載しています</td>
                </tr>
                <tr>
                    <th>商品の<br class="sp">利用可能時期</th>
                    <td>年会費の場合決済後１年間</td>
                </tr>
                <tr>
                    <th>申込の有効期限・<br>お支払い期限</th>
                    <td>決済期限と同じ</td>
                </tr>
                <tr>
                    <th>サービスの<br class="sp">停止について</th>
                    <td>何らかの理由により、システムダウンしサービスが利用できない場合があります。その際、システムの普及にお時間をいただくことがございます。</td>
                </tr>
                <tr>
                    <th>推奨ソフトウェア環境</th>
                    <td>OSの種類: <br class="sp">Windows、macOS、Linux<br>
                        CPUの種類: Intel、AMD<br>
                        メモリの容量: 8GB以上<br>
                        ハードディスクの空き容量: <br class="sp">256GB以上のSSD</td>
                </tr>
                <tr>
                    <th>屋号・サービス名</th>
                    <td>日本美容内科学会</td>
                </tr>
            </table>
        </div>
    </section>
</main>
<?php get_footer(); ?>