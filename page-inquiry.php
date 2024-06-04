<head>
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo esc_url( get_template_directory_uri() ); ?>/favicon_package_v0.16/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo esc_url( get_template_directory_uri() ); ?>/favicon_package_v0.16/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo esc_url( get_template_directory_uri() ); ?>/favicon_package_v0.16/favicon-16x16.png">
    <link rel="manifest" href="<?php echo esc_url( get_template_directory_uri() ); ?>/favicon_package_v0.16/site.webmanifest">
    <link rel="mask-icon" href="<?php echo esc_url( get_template_directory_uri() ); ?>/favicon_package_v0.16/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="theme-color" content="#ffffff">
</head>

<div style="display:none">
<?php
// var_dump($_POST);

// 変数の初期化
$page_flag = 0;
$clean = array();

// サニタイズ
if( !empty($_POST) ) {
	foreach( $_POST as $key => $value ) {
		$clean[$key] = htmlspecialchars( $value, ENT_QUOTES);
	}
}

if( !empty($_POST['btn_confirm']) ) {

    $error = validation($clean);

	if( empty($error) ) {
		$page_flag = 1;

        // セッションの書き込み
		session_start();
		$_SESSION['page'] = true;
	}

} elseif( !empty($_POST['btn_submit']) ) {

    session_start();
	if( !empty($_SESSION['page']) && $_SESSION['page'] === true ) {

		// セッションの削除
		unset($_SESSION['page']);

	$page_flag = 2;

    if(count($_POST)){
        $url = 'https://script.google.com/macros/s/AKfycbw-eaywYh8YztpyglIAfa_ZXbvOZqaiIAJTBGexxVbCyKetBYWFL0-IyGoKG7oolnR72Q/exec';
        $data = array(
            'iyour_name' => $_POST['iyour_name'],
            'ihurigana' => $_POST['ihurigana'],
            'iemail' => $_POST['iemail'],
            'imessage' => $_POST['imessage'],
        );
        $context = array(
            'http' => array(
                'method'  => 'POST',
                'header'  => implode("\r\n", array('Content-Type: application/x-www-form-urlencoded',)),
                'content' => http_build_query($data)
            )
        );
        $response_json = file_get_contents($url, false, stream_context_create($context));
        $response_data = json_decode($response_json);
        var_dump($response_data);
    }

    } else {
        $page_flag = 0;
    }
}

function validation($data) {

	$error = array();

	// 名前のバリデーション
	if( empty($data['iyour_name']) ) {
		$error[] = "「お名前」は必ず入力してください。";
	}
    	// フリガナのバリデーション
	if( empty($data['ihurigana']) ) {
		$error[] = "「フリガナ」は必ず入力してください。";
	} elseif(!preg_match("/^[　ア-ン゛゜ァ-ォャ-ョー]+$/u", $data['ihurigana'])) {
		$error[] = "全角カタカナで入力してください。";
    }

	// メールアドレスのバリデーション
	if( empty($data['iemail']) ) {
		$error[] = "「メールアドレス」は必ず入力してください。";
	}  elseif( !preg_match( '/^[0-9a-z_.\/?-]+@([0-9a-z-]+\.)+[0-9a-z-]+$/', $data['iemail']) ) {
		$error[] = "「メールアドレス」は正しい形式で入力してください。";
	}

	// お問い合わせ内容のバリデーション
	if( empty($data['imessage']) ) {
		$error[] = "「お問い合わせ内容」は必ず入力してください。";
	}

	return $error;
}

?>

</div>


    <?php if( $page_flag === 1 ): ?>
    <?php get_header(); ?>

    <!-- ここに確認ページが入る -->
    
    <main class="inquiry">

        <div class="breadcrumbs confirm" typeof="BreadcrumbList" vocab="https://schema.org/">
            <div class="container">
                <?php if(function_exists('bcn_display'))
                {
                    bcn_display();
                }?>
            </div>
        </div>

        <section class="about confirm">
            <div class="container">
                <div class="sub-container">

                    <h2 class="confirm">入力内容の確認</h2>

                    <form method="post" action="" class="confirm">
                        <div class="element_wrap">
                            <label>氏名</label>
                            <p><?php echo $_POST['iyour_name']; ?></p>
                        </div>
                        <div class="element_wrap">
                            <label>フリガナ</label>
                            <p><?php echo $_POST['ihurigana']; ?></p>
                        </div>
                        <div class="element_wrap">
                            <label>メールアドレス</label>
                            <p><?php echo $_POST['iemail']; ?></p>
                        </div>
                        <div class="element_wrap message">
                            <label>お問い合わせ内容</label>
                            <p><?php echo $_POST['imessage']; ?></p>
                        </div>
                        <div class="submit-flex">
                            <div class="button">
                                <input class="btn_back" type="button" name="btn_back" value="戻る" onclick="history.back()">
                            </div>
                            <div class="btn_submit b2">
                                <input type="submit" name="btn_submit" value="入力項目を送信">
                            </div>
                        </div>
                        <input type="hidden" name="iyour_name" value="<?php echo $_POST['iyour_name']; ?>">
                        <input type="hidden" name="ihurigana" value="<?php echo $_POST['ihurigana']; ?>">
                        <input type="hidden" name="iemail" value="<?php echo $_POST['iemail']; ?>">
                        <input type="hidden" name="imessage" value="<?php echo $_POST['imessage']; ?>">
                    </form>

                </div>
            </div>
        </section>

    </main>

    <!-- ここまで確認ページが入る -->

    <?php elseif( $page_flag === 2 ): ?>
    <?php get_header(); ?>

    <div class="breadcrumbs complete" typeof="BreadcrumbList" vocab="https://schema.org/">
        <div class="container">
            <?php if(function_exists('bcn_display'))
            {
                bcn_display();
            }?>
        </div>
    </div>

    <section class="complete">
        <div class="container">
            <div class="sub-container">
                <h2 class="std7">入力内容を送信しました</h2>
                <p>お問い合わせありがとうございました。<br>
                    入力内容を受付いたしました。<br>
                    <br>
                    改めて、担当より<br class="sp">ご連絡をさせていただきます。<br>
                    <br>
                    なお、担当者が不在の場合や<br class="sp">内容によりましては、<br>
                    すぐにご回答が難しいこともございますので、あらかじめご了承ください。
                </p>
                <a class="button" href="<?php echo esc_url(home_url('/')); ?>">HOMEへ戻る</a>
            </div>
        </div>
    </section>

    <!-- ここに問い合わせページが入る -->

    <?php else: ?>
    <?php get_header(); ?>
    <main class="inquiry">

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

        <section class="about inquiry">
            <div class="container">
                <div class="sub-container">

                    <div class="box">
                        <div class="line">
                            <p class="std7">お問い合わせについて</p>
                            <p>お問い合わせは、<br class="sp">下記公式LINEにお願いいたします。<br><br class="sp">
                            お問い合わせフォームからですと<br>
                            返信にお時間いただきますので、<br class="sp">ご了承ください。</p>
                            <a target="_blank" class="button inq" href="https://lin.ee/tMc4HRi">公式LINEはこちら</a>
                        </div>
                    </div>
                    <h2 class="std7">お問い合わせフォーム</h2>
                    <div class="notes">
                        <p>フォームの注意事項</p>
                        <ul>
                            <li>メールアドレスは半角英数字で入力し、送信前に誤りがない事をご確認ください。</li>
                            <li>半角カナ入力は文字化けの原因となりますのでご注意ください。</li>
                            <li>全角のダッシュ「―」波形「～」は文字化けの原因となりますのでご注意ください。</li>
                            <li>ご記入いただいたアドレス宛に記入内容が自動返信されます。<br>
                                もしこちらが届かなかった場合はメールアドレスが間違っている可能性があるため公式LINEにてお問い合わせください。</li>
                        </ul>
                    </div>

                    <form method="post" action="">

                        <?php if( !empty($error) ): ?>
                            <ul class="error_list">
                            <?php foreach( $error as $value ): ?>
                                <li><?php echo $value; ?></li>
                            <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>

                        <div class="label-flex">
                            <label for="">お名前</label>
                            <p>必須</p>
                        </div>
                        <div class="flex-item">
                            <p>
                                <input type="text" name="iyour_name" value="<?php if( !empty($_POST['iyour_name']) ){ echo $_POST['iyour_name']; } ?>" placeholder="山田 太郎">
                            </p>
                        </div>

                        <div class="label-flex">
                            <label for="">フリガナ</label>
                            <p>必須</p>
                        </div>
                        <div class="flex-item">
                            <p>
                                <input type="text" name="ihurigana" value="<?php if( !empty($_POST['ihurigana']) ){ echo $_POST['ihurigana']; } ?>" placeholder="ヤマダ タロウ">
                            </p>
                        </div>

                        <div class="label-flex">
                            <label for="">メールアドレス</label>
                            <p>必須</p>
                        </div>
                        <div class="flex-item">
                            <p>
                                <input type="email" name="iemail" value="<?php if( !empty($_POST['iemail']) ){ echo $_POST['iemail']; } ?>" placeholder="example@sample.com">
                            </p>
                        </div>

                        <div class="label-flex">
                            <label for="">お問い合わせ内容</label>
                            <p>必須</p>
                        </div>
                        <div class="flex-item">
                            <p>
                                <textarea name="imessage" placeholder="内容を記入して下さい"><?php if( !empty($_POST['imessage']) ){ echo $_POST['imessage']; } ?></textarea>
                            </p>
                        </div>

                        <div class="btn_submit">
                            <input type="submit" name="btn_confirm" value="入力内容を確認する">
                        </div>

                    </form>

            </div>
        </section>

        <!-- ここまで問い合わせページが入る -->
        
        <?php endif; ?>
    </main>
    <?php get_footer(); ?>
