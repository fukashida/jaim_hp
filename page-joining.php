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
    
    // 変数とタイムゾーンを初期化
    $header = null;
    $auto_reply_subject = null;
    $auto_reply_text = null;
    $admin_reply_subject = null;
    $admin_reply_text = null;
    date_default_timezone_set('Asia/Tokyo');

    if(count($_POST)){
        $url = 'https://script.google.com/macros/s/AKfycbxn0c00QsQ9FxvDaaYtkwpxZrV5wx_2XGrSUHvQQbofdCKPhBMU3osXwWyR5EpUOaeUHg/exec';
        $data = array(
            'time' => date("Y/m/d H:i:s"),
            'your_name' => $_POST['your_name'],
            'hurigana' => $_POST['hurigana'],
            'email' => $_POST['email'],
            'tel' => $_POST['tel'],
            'your_postcode' => $_POST['your_postcode'],
            'your_address' => $_POST['your_address'],
            'gender' => $_POST['gender'],
            'birth' => $_POST['birth'],
            'qualification' => $_POST['qualification'],
            'others' => $_POST['others'],
            'corporate_name' => $_POST['corporate_name'],
            'postcode' => $_POST['postcode'],
            'address' => $_POST['address'],
            'clinic_tel' => $_POST['clinic_tel'],
            'destination' => $_POST['destination'],
            'type' => $_POST['type'],
            'field' => $_POST['field'],
            'other_field' => $_POST['other_field'],
            'a_number' => $_POST['a_number'],
            'a_acquisition' => $_POST['a_acquisition'],
            'specialty' => $_POST['specialty'],
            'other_specialty' => $_POST['other_specialty'],
            'b_number' => $_POST['b_number'],
            'b_acquisition' => $_POST['b_acquisition'],
            'student' => $_POST['student'],
            'other_students' => $_POST['other_students'],
            'organization' => $_POST['organization'],
            'other_organization' => $_POST['other_organization'],
            'company' => $_POST['company'],
            'company_address' => $_POST['company_address'],
            'manager' => $_POST['manager'],
            'company_url' => $_POST['company_url'],
            'payment' => $_POST['payment'],
            'recommend_director' => $_POST['recommend_director'],
            'recommend_id' => $_POST['recommend_id'],
            'agree_1' => $_POST['agree_1'],
            'agree_2' => $_POST['agree_2'],
            'agree_student' => $_POST['agree_student'],
            'agree_special' => $_POST['agree_special'],
            'agree_usual' => $_POST['agree_usual'],
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

    // ヘッダー情報を設定
    $header = "MIME-Version: 1.0\n";
    $header .= "From: 一般社団法人日本美容内科学会 <ask@jaim2023.com>\n";
    $header .= "Reply-To: 一般社団法人日本美容内科学会 <ask@jaim2023.com>\n";

    // 件名を設定
    $auto_reply_subject = 'ご入会のお申し込みありがとうございます';

    // 本文を設定
    $auto_reply_text .=  "※このメールはシステムからの自動返信です\n";
    $auto_reply_text .=  "\n";
    $auto_reply_text .=  "" . $_POST['your_name'] . "様\n";
    $auto_reply_text .=  "\n";
    $auto_reply_text .=  "お世話になっております。\n";
    $auto_reply_text .=  "日本美容内科学会へのご入会申し込みありがとうございました。\n\n";
    $auto_reply_text .=  "以下の内容でお申し込みを受け付けいたしました。\n";
    $auto_reply_text .=  "\n";
    $auto_reply_text .=  "━━━━━━□■□　お申し込み内容　□■□━━━━━━\n";
    $auto_reply_text .=  "お申し込み日時：" . date("Y-m-d H:i") . "\n";
    $auto_reply_text .= "氏名：" . $_POST['your_name'] . "\n";
    $auto_reply_text .= "フリガナ：" . $_POST['hurigana'] . "\n";
    $auto_reply_text .= "メールアドレス：" . $_POST['email'] . "\n";
    $auto_reply_text .= "電話番号：" . $_POST['tel'] . "\n";
    $auto_reply_text .= "郵便番号：" . $_POST['your_postcode'] . "\n";
    $auto_reply_text .= "住所：" . $_POST['your_address'] . "\n";
    if( $_POST['gender'] === "男性" ){
    $auto_reply_text .= "性別：男性\n";
    } elseif ( $_POST['gender'] === "女性" ){
    $auto_reply_text .= "性別：女性\n";
    } else {
    $auto_reply_text .= "性別：\n";
    }
    $auto_reply_text .= "生年月日：" . $_POST['birth'] . "\n";
    if( $_POST['qualification'] === "選択してください" ){ $auto_reply_text .= "国家資格の免許の種類：\n"; }
    elseif( $_POST['qualification'] === "医師" ){ $auto_reply_text .= "国家資格の免許の種類：医師\n"; }
    elseif( $_POST['qualification'] === "歯科医師" ){ $auto_reply_text .= "国家資格の免許の種類：歯科医師\n"; }
    elseif( $_POST['qualification'] === "薬剤師" ){ $auto_reply_text .= "国家資格の免許の種類：薬剤師\n"; }
    elseif( $_POST['qualification'] === "保健師" ){ $auto_reply_text .= "国家資格の免許の種類：保健師\n"; }
    elseif( $_POST['qualification'] === "助産師" ){ $auto_reply_text .= "国家資格の免許の種類：助産師\n"; }
    elseif( $_POST['qualification'] === "看護師" ){ $auto_reply_text .= "国家資格の免許の種類：看護師\n"; }
    elseif( $_POST['qualification'] === "診療放射線技師" ){ $auto_reply_text .= "国家資格の免許の種類：診療放射線技師\n"; }
    elseif( $_POST['qualification'] === "臨床検査技師" ){ $auto_reply_text .= "国家資格の免許の種類：臨床検査技師\n"; }
    elseif( $_POST['qualification'] === "臨床工学技士" ){ $auto_reply_text .= "国家資格の免許の種類：臨床工学技士\n"; }
    elseif( $_POST['qualification'] === "衛生検査技師" ){ $auto_reply_text .= "国家資格の免許の種類：衛生検査技師\n"; }
    elseif( $_POST['qualification'] === "あん摩マッサージ指圧師" ){ $auto_reply_text .= "国家資格の免許の種類：あん摩マッサージ指圧師\n"; }
    elseif( $_POST['qualification'] === "はり師" ){ $auto_reply_text .= "国家資格の免許の種類：はり師\n"; }
    elseif( $_POST['qualification'] === "きゅう師" ){ $auto_reply_text .= "国家資格の免許の種類：きゅう師\n"; }
    elseif( $_POST['qualification'] === "柔道整復師" ){ $auto_reply_text .= "国家資格の免許の種類：柔道整復師\n"; }
    elseif( $_POST['qualification'] === "理学療法士" ){ $auto_reply_text .= "国家資格の免許の種類：理学療法士\n"; }
    elseif( $_POST['qualification'] === "作業療法士" ){ $auto_reply_text .= "国家資格の免許の種類：作業療法士\n"; }
    elseif( $_POST['qualification'] === "視能訓練士" ){ $auto_reply_text .= "国家資格の免許の種類：視能訓練士\n"; }
    elseif( $_POST['qualification'] === "義肢装具士" ){ $auto_reply_text .= "国家資格の免許の種類：義肢装具士\n"; }
    elseif( $_POST['qualification'] === "歯科衛生士" ){ $auto_reply_text .= "国家資格の免許の種類：歯科衛生士\n"; }
    elseif( $_POST['qualification'] === "歯科技工士" ){ $auto_reply_text .= "国家資格の免許の種類：歯科技工士\n"; }
    elseif( $_POST['qualification'] === "救急救命士" ){ $auto_reply_text .= "国家資格の免許の種類：救急救命士\n"; }
    elseif( $_POST['qualification'] === "社会福祉士" ){ $auto_reply_text .= "国家資格の免許の種類：社会福祉士\n"; }
    elseif( $_POST['qualification'] === "介護福祉士" ){ $auto_reply_text .= "国家資格の免許の種類：介護福祉士\n"; }
    elseif( $_POST['qualification'] === "精神保健福祉士" ){ $auto_reply_text .= "国家資格の免許の種類：精神保健福祉士\n"; }
    elseif( $_POST['qualification'] === "言語聴覚士" ){ $auto_reply_text .= "国家資格の免許の種類：言語聴覚士\n"; }
    elseif( $_POST['qualification'] === "管理栄養士" ){ $auto_reply_text .= "国家資格の免許の種類：管理栄養士\n"; }
    elseif( $_POST['qualification'] === "臨床心理士" ){ $auto_reply_text .= "国家資格の免許の種類：臨床心理士\n"; }
    elseif( $_POST['qualification'] === "健康運動指導士" ){ $auto_reply_text .= "国家資格の免許の種類：健康運動指導士\n"; }
    elseif( $_POST['qualification'] === "運動療法士" ){ $auto_reply_text .= "国家資格の免許の種類：運動療法士\n"; }
    elseif( $_POST['qualification'] === "音楽療法士" ){ $auto_reply_text .= "国家資格の免許の種類：音楽療法士\n"; }
    elseif( $_POST['qualification'] === "医療環境管理士" ){ $auto_reply_text .= "国家資格の免許の種類：医療環境管理士\n"; }
    elseif( $_POST['qualification'] === "獣医" ){ $auto_reply_text .= "国家資格の免許の種類：獣医\n"; }
    elseif( $_POST['qualification'] === "その他" ){ 
        $auto_reply_text .= "国家資格の免許の種類：その他\n"; 
        $auto_reply_text .= "国家資格の免許の種類（その他）：" . $_POST['others'] . "\n";
    }
    else {
        $auto_reply_text .= "国家資格の免許の種類：\n";
    }
    $auto_reply_text .= "所属施設名（病院、クリニック、会社、学校等）：" . $_POST['corporate_name'] . "\n";
    $auto_reply_text .= "郵便番号（病院、クリニック、会社、学校等）：" . $_POST['postcode'] . "\n";
    $auto_reply_text .= "住所（病院、クリニック、会社、学校等）：" . $_POST['address'] . "\n";
    $auto_reply_text .= "電話番号（病院、クリニック、会社、学校等）：" . $_POST['clinic_tel'] . "\n";
    if( $_POST['destination'] === "自宅" ){ $auto_reply_text .= "連絡先・書類送付先：自宅\n"; }
    elseif( $_POST['destination'] === "職場" ){ $auto_reply_text .= "連絡先・書類送付先：職場\n"; }
    else {
        $auto_reply_text .= "連絡先・書類送付先：\n";
        }
    if( $_POST['type'] === "正会員A" ){ 
        $auto_reply_text .= "会員区分：正会員A\n"; 
        $auto_reply_text .= "医師、歯科医師（基本分野）：" . $_POST['field'] . "\n";
        $auto_reply_text .= "医師、歯科医師（基本分野ならびに専門領域にない分野）：" . $_POST['other_field'] . "\n";
        $auto_reply_text .= "国家資格免許番号：" . $_POST['a_number'] . "\n";
        $auto_reply_text .= "取得年月日：" . $_POST['a_acquisition'] . "\n";
    }
    elseif( $_POST['type'] === "正会員B" ){ 
        $auto_reply_text .= "会員区分：正会員B\n"; 
        $auto_reply_text .= "医療従事者（専門）：" . $_POST['specialty'] . "\n";
        $auto_reply_text .= "医療従事者（その他専門）：" . $_POST['other_specialty'] . "\n";
        $auto_reply_text .= "国家資格免許番号：" . $_POST['b_number'] . "\n";
        $auto_reply_text .= "取得年月日：" . $_POST['b_acquisition'] . "\n";
    }
    elseif( $_POST['type'] === "一般会員" ){ 
        $auto_reply_text .= "会員区分：一般会員\n"; 
        $auto_reply_text .= "推薦理事名：" . $_POST['recommend_director'] . "\n";
        $auto_reply_text .= "推薦ID：" . $_POST['recommend_id'] . "\n";
    }
    elseif( $_POST['type'] === "学生会員" ){ 
        $auto_reply_text .= "会員区分：学生会員\n"; 
        $auto_reply_text .= "学生分野：" . $_POST['student'] . "\n";
        $auto_reply_text .= "学生分野（その他）：" . $_POST['other_students'] . "\n";
    }
    elseif( $_POST['type'] === "賛助会員" ){ 
        $auto_reply_text .= "会員区分：賛助会員\n"; 
        if( $_POST['organization'] === "選択してください" ){ $auto_reply_text .= "団体、企業：\n"; }
        elseif( $_POST['organization'] === "公務・公共団体" ){ $auto_reply_text .= "団体、企業：公務・公共団体\n"; }
        elseif( $_POST['organization'] === "製薬関連" ){ $auto_reply_text .= "団体、企業：製薬関連\n"; }
        elseif( $_POST['organization'] === "薬品卸" ){ $auto_reply_text .= "団体、企業：薬品卸\n"; }
        elseif( $_POST['organization'] === "薬品販売" ){ $auto_reply_text .= "団体、企業：薬品販売\n"; }
        elseif( $_POST['organization'] === "化粧品関連" ){ $auto_reply_text .= "団体、企業：化粧品関連\n"; }
        elseif( $_POST['organization'] === "食品関連" ){ $auto_reply_text .= "団体、企業：食品関連\n"; }
        elseif( $_POST['organization'] === "健康関連" ){ $auto_reply_text .= "団体、企業：健康関連\n"; }
        elseif( $_POST['organization'] === "施設（医療）" ){ $auto_reply_text .= "団体、企業：施設（医療）\n"; }
        elseif( $_POST['organization'] === "施設（介護）" ){ $auto_reply_text .= "団体、企業：施設（介護）\n"; }
        elseif( $_POST['organization'] === "施設（老人施設）" ){ $auto_reply_text .= "団体、企業：施設（老人施設）\n"; }
        elseif( $_POST['organization'] === "医療機器・医療用品関連" ){ $auto_reply_text .= "団体、企業：医療機器・医療用品関連\n"; }
        elseif( $_POST['organization'] === "健康機器・健康用品関連" ){ $auto_reply_text .= "団体、企業：健康機器・健康用品関連\n"; }
        elseif( $_POST['organization'] === "スポーツ・運動施設" ){ $auto_reply_text .= "団体、企業：スポーツ・運動施設\n"; }
        elseif( $_POST['organization'] === "マスコミ・メディア" ){ $auto_reply_text .= "団体、企業：マスコミ・メディア\n"; }
        elseif( $_POST['organization'] === "教育関連業" ){ $auto_reply_text .= "団体、企業：教育関連業\n"; }
        elseif( $_POST['organization'] === "農業" ){ $auto_reply_text .= "団体、企業：農業\n"; }
        elseif( $_POST['organization'] === "建設業" ){ $auto_reply_text .= "団体、企業：建設業\n"; }
        elseif( $_POST['organization'] === "製造業" ){ $auto_reply_text .= "団体、企業：製造業\n"; }
        elseif( $_POST['organization'] === "電気ガス熱水道業" ){ $auto_reply_text .= "団体、企業：電気ガス熱水道業\n"; }
        elseif( $_POST['organization'] === "情報通信業" ){ $auto_reply_text .= "団体、企業：情報通信業\n"; }
        elseif( $_POST['organization'] === "運輸業" ){ $auto_reply_text .= "団体、企業：運輸業\n"; }
        elseif( $_POST['organization'] === "卸売り・小売業" ){ $auto_reply_text .= "団体、企業：卸売り・小売業\n"; }
        elseif( $_POST['organization'] === "金融・保険業" ){ $auto_reply_text .= "団体、企業：金融・保険業\n"; }
        elseif( $_POST['organization'] === "不動産業" ){ $auto_reply_text .= "団体、企業：不動産業\n"; }
        elseif( $_POST['organization'] === "飲食店・宿泊業" ){ $auto_reply_text .= "団体、企業：飲食店・宿泊業\n"; }
        elseif( $_POST['organization'] === "医療・福祉業" ){ $auto_reply_text .= "団体、企業：医療・福祉業\n"; }
        elseif( $_POST['organization'] === "サービス業" ){ $auto_reply_text .= "団体、企業：サービス業\n"; }
        elseif( $_POST['organization'] === "美容関連" ){ $auto_reply_text .= "団体、企業：美容関連\n"; }
        elseif( $_POST['organization'] === "その他" ){ 
            $auto_reply_text .= "団体、企業：その他\n"; 
            $auto_reply_text .= "団体、企業（その他）：" . $_POST['other_organization'] . "\n";
        }
        else {
            $auto_reply_text .= "団体、企業：\n";
        }
        $auto_reply_text .= "企業名：" . $_POST['company'] . "\n";
        $auto_reply_text .= "企業アドレス：" . $_POST['company_address'] . "\n";
        $auto_reply_text .= "担当者：" . $_POST['manager'] . "\n";
        $auto_reply_text .= "企業URL：" . $_POST['company_url'] . "\n";
        if( $_POST['payment'] === "銀行振込" ){ $auto_reply_text .= "支払い方法：銀行振込\n"; }
        elseif( $_POST['payment'] === "クレジットカード決済" ){ $auto_reply_text .= "支払い方法：クレジットカード決済\n"; }
        else {
            $auto_reply_text .= "支払い方法：\n";
        }
    }
    elseif( $_POST['type'] === "特別賛助会員" ){ 
        $auto_reply_text .= "会員区分：特別賛助会員\n"; 
        if( $_POST['organization'] === "選択してください" ){ $auto_reply_text .= "団体、企業：\n"; }
        elseif( $_POST['organization'] === "公務・公共団体" ){ $auto_reply_text .= "団体、企業：公務・公共団体\n"; }
        elseif( $_POST['organization'] === "製薬関連" ){ $auto_reply_text .= "団体、企業：製薬関連\n"; }
        elseif( $_POST['organization'] === "薬品卸" ){ $auto_reply_text .= "団体、企業：薬品卸\n"; }
        elseif( $_POST['organization'] === "薬品販売" ){ $auto_reply_text .= "団体、企業：薬品販売\n"; }
        elseif( $_POST['organization'] === "化粧品関連" ){ $auto_reply_text .= "団体、企業：化粧品関連\n"; }
        elseif( $_POST['organization'] === "食品関連" ){ $auto_reply_text .= "団体、企業：食品関連\n"; }
        elseif( $_POST['organization'] === "健康関連" ){ $auto_reply_text .= "団体、企業：健康関連\n"; }
        elseif( $_POST['organization'] === "施設（医療）" ){ $auto_reply_text .= "団体、企業：施設（医療）\n"; }
        elseif( $_POST['organization'] === "施設（介護）" ){ $auto_reply_text .= "団体、企業：施設（介護）\n"; }
        elseif( $_POST['organization'] === "施設（老人施設）" ){ $auto_reply_text .= "団体、企業：施設（老人施設）\n"; }
        elseif( $_POST['organization'] === "医療機器・医療用品関連" ){ $auto_reply_text .= "団体、企業：医療機器・医療用品関連\n"; }
        elseif( $_POST['organization'] === "健康機器・健康用品関連" ){ $auto_reply_text .= "団体、企業：健康機器・健康用品関連\n"; }
        elseif( $_POST['organization'] === "スポーツ・運動施設" ){ $auto_reply_text .= "団体、企業：スポーツ・運動施設\n"; }
        elseif( $_POST['organization'] === "マスコミ・メディア" ){ $auto_reply_text .= "団体、企業：マスコミ・メディア\n"; }
        elseif( $_POST['organization'] === "教育関連業" ){ $auto_reply_text .= "団体、企業：教育関連業\n"; }
        elseif( $_POST['organization'] === "農業" ){ $auto_reply_text .= "団体、企業：農業\n"; }
        elseif( $_POST['organization'] === "建設業" ){ $auto_reply_text .= "団体、企業：建設業\n"; }
        elseif( $_POST['organization'] === "製造業" ){ $auto_reply_text .= "団体、企業：製造業\n"; }
        elseif( $_POST['organization'] === "電気ガス熱水道業" ){ $auto_reply_text .= "団体、企業：電気ガス熱水道業\n"; }
        elseif( $_POST['organization'] === "情報通信業" ){ $auto_reply_text .= "団体、企業：情報通信業\n"; }
        elseif( $_POST['organization'] === "運輸業" ){ $auto_reply_text .= "団体、企業：運輸業\n"; }
        elseif( $_POST['organization'] === "卸売り・小売業" ){ $auto_reply_text .= "団体、企業：卸売り・小売業\n"; }
        elseif( $_POST['organization'] === "金融・保険業" ){ $auto_reply_text .= "団体、企業：金融・保険業\n"; }
        elseif( $_POST['organization'] === "不動産業" ){ $auto_reply_text .= "団体、企業：不動産業\n"; }
        elseif( $_POST['organization'] === "飲食店・宿泊業" ){ $auto_reply_text .= "団体、企業：飲食店・宿泊業\n"; }
        elseif( $_POST['organization'] === "医療・福祉業" ){ $auto_reply_text .= "団体、企業：医療・福祉業\n"; }
        elseif( $_POST['organization'] === "サービス業" ){ $auto_reply_text .= "団体、企業：サービス業\n"; }
        elseif( $_POST['organization'] === "美容関連" ){ $auto_reply_text .= "団体、企業：美容関連\n"; }
        elseif( $_POST['organization'] === "その他" ){ 
            $auto_reply_text .= "団体、企業：その他\n"; 
            $auto_reply_text .= "団体、企業（その他）：" . $_POST['other_organization'] . "\n";
        }
        else {
            $auto_reply_text .= "団体、企業：\n";
        }
        $auto_reply_text .= "企業名：" . $_POST['company'] . "\n";
        $auto_reply_text .= "企業アドレス：" . $_POST['company_address'] . "\n";
        $auto_reply_text .= "担当者：" . $_POST['manager'] . "\n";
        $auto_reply_text .= "企業URL：" . $_POST['company_url'] . "\n";
        if( $_POST['payment'] === "銀行振込" ){ $auto_reply_text .= "支払い方法：銀行振込\n"; }
        elseif( $_POST['payment'] === "クレジットカード決済" ){ $auto_reply_text .= "支払い方法：クレジットカード決済\n"; }
        else {
            $auto_reply_text .= "支払い方法：\n";
            }
    }
    else {
        $auto_reply_text .= "会員区分：\n";
        }
    $auto_reply_text .= "━━━━━━━━━━━━━━━━━━━━━━━━━━\n\n";

    $auto_reply_text .= "━━━━━━━━━━━━━━━━━━━━━━━━\n\n";
    $auto_reply_text .= "【一般社団法人日本美容内科学会】\n";
    $auto_reply_text .= "住所：〒104-0061　東京都中央区銀座1-12-4 N&E BLD. 7階\n";
    $auto_reply_text .= "TEL：090-3813-7241\n";
    $auto_reply_text .= "メール：ask@jaim2023.com\n";
    $auto_reply_text .= "担当：伊藤　明子\n\n";
    $auto_reply_text .= "━━━━━━━━━━━━━━━━━━━━━━━━\n";


    // メール送信
    mb_send_mail( $_POST['email'], $auto_reply_subject, $auto_reply_text, $header);


    } else {
        $page_flag = 0;
    }
}

function validation($data) {

	$error = array();

	// 名前のバリデーション
	if( empty($data['your_name']) ) {
		$error[] = "「お名前」は必ず入力してください。";
	}

    // フリガナのバリデーション
	if( empty($data['hurigana']) ) {
		$error[] = "「フリガナ」は必ず入力してください。";
	} elseif(!preg_match("/^[　ア-ン゛゜ァ-ォャ-ョー]+$/u", $data['hurigana'])) {
		$error[] = "全角カタカナで入力してください。";
    }

	// メールアドレスのバリデーション
	if( empty($data['email']) ) {
		$error[] = "「メールアドレス」は必ず入力してください。";
	}  elseif( !preg_match( '/^[0-9a-z_.\/?-]+@([0-9a-z-]+\.)+[0-9a-z-]+$/', $data['email']) ) {
		$error[] = "「メールアドレス」は正しい形式で入力してください。";
	}

	// 電話番号のバリデーション
	if( empty($data['tel']) ) {
		$error[] = "「電話番号」は必ず入力してください。";
	}  elseif( !preg_match( '/\d{2,4}-\d{2,4}-\d{4}/', $data['tel']) ) {
		$error[] = "「電話番号」はハイフンを含めて入力してください。";
	}

    // 郵便番号のバリデーション
    if( empty($data['your_postcode']) ) {
		$error[] = "「郵便番号」は必ず入力してください。";
	}

    // 住所のバリデーション
    if( empty($data['your_address']) ) {
		$error[] = "「住所」は必ず入力してください。";
	}

    // 生年月日のバリデーション
    if( empty($data['birth']) ) {
		$error[] = "「生年月日」は必ず入力してください。";
	}

    //所属施設名( 病院、クリニック、会社、学校等 )のバリデーション
    if( empty($data['corporate_name']) ) {
		$error[] = "「所属施設名」は必ず入力してください。";
	}

	// 電話番号（病院、クリニック、会社、学校等）のバリデーション
    if( !empty($data['clinic_tel']) && !preg_match( '/\d{2,4}-\d{2,4}-\d{4}/' , $data['clinic_tel']) ) {
		$error[] = "「貴院電話番号」はハイフンを含めて入力してください。";
	}

    // その他のバリデーション[国家資格の免許の種類]
    if( empty($data['others']) && !empty($_POST['qualification']) && $_POST['qualification'] === "その他") {
		$error[] = "「国家資格の免許の種類」は必ず入力してください。";
	} 

    // 連絡先・書類送付先のバリデーション
	if( empty($data['destination']) ) {
		$error[] = "「連絡先・書類送付先」は必ず入力してください。";
	}  

    // 医師、歯科医師(基本分野)のバリデーション[正会員A]
    if( empty($data['field']) && !empty($_POST['type']) && $_POST['type'] === "正会員A") {
        $error[] = "「医師、歯科医師 (基本分野)」は必ず入力してください。";
    }

    // 医師、歯科医師(基本分野ならびに専門領域にない分野)のバリデーション[正会員A]
     if( empty($data['other_field']) && $_POST['field'] === "その他" ) {
        $error[] = "「医師、歯科医師 (基本分野ならびに専門領域にない分野)」は必ず入力してください。";
    }

    // 国家資格免許番号のバリデーション[正会員A]
	if( empty($data['a_number']) && $_POST['type'] === "正会員A" ) {
		$error[] = "「国家資格免許番号」は必ず入力してください。";
	}  elseif( !preg_match( '/^[0-9]+$/', $data['a_number']) && $_POST['type'] === "正会員A" ) {
		$error[] = "「国家資格免許番号」は半角数字で入力してください。";
	}

    // 取得年月日のバリデーション[正会員A]
    if( empty($data['a_acquisition']) && $_POST['type'] === "正会員A" ) {
        $error[] = "「取得年月日」は必ず入力してください。";
    }

    // 医療従事者(専門)のバリデーション[正会員B]
    if( empty($data['specialty']) && !empty($_POST['type']) && $_POST['type'] === "正会員B") {
        $error[] = "「医療従事者(専門)」は必ず入力してください。";
    } 

    // その他の医療従事者(専門)のバリデーション[正会員B]
    if( empty($data['other_specialty']) && $_POST['specialty'] === "その他" ) {
        $error[] = "「学生分野」は必ず入力してください。";
    }

    // 国家資格免許番号のバリデーション[正会員B]
	if( empty($data['b_number'])  && $_POST['type'] === "正会員B" ) {
		$error[] = "「国家資格免許番号」は必ず入力してください。";
	}  elseif( !preg_match( '/^[0-9]+$/', $data['b_number']) && $_POST['type'] === "正会員B") {
		$error[] = "「国家資格免許番号」は半角数字で入力してください。";
	}

    // 取得年月日のバリデーション[正会員B]
    if( empty($data['b_acquisition']) && $_POST['type'] === "正会員B" ) {
        $error[] = "「取得年月日」は必ず入力してください。";
    }    

    // 学生分野のバリデーション[学生会員]
    if( empty($data['student']) && !empty($_POST['type']) && $_POST['type'] === "学生会員") {
        $error[] = "「学生分野」は必ず入力してください。";
    }

    // 学生その他のバリデーション[学生会員]
    if( empty($data['other_students']) && $_POST['student'] === "学生 その他" ) {
        $error[] = "「学生分野」は必ず入力してください。";
    } elseif( empty($data['other_students']) && $_POST['student'] === "大学院 その他" ) {
        $error[] = "「学生分野」は必ず入力してください。";
    }

    // 団体、企業のバリデーション[賛助会員][特別賛助会員]
    if( empty($data['organization']) && !empty($_POST['type']) && $_POST['type'] === "賛助会員") {
		$error[] = "「団体、企業」は必ず入力してください。";
	} elseif( empty($data['company']) && !empty($_POST['type']) && $_POST['type'] === "特別賛助会員"){
        $error[] = "「団体、企業」は必ず入力してください。";
    }

    // その他団体、企業のバリデーション[賛助会員][特別賛助会員]
    if( empty($data['other_organization']) && $_POST['organization'] === "その他") {
		$error[] = "「団体、企業」は必ず入力してください。";
	} 

    // 企業名のバリデーション[賛助会員][特別賛助会員]
    if( empty($data['company']) && !empty($_POST['type']) && $_POST['type'] === "賛助会員") {
		$error[] = "「企業名」は必ず入力してください。";
	} elseif( empty($data['company']) && !empty($_POST['type']) && $_POST['type'] === "特別賛助会員"){
        $error[] = "「企業名」は必ず入力してください。";
    } 

    // 企業アドレスのバリデーション[賛助会員][特別賛助会員]
    if( empty($data['company_address']) && !empty($_POST['type']) && $_POST['type'] === "賛助会員") {
		$error[] = "「企業アドレス」は必ず入力してください。";
	} elseif( empty($data['company_address']) && !empty($_POST['type']) && $_POST['type'] === "特別賛助会員"){
        $error[] = "「企業アドレス」は必ず入力してください。";
    } 

    // 担当者のバリデーション[賛助会員][特別賛助会員]
    if( empty($data['manager']) && !empty($_POST['type']) && $_POST['type'] === "賛助会員") {
		$error[] = "「担当者」は必ず入力してください。";
	} elseif( empty($data['manager']) && !empty($_POST['type']) && $_POST['type'] === "特別賛助会員"){
        $error[] = "「担当者」は必ず入力してください。";
    } 

    // 企業URLのバリデーション[賛助会員][特別賛助会員]
    if( empty($data['company_url']) && !empty($_POST['type']) && $_POST['type'] === "賛助会員") {
		$error[] = "「企業URL」は必ず入力してください。";
	} elseif( empty($data['company_url']) && !empty($_POST['type']) && $_POST['type'] === "特別賛助会員"){
        $error[] = "「企業URL」は必ず入力してください。";
    }  
    
    // 推薦理事名のバリデーション[一般会員]
    if( empty($data['recommend_director']) && !empty($_POST['type']) && $_POST['type'] === "一般会員") {
        $error[] = "「推薦理事名」は必ず入力してください。";
    }
    


	return $error;
}

?>
</div>

<?php if( $page_flag === 1 ): ?>

    <!-- ここに確認ページが入る -->
<?php get_header(); ?>

<main class="inquiry joining">

    <div class="breadcrumbs" typeof="BreadcrumbList" vocab="https://schema.org/">
        <div class="container">
            <?php if(function_exists('bcn_display'))
            {
                bcn_display();
            }?>
        </div>
    </div>

    <section class="about joining">
        <div class="container">
            <div class="sub-container">

                <h2 class="confirm">入力内容の確認</h2>

                <form method="post" action="" class="confirm">
                    <div class="element_wrap">
                        <label>お名前</label>
                        <p><?php echo $_POST['your_name']; ?></p>
                    </div>
                    <div class="element_wrap">
                        <label>フリガナ</label>
                        <p><?php echo $_POST['hurigana']; ?></p>
                    </div>
                    <div class="element_wrap">
                        <label>メールアドレス</label>
                        <p><?php echo $_POST['email']; ?></p>
                    </div>
                    <div class="element_wrap">
                        <label>電話番号</label>
                        <p><?php echo $_POST['tel']; ?></p>
                    </div>
                    <div class="element_wrap">
                        <label>郵便番号</label>
                        <p><?php echo $_POST['your_postcode']; ?></p>
                    </div>
                    <div class="element_wrap">
                        <label>ご住所</label>
                        <p><?php echo $_POST['your_address']; ?></p>
                    </div>
                    <div class="element_wrap">
                        <label>性別</label>
                        <p>
                        <?php if( empty($_POST['gender'])){ echo ''; }
                            elseif( $_POST['gender'] === "選択してください" ){ echo ''; }
                            elseif( $_POST['gender'] === "男性" ){ echo '男性'; }
                            elseif( $_POST['gender'] === "女性" ){ echo '女性'; }
                            ?>
                        </p>
                    </div>
                    <div class="element_wrap">
                        <label>生年月日</label>
                        <p><?php 
                        if( empty($_POST['birth'])){ echo ''; }
                        else {echo $_POST['birth']; }
                        ?></p>
                    </div>
                    <div class="element_wrap">
                        <label>国家資格の免許の種類</label>
                        <p>
                        <?php if( empty($_POST['qualification'])){ echo ''; }
                            elseif( $_POST['qualification'] === "選択してください" ){ echo ''; }
                            elseif( $_POST['qualification'] === "医師" ){ echo '医師'; }
                            elseif( $_POST['qualification'] === "歯科医師" ){ echo '歯科医師'; }
                            elseif( $_POST['qualification'] === "薬剤師" ){ echo '薬剤師'; }
                            elseif( $_POST['qualification'] === "保健師" ){ echo '保健師'; }
                            elseif( $_POST['qualification'] === "助産師" ){ echo '助産師'; }
                            elseif( $_POST['qualification'] === "看護師" ){ echo '看護師'; }
                            elseif( $_POST['qualification'] === "診療放射線技師" ){ echo '診療放射線技師'; }
                            elseif( $_POST['qualification'] === "臨床検査技師" ){ echo '臨床検査技師'; }
                            elseif( $_POST['qualification'] === "臨床工学技士" ){ echo '臨床工学技士'; }
                            elseif( $_POST['qualification'] === "衛生検査技師" ){ echo '衛生検査技師'; }
                            elseif( $_POST['qualification'] === "あん摩マッサージ指圧師" ){ echo 'あん摩マッサージ指圧師'; }
                            elseif( $_POST['qualification'] === "はり師" ){ echo 'はり師'; }
                            elseif( $_POST['qualification'] === "きゅう師" ){ echo 'きゅう師'; }
                            elseif( $_POST['qualification'] === "柔道整復師" ){ echo '柔道整復師'; }
                            elseif( $_POST['qualification'] === "理学療法士" ){ echo '理学療法士'; }
                            elseif( $_POST['qualification'] === "作業療法士" ){ echo '作業療法士'; }
                            elseif( $_POST['qualification'] === "視能訓練士" ){ echo '視能訓練士'; }
                            elseif( $_POST['qualification'] === "義肢装具士" ){ echo '義肢装具士'; }
                            elseif( $_POST['qualification'] === "歯科衛生士" ){ echo '歯科衛生士'; }
                            elseif( $_POST['qualification'] === "歯科技工士" ){ echo '歯科技工士'; }
                            elseif( $_POST['qualification'] === "救急救命士" ){ echo '救急救命士'; }
                            elseif( $_POST['qualification'] === "社会福祉士" ){ echo '社会福祉士'; }
                            elseif( $_POST['qualification'] === "介護福祉士" ){ echo '介護福祉士'; }
                            elseif( $_POST['qualification'] === "精神保健福祉士" ){ echo '精神保健福祉士'; }
                            elseif( $_POST['qualification'] === "言語聴覚士" ){ echo '言語聴覚士'; }
                            elseif( $_POST['qualification'] === "管理栄養士" ){ echo '管理栄養士'; }
                            elseif( $_POST['qualification'] === "臨床心理士" ){ echo '臨床心理士'; }
                            elseif( $_POST['qualification'] === "健康運動指導士" ){ echo '健康運動指導士'; }
                            elseif( $_POST['qualification'] === "運動療法士" ){ echo '運動療法士'; }
                            elseif( $_POST['qualification'] === "音楽療法士" ){ echo '音楽療法士'; }
                            elseif( $_POST['qualification'] === "医療環境管理士" ){ echo '医療環境管理士'; }
                            elseif( $_POST['qualification'] === "獣医" ){ echo '獣医'; }
                            elseif( $_POST['qualification'] === "その他" ){ echo 'その他'; }
                            ?>
                        </p>
                    </div>
                    <?php if( empty($_POST['others']) ): ?>
                    <?php elseif( $_POST['qualification'] === "その他" ): ?>
                        <div class="element_wrap">
                            <label>国家資格の免許の種類</label>
                            <p><?php echo $_POST['others']; ?></p>
                        </div>
                    <?php else: { echo ''; }?>
                    <?php endif; ?>

                    <div class="element_wrap">
                        <label>所属施設名<br class="sp">( 病院、クリニック、会社、学校等 )</label>
                        <p><?php echo $_POST['corporate_name']; ?></p>
                    </div>
                    <div class="element_wrap">
                        <label>郵便番号<br class="sp">( 病院、クリニック、会社、学校等 )</label>
                        <p><?php echo $_POST['postcode']; ?></p>
                    </div>
                    <div class="element_wrap">
                        <label>住所<br class="sp">( 病院、クリニック、会社、学校等 )</label>
                        <p><?php echo $_POST['address']; ?></p>
                    </div>
                    <div class="element_wrap">
                        <label>電話番号<br class="sp">( 病院、クリニック、会社、学校等 )</label>
                        <p><?php echo $_POST['clinic_tel']; ?></p>
                    </div>
                    <div class="element_wrap">
                        <label>連絡先・書類送付先</label>
                        <p>
                        <?php if( empty($_POST['destination'])){ echo ''; }
                            elseif( $_POST['destination'] === "自宅" ){ echo '自宅'; }
                            elseif( $_POST['destination'] === "職場" ){ echo '職場'; }
                            ?>
                        </p>
                    </div>
                    <div class="element_wrap">
                        <label>会員区分</label>
                        <p>
                        <?php if( empty($_POST['type'])){ echo ''; }
                            elseif( $_POST['type'] === "正会員A" ){ echo '正会員A'; }
                            elseif( $_POST['type'] === "正会員B" ){ echo '正会員B'; }
                            elseif( $_POST['type'] === "一般会員" ){ echo '一般会員'; }
                            elseif( $_POST['type'] === "学生会員" ){ echo '学生会員'; }
                            elseif( $_POST['type'] === "賛助会員" ){ echo '賛助会員'; }
                            elseif( $_POST['type'] === "特別賛助会員" ){ echo '特別賛助会員'; }
                            ?>
                        </p>
                    </div>

                    <?php  if( !empty($_POST['type']) && $_POST['type'] === "賛助会員" || !empty($_POST['type']) && $_POST['type'] === "特別賛助会員" ): ?>

                        <div class="element_wrap">
                            <label>団体、企業</label>
                            <p><?php if( $_POST['type'] === "賛助会員" ||  $_POST['type'] === "特別賛助会員" ){echo $_POST['organization'];} ?></p>
                        </div>

                        <?php if( empty($_POST['other_organization']) ): ?>
                            <?php elseif( $_POST['organization'] === "その他" ): ?>
                            <div class="element_wrap">
                                <label>団体、企業</label>
                                <p><?php echo $_POST['other_organization']; ?></p>
                            </div>
                            <?php else: { echo ''; }?>
                        <?php endif; ?>

                        <div class="element_wrap">
                            <label>企業名</label>
                            <p><?php if( $_POST['type'] === "賛助会員" | $_POST['type'] === "特別賛助会員" ){echo $_POST['company'];} ?></p>
                        </div>

                        <div class="element_wrap">
                            <label>企業アドレス</label>
                            <p><?php if( $_POST['type'] === "賛助会員" | $_POST['type'] === "特別賛助会員" ){echo $_POST['company_address'];} ?></p>
                        </div>

                        <div class="element_wrap">
                            <label>担当者</label>
                            <p><?php if( $_POST['type'] === "賛助会員" | $_POST['type'] === "特別賛助会員" ){echo $_POST['manager'];} ?></p>
                        </div>

                        <div class="element_wrap">
                            <label>企業URL</label>
                            <p><?php if( $_POST['type'] === "賛助会員" | $_POST['type'] === "特別賛助会員" ){echo $_POST['company_url'];} ?></p>
                        </div>

                        <div class="element_wrap">
                            <label>支払い方法</label>
                            <p>
                            <?php if( empty($_POST['payment'])){ echo ''; }
                                elseif( $_POST['payment'] === "銀行振込" ){ echo '銀行振込'; }
                                elseif( $_POST['payment'] === "クレジットカード決済" ){ echo 'クレジットカード決済'; }
                                ?>
                            </p>
                        </div>

                    <?php else: ?>
                    <?php endif; ?>

                    <?php  if( !empty($_POST['type']) && $_POST['type'] === "正会員A"): ?>
                        <div class="element_wrap">
                            <label>医師、歯科医師（基本分野）</label>
                            <p><?php if( $_POST['type'] === "正会員A" ){echo $_POST['field'];} ?></p>
                        </div>
                        <?php if( empty($_POST['other_field']) ): ?>
                            <?php elseif( $_POST['field'] === "その他" ): ?>
                            <div class="element_wrap">
                                <label>医師、歯科医師（基本分野ならびに専門領域にない分野）</label>
                                <p><?php echo $_POST['other_field']; ?></p>
                            </div>
                            <?php else: { echo ''; }?>
                        <?php endif; ?>
                        <div class="element_wrap">
                            <label>国家資格免許番号</label>
                            <p><?php echo $_POST['a_number']; ?></p>
                        </div>
                        <div class="element_wrap">
                            <label>取得年月日</label>
                            <p><?php 
                            if( empty($_POST['a_acquisition'])){ echo ''; }
                            else {echo $_POST['a_acquisition']; }
                            ?></p>
                        </div>
                    <?php else: ?>
                    <?php endif; ?>

                    <?php  if( !empty($_POST['type']) && $_POST['type'] === "正会員B"): ?>
                        <div class="element_wrap">
                            <label>医療従事者（専門）</label>
                            <p><?php if( $_POST['type'] === "正会員B" ){echo $_POST['specialty'];} ?></p>
                        </div>
                        <?php if( empty($_POST['other_specialty']) ): ?>
                            <?php elseif( $_POST['specialty'] === "その他" ): ?>
                            <div class="element_wrap">
                                <label>医療従事者（専門）</label>
                                <p><?php echo $_POST['other_specialty']; ?></p>
                            </div>
                            <?php else: { echo ''; }?>
                        <?php endif; ?>
                        <div class="element_wrap">
                            <label>国家資格免許番号</label>
                            <p><?php echo $_POST['b_number']; ?></p>
                        </div>
                        <div class="element_wrap">
                            <label>取得年月日</label>
                            <p><?php 
                            if( empty($_POST['b_acquisition'])){ echo ''; }
                            else {echo $_POST['b_acquisition']; }
                            ?></p>
                        </div>
                    <?php else: ?>
                    <?php endif; ?>

                    <?php  if( !empty($_POST['type']) && $_POST['type'] === "学生会員"): ?>
                        <div class="element_wrap">
                            <label>学生分野</label>
                            <p><?php if( $_POST['type'] === "学生会員" ){echo $_POST['student'];} ?></p>
                        </div>
                        <?php if( empty($_POST['other_students']) ): ?>
                            <?php elseif( $_POST['student'] === "学生 その他" || $_POST['student'] === "大学院 その他"): ?>
                                <div class="element_wrap">
                                    <label>学生分野</label>
                                    <p><?php echo $_POST['other_students']; ?></p>
                                </div>
                            <?php else: { echo ''; }?>
                        <?php endif; ?>
                    <?php else: ?>
                    <?php endif; ?>

                    <?php  if( !empty($_POST['type']) && $_POST['type'] === "一般会員"): ?>
                        <div class="element_wrap">
                            <label>推薦理事名</label>
                            <p><?php if( $_POST['type'] === "一般会員" ){echo $_POST['recommend_director'];} ?></p>
                        </div>
                        <div class="element_wrap">
                            <label>推薦ID</label>
                            <p><?php if( $_POST['type'] === "一般会員" ){echo $_POST['recommend_id'];} ?></p>
                        </div>
                    <?php else: ?>
                    <?php endif; ?>


                    <p style="display: none"><?php 
                        if($_POST['agree_1']){ echo '同意'; }
                        else { echo ' '; }
                    ?></p>

                    <p style="display: none"><?php 
                        if($_POST['agree_2']){ echo '同意'; }
                        else { echo ' '; }
                    ?></p>

                    <p style="display: none"><?php 
                        if($_POST['agree_student']){ echo '同意'; }
                        else { echo ' '; }
                    ?></p>
                    
                    <p style="display: none"><?php 
                        if($_POST['agree_special']){ echo '同意'; }
                        else { echo ' '; }
                    ?></p>

                    <p style="display: none"><?php 
                        if($_POST['agree_usual']){ echo '同意'; }
                        else { echo ' '; }
                    ?></p>


                    <div class="submit-flex">
                        <div class="button">
                            <input class="btn_back" type="button" name="btn_back" value="戻る" onclick="history.back()">
                        </div>
                        <div class="btn_submit b2">
                            <input id="btn_submit" type="submit" name="btn_submit" value="送信する">
                            <?php  if( !empty($_POST['type']) && $_POST['type'] === "正会員A"): ?>
                                <script>
                                    let 送信する = document.getElementById('btn_submit');
                                    送信する.addEventListener('click', () => {
                                        open('https://univa.cc/hdk9FC');
                                    });
                                </script>
                            <?php elseif( !empty($_POST['type']) && $_POST['type'] === "正会員B"): ?>
                                <script>
                                    let 送信する = document.getElementById('btn_submit');
                                    送信する.addEventListener('click', () => {
                                        open('https://univa.cc/Gb-muK');
                                    });
                                </script>
                            <?php endif; ?>
                        </div>
                    </div>

                    <input type="hidden" name="time" value="<?php echo date("Y/m/d H:i:s") ?>">
                    <input type="hidden" name="your_name" value="<?php echo $_POST['your_name']; ?>">
                    <input type="hidden" name="hurigana" value="<?php echo $_POST['hurigana']; ?>">
                    <input type="hidden" name="email" value="<?php echo $_POST['email']; ?>">
                    <input type="hidden" name="tel" value="<?php echo $_POST['tel']; ?>">
                    <input type="hidden" name="your_postcode" value="<?php echo $_POST['your_postcode']; ?>">
                    <input type="hidden" name="your_address" value="<?php echo $_POST['your_address']; ?>">
                    <input type="hidden" name="gender" value="<?php if( empty($_POST['gender'])){ echo ''; } elseif( !empty($_POST['gender'] === "選択してください") ){ echo "";} else { echo $_POST['gender']; }?>">
                    <input type="hidden" name="birth" value="<?php echo $_POST['birth']; ?>">
                    <input type="hidden" name="qualification" value="<?php if( empty($_POST['qualification'])){ echo ''; } elseif( !empty($_POST['qualification'] === "選択してください") ){ echo "";} else { echo $_POST['qualification']; }?>">
                    <input type="hidden" name="others" value="<?php if( empty($_POST['qualification'])){ echo ''; } elseif( !empty($_POST['qualification'] === "その他") ){ echo $_POST['others'];} ?>">
                    <input type="hidden" name="corporate_name" value="<?php echo $_POST['corporate_name']; ?>">
                    <input type="hidden" name="postcode" value="<?php echo $_POST['postcode']; ?>">
                    <input type="hidden" name="address" value="<?php echo $_POST['address']; ?>">
                    <input type="hidden" name="clinic_tel" value="<?php echo $_POST['clinic_tel']; ?>">
                    <input type="hidden" name="destination" value="<?php if( empty($_POST['destination'])){ echo ''; }else { echo $_POST['destination']; }?>">
                    <input type="hidden" name="type" value="<?php if( empty($_POST['type'])){ echo ''; } elseif( !empty($_POST['type'] === "選択してください") ){ echo "";} else { echo $_POST['type']; }?>">
                    <input type="hidden" name="field" value="<?php if( empty($_POST['field'])){ echo ''; }else { echo $_POST['field']; }?>">
                    <input type="hidden" name="other_field" value="<?php if( empty($_POST['other_field'])){ echo ''; }else { echo $_POST['other_field']; }?>">
                    <input type="hidden" name="a_number" value="<?php echo $_POST['a_number']; ?>">
                    <input type="hidden" name="a_acquisition" value="<?php echo $_POST['acquisition']; ?>">
                    <input type="hidden" name="specialty" value="<?php if( empty($_POST['specialty'])){ echo ''; }else { echo $_POST['specialty']; }?>">
                    <input type="hidden" name="other_specialty" value="<?php if( empty($_POST['other_specialty'])){ echo ''; }else { echo $_POST['other_specialty']; }?>">
                    <input type="hidden" name="b_number" value="<?php echo $_POST['b_number']; ?>">
                    <input type="hidden" name="b_acquisition" value="<?php echo $_POST['acquisition']; ?>">
                    <input type="hidden" name="student" value="<?php if( empty($_POST['student'])){ echo ''; }else { echo $_POST['student']; }?>">
                    <input type="hidden" name="other_students" value="<?php echo $_POST['other_students']; ?>">
                    <input type="hidden" name="organization" value="<?php if( empty($_POST['organization'])){ echo ''; }else { echo $_POST['organization']; }?>">
                    <input type="hidden" name="other_organization" value="<?php echo $_POST['other_organization']; ?>">
                    <input type="hidden" name="company" value="<?php echo $_POST['company']; ?>">
                    <input type="hidden" name="company_address" value="<?php echo $_POST['company_address']; ?>">
                    <input type="hidden" name="manager" value="<?php echo $_POST['manager']; ?>">
                    <input type="hidden" name="company_url" value="<?php echo $_POST['company_url']; ?>">
                    <input type="hidden" name="payment" value="<?php if( empty($_POST['payment'])){ echo ''; } elseif( !empty($_POST['payment'] === "選択してください") ){ echo "";} else { echo $_POST['payment']; }?>">
                    <input type="hidden" name="recommend_director" value="<?php echo $_POST['recommend_director']; ?>">
                    <input type="hidden" name="recommend_id" value="<?php echo $_POST['recommend_id']; ?>">

                    <input type="hidden" name="agree_1" value="<?php if( empty($_POST['agree_1'])){ echo ''; }else { echo $_POST['agree_1']; }?>">
                    <input type="hidden" name="agree_2" value="<?php if( empty($_POST['agree_2'])){ echo ''; }else { echo $_POST['agree_2']; }?>">
                    <input type="hidden" name="agree_student" value="<?php if( empty($_POST['agree_student'])){ echo ''; }else { echo $_POST['agree_student']; }?>">
                    <input type="hidden" name="agree_special" value="<?php if( empty($_POST['agree_special'])){ echo ''; }else { echo $_POST['agree_special']; }?>">
                    <input type="hidden" name="agree_usual" value="<?php if( empty($_POST['agree_usual'])){ echo ''; }else { echo $_POST['agree_usual']; }?>">
                </form>

            </div>
        </div>
    </section>

</main>


<!-- ここまで確認ページが入る -->

    <?php elseif( $page_flag === 2 ): ?>
    <?php get_header(); ?>

    <div class="breadcrumbs joining" typeof="BreadcrumbList" vocab="https://schema.org/">
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
<main class="inquiry joining">

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

    <section class="about joining">
        <div class="container">
            <div class="sub-container">

                <h2 class="std7">ご入会フォーム</h2>
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
                        <label for="">氏名</label>
                        <p>必須</p>
                    </div>
                    <div class="flex-item">
                        <p>
                            <input type="text" name="your_name" value="<?php if( !empty($_POST['your_name']) ){ echo $_POST['your_name']; } ?>" placeholder="山田 太郎">
                        </p>
                    </div>

                    <div class="label-flex">
                        <label for="">フリガナ</label>
                        <p>必須</p>
                    </div>
                    <div class="flex-item">
                        <p>
                            <input type="text" name="hurigana" value="<?php if( !empty($_POST['hurigana']) ){ echo $_POST['hurigana']; } ?>" placeholder="ヤマダ タロウ">
                        </p>
                    </div>

                    <div class="label-flex">
                        <label for="">メールアドレス</label>
                        <p>必須</p>
                    </div>
                    <div class="flex-item">
                        <p>
                            <input type="email" name="email" value="<?php if( !empty($_POST['email']) ){ echo $_POST['email']; } ?>" placeholder="example@sample.com">
                        </p>
                    </div>

                    <div class="label-flex">
                        <label for="">電話番号</label>
                        <p>必須</p>
                    </div>
                    <div class="flex-item">
                        <p>
                            <input type="text" name="tel" value="<?php if( !empty($_POST['tel']) ){ echo $_POST['tel']; } ?>" placeholder="000-0000-0000">
                        </p>
                    </div>

                    <div class="label-flex">
                        <label for="">郵便番号</label>
                        <p>必須</p>
                    </div>
                    <div class="flex-item">
                        <p>
                            <input type="text" name="your_postcode" value="<?php if( !empty($_POST['your_postcode']) ){ echo $_POST['your_postcode']; } ?>" placeholder="000-0000">
                        </p>
                    </div>
                    
                    <div class="label-flex">
                        <label for="">住所</label>
                        <p>必須</p>
                    </div>
                    <div class="flex-item">
                        <p>
                            <input type="text" name="your_address" value="<?php if( !empty($_POST['your_address']) ){ echo $_POST['your_address']; } ?>" placeholder="">
                        </p>
                    </div>

                    <div class="label-flex">
                        <label for="">性別</label>
                    </div>
                    <select name="gender" class="select">
                        <option vallue="" <?php if( !empty($_POST['gender']) && $_POST['gender'] === "選択してください" ){ echo 'selected'; } ?>>選択してください</option>
                        <option value="男性" <?php if( !empty($_POST['gender']) && $_POST['gender'] === "男性" ){ echo 'selected'; } ?>>男性</option>
                        <option value="女性" <?php if( !empty($_POST['gender']) && $_POST['gender'] === "女性" ){ echo 'selected'; } ?>>女性</option>
                    </select>

                    <div class="label-flex up">
                        <label for="">生年月日</label>
                        <p>必須</p>
                    </div>
                    <div class="flex-item">
                        <p class="birth">
                            <input type="date" name="birth" value="<?php if( !empty($_POST['birth']) ){ echo $_POST['birth']; } ?>" >
                        </p>
                    </div>

                    <div class="label-flex">
                        <label for="">国家資格の免許の種類</label>
                        <p class="as">※国家資格保有者のみ</p>
                    </div>
                    <select class="select scroll" name="qualification">
                        <option vallue="選択してください" style="color:#A1A1A1;" <?php if( !empty($_POST['qualification']) && $_POST['qualification'] === "選択してください" ){ echo 'selected'; } ?> >選択してください</option>
                        <option value="医師" <?php if( !empty($_POST['qualification']) && $_POST['qualification'] === "医師" ){ echo 'selected'; } ?>>医師</option>
                        <option value="歯科医師" <?php if( !empty($_POST['qualification']) && $_POST['qualification'] === "歯科医師" ){ echo 'selected'; } ?>>歯科医師</option>
                        <option value="薬剤師" <?php if( !empty($_POST['qualification']) && $_POST['qualification'] === "薬剤師" ){ echo 'selected'; } ?>>薬剤師</option>
                        <option value="保健師" <?php if( !empty($_POST['qualification']) && $_POST['qualification'] === "保健師" ){ echo 'selected'; } ?>>保健師</option>
                        <option value="助産師" <?php if( !empty($_POST['qualification']) && $_POST['qualification'] === "助産師" ){ echo 'selected'; } ?>>助産師</option>
                        <option value="看護師" <?php if( !empty($_POST['qualification']) && $_POST['qualification'] === "看護師" ){ echo 'selected'; } ?>>看護師</option>
                        <option value="診療放射線技師" <?php if( !empty($_POST['qualification']) && $_POST['qualification'] === "診療放射線技師" ){ echo 'selected'; } ?>>診療放射線技師</option>
                        <option value="臨床検査技師" <?php if( !empty($_POST['qualification']) && $_POST['qualification'] === "臨床検査技師" ){ echo 'selected'; } ?>>臨床検査技師</option>
                        <option value="臨床工学技士" <?php if( !empty($_POST['qualification']) && $_POST['qualification'] === "臨床工学技士" ){ echo 'selected'; } ?>>臨床工学技士</option>
                        <option value="衛生検査技師" <?php if( !empty($_POST['qualification']) && $_POST['qualification'] === "衛生検査技師" ){ echo 'selected'; } ?>>衛生検査技師</option>
                        <option value="あん摩マッサージ指圧師" <?php if( !empty($_POST['qualification']) && $_POST['qualification'] === "あん摩マッサージ指圧師" ){ echo 'selected'; } ?>>あん摩マッサージ指圧師</option>
                        <option value="はり師" <?php if( !empty($_POST['qualification']) && $_POST['qualification'] === "はり師" ){ echo 'selected'; } ?>>はり師</option>
                        <option value="きゅう師" <?php if( !empty($_POST['qualification']) && $_POST['qualification'] === "きゅう師" ){ echo 'selected'; } ?>>きゅう師</option>
                        <option value="柔道整復師" <?php if( !empty($_POST['qualification']) && $_POST['qualification'] === "柔道整復師" ){ echo 'selected'; } ?>>柔道整復師</option>
                        <option value="理学療法士" <?php if( !empty($_POST['qualification']) && $_POST['qualification'] === "理学療法士" ){ echo 'selected'; } ?>>理学療法士</option>
                        <option value="作業療法士" <?php if( !empty($_POST['qualification']) && $_POST['qualification'] === "作業療法士" ){ echo 'selected'; } ?>>作業療法士</option>
                        <option value="視能訓練士" <?php if( !empty($_POST['qualification']) && $_POST['qualification'] === "視能訓練士" ){ echo 'selected'; } ?>>視能訓練士</option>
                        <option value="義肢装具士" <?php if( !empty($_POST['qualification']) && $_POST['qualification'] === "義肢装具士" ){ echo 'selected'; } ?>>義肢装具士</option>
                        <option value="歯科衛生士" <?php if( !empty($_POST['qualification']) && $_POST['qualification'] === "歯科衛生士" ){ echo 'selected'; } ?>>歯科衛生士</option>
                        <option value="歯科技工士" <?php if( !empty($_POST['qualification']) && $_POST['qualification'] === "歯科技工士" ){ echo 'selected'; } ?>>歯科技工士</option>
                        <option value="救急救命士" <?php if( !empty($_POST['qualification']) && $_POST['qualification'] === "救急救命士" ){ echo 'selected'; } ?>>救急救命士</option>
                        <option value="社会福祉士" <?php if( !empty($_POST['qualification']) && $_POST['qualification'] === "社会福祉士" ){ echo 'selected'; } ?>>社会福祉士</option>
                        <option value="介護福祉士" <?php if( !empty($_POST['qualification']) && $_POST['qualification'] === "介護福祉士" ){ echo 'selected'; } ?>>介護福祉士</option>
                        <option value="精神保健福祉士" <?php if( !empty($_POST['qualification']) && $_POST['qualification'] === "精神保健福祉士" ){ echo 'selected'; } ?>>精神保健福祉士</option>
                        <option value="言語聴覚士" <?php if( !empty($_POST['qualification']) && $_POST['qualification'] === "言語聴覚士" ){ echo 'selected'; } ?>>言語聴覚士</option>
                        <option value="管理栄養士" <?php if( !empty($_POST['qualification']) && $_POST['qualification'] === "管理栄養士" ){ echo 'selected'; } ?>>管理栄養士</option>
                        <option value="臨床心理士" <?php if( !empty($_POST['qualification']) && $_POST['qualification'] === "臨床心理士" ){ echo 'selected'; } ?>>臨床心理士</option>
                        <option value="健康運動指導士" <?php if( !empty($_POST['qualification']) && $_POST['qualification'] === "健康運動指導士" ){ echo 'selected'; } ?>>健康運動指導士</option>
                        <option value="運動療法士" <?php if( !empty($_POST['qualification']) && $_POST['qualification'] === "運動療法士" ){ echo 'selected'; } ?>>運動療法士</option>
                        <option value="音楽療法士" <?php if( !empty($_POST['qualification']) && $_POST['qualification'] === "音楽療法士" ){ echo 'selected'; } ?>>音楽療法士</option>
                        <option value="医療環境管理士" <?php if( !empty($_POST['qualification']) && $_POST['qualification'] === "医療環境管理士" ){ echo 'selected'; } ?>>医療環境管理士</option>
                        <option value="獣医" <?php if( !empty($_POST['qualification']) && $_POST['qualification'] === "獣医" ){ echo 'selected'; } ?>>獣医</option>
                        <option value="その他" <?php if( !empty($_POST['qualification']) && $_POST['qualification'] === "その他" ){ echo 'selected'; } ?>>その他</option>
                    </select>

                    <div class="label-flex up">
                        <label for="">国家資格の免許の種類</label>
                        <p class="as">※その他を選んだ方のみ</p>
                    </div>
                    <div class="flex-item">
                        <p>
                            <input type="text" name="others" value="<?php if( !empty($_POST['others']) ){ echo $_POST['others']; } ?>" placeholder="">
                        </p>
                    </div>

                    <div class="label-flex">
                        <label for="">所属施設名<br class="sp">( 病院、クリニック、会社、学校等 )</label>
                        <p>必須</p>
                    </div>
                    <div class="flex-item">
                        <p>
                            <input type="text" name="corporate_name" value="<?php if( !empty($_POST['corporate_name']) ){ echo $_POST['corporate_name']; } ?>" placeholder="">
                        </p>
                    </div>

                    <div class="label-flex">
                        <label for="">郵便番号（病院、クリニック、会社、学校等）</label>
                    </div>
                    <div class="flex-item">
                        <p>
                            <input type="text" name="postcode" value="<?php if( !empty($_POST['postcode']) ){ echo $_POST['postcode']; } ?>" placeholder="000-0000">
                        </p>
                    </div>

                    <div class="label-flex">
                        <label for="">住所（病院、クリニック、会社、学校等）</label>
                    </div>
                    <div class="flex-item">
                        <p>
                            <input type="text" name="address" value="<?php if( !empty($_POST['address']) ){ echo $_POST['address']; } ?>" placeholder="">
                        </p>
                    </div>

                    <div class="label-flex">
                        <label for="">電話番号（病院、クリニック、会社、学校等）</label>
                    </div>
                    <div class="flex-item">
                        <p>
                            <input type="text" name="clinic_tel" value="<?php if( !empty($_POST['clinic_tel']) ){ echo $_POST['clinic_tel']; } ?>" placeholder="000-0000-0000">
                        </p>
                    </div>

                    <div class="label-flex">
                        <label for="">連絡先・書類送付先</label>
                        <p>必須</p>
                    </div>
                    <select name="destination" class="select">
                        <option vallue="" <?php if( !empty($_POST['destination']) ){ echo ''; } ?> disabled selected style="display:none;color: #A1A1A1;">選択してください</option>
                        <option value="自宅" <?php if( !empty($_POST['destination']) && $_POST['destination'] === "自宅" ){ echo 'selected'; } ?>>自宅</option>
                        <option value="職場" <?php if( !empty($_POST['destination']) && $_POST['destination'] === "職場" ){ echo 'selected'; } ?>>職場</option>
                    </select>

                    <div class="label-flex up">
                        <label for="">会員区分</label>
                    </div>
                    <select name="type" class="select myselectbox" onchange="myfunc()">
                        <option vallue="" <?php if( !empty($_POST['type']) && $_POST['type'] === "選択してください" ){ echo 'selected'; } ?>>選択してください</option>
                        <option value="正会員A" <?php if( !empty($_POST['type']) && $_POST['type'] === "正会員A" ){ echo 'selected'; } ?>>正会員A</option>
                        <option value="正会員B" <?php if( !empty($_POST['type']) && $_POST['type'] === "正会員B" ){ echo 'selected'; } ?>>正会員B</option>
                        <option value="一般会員" <?php if( !empty($_POST['type']) && $_POST['type'] === "一般会員" ){ echo 'selected'; } ?>>一般会員</option>
                        <option value="学生会員" <?php if( !empty($_POST['type']) && $_POST['type'] === "学生会員" ){ echo 'selected'; } ?>>学生会員</option>
                        <option value="賛助会員" <?php if( !empty($_POST['type']) && $_POST['type'] === "賛助会員" ){ echo 'selected'; } ?>>賛助会員</option>
                        <option value="特別賛助会員" <?php if( !empty($_POST['type']) && $_POST['type'] === "特別賛助会員" ){ echo 'selected'; } ?>>特別賛助会員</option>
                    </select>


                     <!-- [賛助会員][特別賛助会員] -->
                    <div class="target hidden">

                        <div class="label-flex up">
                            <label for="">団体、企業</label>
                            <p>必須</p>
                        </div>
                        <select class="select scroll" name="organization">
                            <option vallue="選択してください" <?php if( !empty($_POST['organization']) ){ echo ''; } ?> disabled selected style="display:none;color: #A1A1A1;">選択してください</option>
                            <option value="公務・公共団体" <?php if( !empty($_POST['organization']) && $_POST['organization'] === "公務・公共団体" ){ echo 'selected'; } ?>>公務・公共団体</option>
                            <option value="製薬関連" <?php if( !empty($_POST['organization']) && $_POST['organization'] === "製薬関連" ){ echo 'selected'; } ?>>製薬関連</option>
                            <option value="薬品卸" <?php if( !empty($_POST['organization']) && $_POST['organization'] === "薬品卸" ){ echo 'selected'; } ?>>薬品卸</option>
                            <option value="薬品販売" <?php if( !empty($_POST['organization']) && $_POST['organization'] === "薬品販売" ){ echo 'selected'; } ?>>薬品販売</option>
                            <option value="化粧品関連" <?php if( !empty($_POST['organization']) && $_POST['organization'] === "化粧品関連" ){ echo 'selected'; } ?>>化粧品関連</option>
                            <option value="食品関連" <?php if( !empty($_POST['organization']) && $_POST['organization'] === "食品関連" ){ echo 'selected'; } ?>>食品関連</option>
                            <option value="健康関連" <?php if( !empty($_POST['organization']) && $_POST['organization'] === "健康関連" ){ echo 'selected'; } ?>>健康関連</option>
                            <option value="施設（医療）" <?php if( !empty($_POST['organization']) && $_POST['organization'] === "施設（医療）" ){ echo 'selected'; } ?>>施設（医療）</option>
                            <option value="施設（介護）" <?php if( !empty($_POST['organization']) && $_POST['organization'] === "施設（介護）" ){ echo 'selected'; } ?>>施設（介護）</option>
                            <option value="施設（老人施設）" <?php if( !empty($_POST['organization']) && $_POST['organization'] === "施設（老人施設）" ){ echo 'selected'; } ?>>施設（老人施設）</option>
                            <option value="医療機器・医療用品関連" <?php if( !empty($_POST['organization']) && $_POST['organization'] === "医療機器・医療用品関連" ){ echo 'selected'; } ?>>医療機器・医療用品関連</option>
                            <option value="健康機器・健康用品関連" <?php if( !empty($_POST['organization']) && $_POST['organization'] === "健康機器・健康用品関連" ){ echo 'selected'; } ?>>健康機器・健康用品関連</option>
                            <option value="スポーツ・運動施設" <?php if( !empty($_POST['organization']) && $_POST['organization'] === "スポーツ・運動施設" ){ echo 'selected'; } ?>>スポーツ・運動施設</option>
                            <option value="マスコミ・メディア" <?php if( !empty($_POST['organization']) && $_POST['organization'] === "マスコミ・メディア" ){ echo 'selected'; } ?>>マスコミ・メディア</option>
                            <option value="教育関連業" <?php if( !empty($_POST['organization']) && $_POST['organization'] === "教育関連業" ){ echo 'selected'; } ?>>教育関連業</option>
                            <option value="農業" <?php if( !empty($_POST['organization']) && $_POST['organization'] === "農業" ){ echo 'selected'; } ?>>農業</option>
                            <option value="建設業" <?php if( !empty($_POST['organization']) && $_POST['organization'] === "建設業" ){ echo 'selected'; } ?>>建設業</option>
                            <option value="製造業" <?php if( !empty($_POST['organization']) && $_POST['organization'] === "製造業" ){ echo 'selected'; } ?>>製造業</option>
                            <option value="電気ガス熱水道業" <?php if( !empty($_POST['organization']) && $_POST['organization'] === "電気ガス熱水道業" ){ echo 'selected'; } ?>>電気ガス熱水道業</option>
                            <option value="情報通信業" <?php if( !empty($_POST['organization']) && $_POST['organization'] === "情報通信業" ){ echo 'selected'; } ?>>情報通信業</option>
                            <option value="運輸業" <?php if( !empty($_POST['organization']) && $_POST['organization'] === "運輸業" ){ echo 'selected'; } ?>>運輸業</option>
                            <option value="卸売り・小売業" <?php if( !empty($_POST['organization']) && $_POST['organization'] === "卸売り・小売業" ){ echo 'selected'; } ?>>卸売り・小売業</option>
                            <option value="金融・保険業" <?php if( !empty($_POST['organization']) && $_POST['organization'] === "金融・保険業" ){ echo 'selected'; } ?>>金融・保険業</option>
                            <option value="不動産業" <?php if( !empty($_POST['organization']) && $_POST['organization'] === "不動産業" ){ echo 'selected'; } ?>>不動産業</option>
                            <option value="飲食店・宿泊業" <?php if( !empty($_POST['organization']) && $_POST['organization'] === "飲食店・宿泊業" ){ echo 'selected'; } ?>>飲食店・宿泊業</option>
                            <option value="医療・福祉業" <?php if( !empty($_POST['organization']) && $_POST['organization'] === "医療・福祉業" ){ echo 'selected'; } ?>>医療・福祉業</option>
                            <option value="サービス業" <?php if( !empty($_POST['organization']) && $_POST['organization'] === "サービス業" ){ echo 'selected'; } ?>>サービス業</option>
                            <option value="美容関連" <?php if( !empty($_POST['organization']) && $_POST['organization'] === "美容関連" ){ echo 'selected'; } ?>>美容関連</option>
                            <option value="その他" <?php if( !empty($_POST['organization']) && $_POST['organization'] === "その他" ){ echo 'selected'; } ?>>その他</option>
                        </select>

                        <div class="label-flex up">
                            <label for="">団体、企業</label>
                            <p class="as">※その他を選んだ方のみ</p>
                        </div>
                        <div class="flex-item">
                            <p>
                                <input type="text" name="other_organization" value="<?php if( !empty($_POST['other_organization']) ){ echo $_POST['other_organization']; } ?>" placeholder="">
                            </p>
                        </div>
                    
                        <div class="label-flex">
                            <label for="">企業名</label>
                            <p>必須</p>
                        </div>
                        <div class="flex-item">
                            <p>
                                <input type="text" name="company" value="<?php if( !empty($_POST['company']) ){ echo $_POST['company']; } ?>" placeholder="">
                            </p>
                        </div>

                        <div class="label-flex">
                            <label for="">企業アドレス</label>
                            <p>必須</p>
                        </div>
                        <div class="flex-item">
                            <p>
                                <input type="text" name="company_address" value="<?php if( !empty($_POST['company_address']) ){ echo $_POST['company_address']; } ?>" placeholder="">
                            </p>
                        </div>

                        <div class="label-flex">
                            <label for="">担当者</label>
                            <p>必須</p>
                        </div>
                        <div class="flex-item">
                            <p>
                                <input type="text" name="manager" value="<?php if( !empty($_POST['manager']) ){ echo $_POST['manager']; } ?>" placeholder="">
                            </p>
                        </div>

                        <div class="label-flex">
                            <label for="">企業URL</label>
                            <p>必須</p>
                        </div>
                        <div class="flex-item">
                            <p>
                                <input type="text" name="company_url" value="<?php if( !empty($_POST['company_url']) ){ echo $_POST['company_url']; } ?>" placeholder="">
                            </p>
                        </div>    

                        <div class="label-flex up">
                            <label for="">支払い方法</label>
                        </div>
                        <select name="payment" class="select">
                            <option vallue="" <?php if( !empty($_POST['payment']) && $_POST['payment'] === "選択してください" ){ echo 'selected'; } ?>>選択してください</option>
                            <option value="銀行振込" <?php if( !empty($_POST['payment']) && $_POST['payment'] === "銀行振込" ){ echo 'selected'; } ?>>銀行振込</option>
                            <option value="クレジットカード決済" <?php if( !empty($_POST['payment']) && $_POST['payment'] === "クレジットカード決済" ){ echo 'selected'; } ?>>クレジットカード決済</option>
                        </select>


                        <div class="agree">
                            <input type="checkbox" name="agree_special" value="同意" <?php if( !empty($clean['agree_special']) && $clean['agree_special'] === "1" ){ echo 'checked'; } ?>>
                            <label for="agreement">入会にあたり審査がございます。<br>審査結果は申し込み完了後に担当者よりご連絡致します。</label>
                        </div>

                    </div>


                     <!-- [正会員A] -->
                    <div class="target hidden">
                    
                        <div class="label-flex up">
                            <label for="">医師、歯科医師 (基本分野)</label>
                            <p>必須</p>
                        </div>
                        <select class="select scroll" name="field">
                            <option vallue="選択してください" <?php if( !empty($_POST['field']) ){ echo ''; } ?> disabled selected style="display:none;color: #A1A1A1;">選択してください</option>
                            <option value="内科系" <?php if( !empty($_POST['field']) && $_POST['field'] === "内科系" ){ echo 'selected'; } ?>>内科系</option>
                            <option value="外科" <?php if( !empty($_POST['field']) && $_POST['field'] === "外科" ){ echo 'selected'; } ?>>外科</option>
                            <option value="眼科" <?php if( !empty($_POST['field']) && $_POST['field'] === "眼科" ){ echo 'selected'; } ?>>眼科</option>
                            <option value="耳鼻咽喉科" <?php if( !empty($_POST['field']) && $_POST['field'] === "耳鼻咽喉科" ){ echo 'selected'; } ?>>耳鼻咽喉科</option>
                            <option value="皮膚科" <?php if( !empty($_POST['field']) && $_POST['field'] === "皮膚科" ){ echo 'selected'; } ?>>皮膚科</option>
                            <option value="整形外科" <?php if( !empty($_POST['field']) && $_POST['field'] === "整形外科" ){ echo 'selected'; } ?>>整形外科</option>
                            <option value="脳神経外科" <?php if( !empty($_POST['field']) && $_POST['field'] === "脳神経外科" ){ echo 'selected'; } ?>>脳神経外科</option>
                            <option value="心臓外科" <?php if( !empty($_POST['field']) && $_POST['field'] === "心臓外科" ){ echo 'selected'; } ?>>心臓外科</option>
                            <option value="形成・美容外科" <?php if( !empty($_POST['field']) && $_POST['field'] === "形成・美容外科" ){ echo 'selected'; } ?>>形成・美容外科</option>
                            <option value="小児科" <?php if( !empty($_POST['field']) && $_POST['field'] === "小児科" ){ echo 'selected'; } ?>>小児科</option>
                            <option value="泌尿器科" <?php if( !empty($_POST['field']) && $_POST['field'] === "泌尿器科" ){ echo 'selected'; } ?>>泌尿器科</option>
                            <option value="リハビリテーション科" <?php if( !empty($_POST['field']) && $_POST['field'] === "リハビリテーション科" ){ echo 'selected'; } ?>>リハビリテーション科</option>
                            <option value="放射線科" <?php if( !empty($_POST['field']) && $_POST['field'] === "放射線科" ){ echo 'selected'; } ?>>放射線科</option>
                            <option value="救急科" <?php if( !empty($_POST['field']) && $_POST['field'] === "救急科" ){ echo 'selected'; } ?>>救急科</option>
                            <option value="麻酔科" <?php if( !empty($_POST['field']) && $_POST['field'] === "麻酔科" ){ echo 'selected'; } ?>>麻酔科</option>
                            <option value="精神・神経科" <?php if( !empty($_POST['field']) && $_POST['field'] === "精神・神経科" ){ echo 'selected'; } ?>>精神・神経科</option>
                            <option value="東洋医学" <?php if( !empty($_POST['field']) && $_POST['field'] === "東洋医学" ){ echo 'selected'; } ?>>東洋医学</option>
                            <option value="病理科" <?php if( !empty($_POST['field']) && $_POST['field'] === "病理科" ){ echo 'selected'; } ?>>病理科</option>
                            <option value="婦人科" <?php if( !empty($_POST['field']) && $_POST['field'] === "婦人科" ){ echo 'selected'; } ?>>婦人科</option>
                            <option value="臨床検査科" <?php if( !empty($_POST['field']) && $_POST['field'] === "臨床検査科" ){ echo 'selected'; } ?>>臨床検査科</option>
                            <option value="基礎系医学" <?php if( !empty($_POST['field']) && $_POST['field'] === "基礎系医学" ){ echo 'selected'; } ?>>基礎系医学</option>
                            <option value="口腔・歯科" <?php if( !empty($_POST['field']) && $_POST['field'] === "口腔・歯科" ){ echo 'selected'; } ?>>口腔・歯科</option>
                            <option value="その他" <?php if( !empty($_POST['field']) && $_POST['field'] === "その他" ){ echo 'selected'; } ?>>その他（基本分野ならびに専門領域にない分野）</option>
                        </select>

                        <div class="label-flex up">
                            <label for="">医師、歯科医師 (基本分野ならびに専門領域にない分野)</label>
                            <p class="as">※その他を選んだ方のみ</p>
                        </div>
                        <div class="flex-item">
                            <p>
                                <input type="text" name="other_field" value="<?php if( !empty($_POST['other_field']) ){ echo $_POST['other_field']; } ?>" placeholder="">
                            </p>
                        </div>

                        <div class="label-flex">
                            <label for="">国家資格免許番号</label>
                            <p>必須</p>
                        </div>
                        <div class="flex-item">
                            <p>
                                <input type="text" name="a_number" value="<?php if( !empty($_POST['a_number']) ){ echo $_POST['a_number']; } ?>" placeholder="">
                            </p>
                        </div>

                        <div class="label-flex">
                            <label for="">取得年月日</label>
                            <p>必須</p>
                        </div>
                        <div class="flex-item">
                            <p>
                                <input type="date" name="a_acquisition" value="<?php if( !empty($_POST['a_acquisition']) ){ echo $_POST['a_acquisition']; } ?>" >
                            </p>
                        </div>
                    </div>

                    <!-- [正会員B] -->
                    <div class="target hidden">
                    
                        <div class="label-flex up">
                            <label for="">医療従事者（専門）</label>
                            <p>必須</p>
                        </div>
                        <select class="select scroll" name="specialty">
                            <option vallue="選択してください" <?php if( !empty($_POST['specialty']) ){ echo ''; } ?> disabled selected style="display:none;color: #A1A1A1;">選択してください</option>
                            <option value="医師" <?php if( !empty($_POST['specialty']) && $_POST['specialty'] === "医師" ){ echo 'selected'; } ?>>医師</option>
                            <option value="歯科医師" <?php if( !empty($_POST['specialty']) && $_POST['specialty'] === "歯科医師" ){ echo 'selected'; } ?>>歯科医師</option>
                            <option value="薬剤師" <?php if( !empty($_POST['specialty']) && $_POST['specialty'] === "薬剤師" ){ echo 'selected'; } ?>>薬剤師</option>
                            <option value="保健師" <?php if( !empty($_POST['specialty']) && $_POST['specialty'] === "保健師" ){ echo 'selected'; } ?>>保健師</option>
                            <option value="助産師" <?php if( !empty($_POST['specialty']) && $_POST['specialty'] === "助産師" ){ echo 'selected'; } ?>>助産師</option>
                            <option value="看護師" <?php if( !empty($_POST['specialty']) && $_POST['specialty'] === "看護師" ){ echo 'selected'; } ?>>看護師</option>
                            <option value="診療放射線技師" <?php if( !empty($_POST['specialty']) && $_POST['specialty'] === "診療放射線技師" ){ echo 'selected'; } ?>>診療放射線技師</option>
                            <option value="臨床検査技師" <?php if( !empty($_POST['specialty']) && $_POST['specialty'] === "臨床検査技師" ){ echo 'selected'; } ?>>臨床検査技師</option>
                            <option value="臨床工学技士" <?php if( !empty($_POST['specialty']) && $_POST['specialty'] === "臨床工学技士" ){ echo 'selected'; } ?>>臨床工学技士</option>
                            <option value="衛生検査技師" <?php if( !empty($_POST['specialty']) && $_POST['specialty'] === "衛生検査技師" ){ echo 'selected'; } ?>>衛生検査技師</option>
                            <option value="あん摩マッサージ指圧師" <?php if( !empty($_POST['specialty']) && $_POST['specialty'] === "あん摩マッサージ指圧師" ){ echo 'selected'; } ?>>あん摩マッサージ指圧師</option>
                            <option value="はり師" <?php if( !empty($_POST['specialty']) && $_POST['specialty'] === "はり師" ){ echo 'selected'; } ?>>はり師</option>
                            <option value="きゅう師" <?php if( !empty($_POST['specialty']) && $_POST['specialty'] === "きゅう師" ){ echo 'selected'; } ?>>きゅう師</option>
                            <option value="柔道整復師" <?php if( !empty($_POST['specialty']) && $_POST['specialty'] === "柔道整復師" ){ echo 'selected'; } ?>>柔道整復師</option>
                            <option value="理学療法士" <?php if( !empty($_POST['specialty']) && $_POST['specialty'] === "理学療法士" ){ echo 'selected'; } ?>>理学療法士</option>
                            <option value="作業療法士" <?php if( !empty($_POST['specialty']) && $_POST['specialty'] === "作業療法士" ){ echo 'selected'; } ?>>作業療法士</option>
                            <option value="視能訓練士" <?php if( !empty($_POST['specialty']) && $_POST['specialty'] === "視能訓練士" ){ echo 'selected'; } ?>>視能訓練士</option>
                            <option value="義肢装具士" <?php if( !empty($_POST['specialty']) && $_POST['specialty'] === "義肢装具士" ){ echo 'selected'; } ?>>義肢装具士</option>
                            <option value="歯科衛生士" <?php if( !empty($_POST['specialty']) && $_POST['specialty'] === "歯科衛生士" ){ echo 'selected'; } ?>>歯科衛生士</option>
                            <option value="歯科技工士" <?php if( !empty($_POST['specialty']) && $_POST['specialty'] === "歯科技工士" ){ echo 'selected'; } ?>>歯科技工士</option>
                            <option value="救急救命士" <?php if( !empty($_POST['specialty']) && $_POST['specialty'] === "救急救命士" ){ echo 'selected'; } ?>>救急救命士</option>
                            <option value="社会福祉士" <?php if( !empty($_POST['specialty']) && $_POST['specialty'] === "社会福祉士" ){ echo 'selected'; } ?>>社会福祉士</option>
                            <option value="介護福祉士" <?php if( !empty($_POST['specialty']) && $_POST['specialty'] === "介護福祉士" ){ echo 'selected'; } ?>>介護福祉士</option>
                            <option value="精神保健福祉士" <?php if( !empty($_POST['specialty']) && $_POST['specialty'] === "精神保健福祉士" ){ echo 'selected'; } ?>>精神保健福祉士</option>
                            <option value="言語聴覚士" <?php if( !empty($_POST['specialty']) && $_POST['specialty'] === "言語聴覚士" ){ echo 'selected'; } ?>>言語聴覚士</option>
                            <option value="管理栄養士" <?php if( !empty($_POST['specialty']) && $_POST['specialty'] === "管理栄養士" ){ echo 'selected'; } ?>>管理栄養士</option>
                            <option value="臨床心理士" <?php if( !empty($_POST['specialty']) && $_POST['specialty'] === "臨床心理士" ){ echo 'selected'; } ?>>臨床心理士</option>
                            <option value="健康運動指導士" <?php if( !empty($_POST['specialty']) && $_POST['specialty'] === "健康運動指導士" ){ echo 'selected'; } ?>>健康運動指導士</option>
                            <option value="運動療法士" <?php if( !empty($_POST['specialty']) && $_POST['specialty'] === "運動療法士" ){ echo 'selected'; } ?>>運動療法士</option>
                            <option value="音楽療法士" <?php if( !empty($_POST['specialty']) && $_POST['specialty'] === "音楽療法士" ){ echo 'selected'; } ?>>音楽療法士</option>
                            <option value="医療環境管理士" <?php if( !empty($_POST['specialty']) && $_POST['specialty'] === "医療環境管理士" ){ echo 'selected'; } ?>>医療環境管理士</option>
                            <option value="獣医" <?php if( !empty($_POST['specialty']) && $_POST['specialty'] === "獣医" ){ echo 'selected'; } ?>>獣医</option>
                            <option value="その他" <?php if( !empty($_POST['specialty']) && $_POST['specialty'] === "その他" ){ echo 'selected'; } ?>>その他</option>
                        </select>

                        <div class="label-flex up">
                            <label for="">医療従事者（専門）</label>
                            <p class="as">※その他を選んだ方のみ</p>
                        </div>
                        <div class="flex-item">
                            <p>
                                <input type="text" name="other_specialty" value="<?php if( !empty($_POST['other_specialty']) ){ echo $_POST['other_specialty']; } ?>" placeholder="">
                            </p>
                        </div>

                        <div class="label-flex">
                            <label for="">国家資格免許番号</label>
                            <p>必須</p>
                        </div>
                        <div class="flex-item">
                            <p>
                                <input type="text" name="b_number" value="<?php if( !empty($_POST['b_number']) ){ echo $_POST['b_number']; } ?>" placeholder="">
                            </p>
                        </div>

                        <div class="label-flex">
                            <label for="">取得年月日</label>
                            <p>必須</p>
                        </div>
                        <div class="flex-item">
                            <p>
                                <input type="date" name="b_acquisition" value="<?php if( !empty($_POST['b_acquisition']) ){ echo $_POST['b_acquisition']; } ?>" >
                            </p>
                        </div>
                        
                    </div>

                    <!-- [学生会員] -->
                    <div class="target hidden">
                    
                        <div class="label-flex up">
                            <label for="">学生分野</label>
                            <p>必須</p>
                        </div>
                        <select class="select scroll" name="student">
                            <option vallue="選択してください" <?php if( !empty($_POST['student']) ){ echo ''; } ?> disabled selected style="display:none;color: #A1A1A1;">選択してください</option>
                            <option value="学生 医学" <?php if( !empty($_POST['student']) && $_POST['student'] === "学生 医学" ){ echo 'selected'; } ?>>学生 医学</option>
                            <option value="学生 歯学" <?php if( !empty($_POST['student']) && $_POST['student'] === "学生 歯学" ){ echo 'selected'; } ?>>学生 歯学</option>
                            <option value="学生 栄養" <?php if( !empty($_POST['student']) && $_POST['student'] === "学生 栄養" ){ echo 'selected'; } ?>>学生 栄養</option>
                            <option value="学生 科学" <?php if( !empty($_POST['student']) && $_POST['student'] === "学生 科学" ){ echo 'selected'; } ?>>学生 科学</option>
                            <option value="学生 看護学" <?php if( !empty($_POST['student']) && $_POST['student'] === "学生 看護学" ){ echo 'selected'; } ?>>学生 看護学</option>
                            <option value="学生 工学" <?php if( !empty($_POST['student']) && $_POST['student'] === "学生 工学" ){ echo 'selected'; } ?>>学生 工学</option>
                            <option value="学生 社会福祉・介護関係" <?php if( !empty($_POST['student']) && $_POST['student'] === "学生 社会福祉・介護関係" ){ echo 'selected'; } ?>>学生 社会福祉・介護関係</option>
                            <option value="学生 スポーツ健康" <?php if( !empty($_POST['student']) && $_POST['student'] === "学生 スポーツ健康" ){ echo 'selected'; } ?>>学生 スポーツ健康</option>
                            <option value="学生 生物学" <?php if( !empty($_POST['student']) && $_POST['student'] === "学生 生物学" ){ echo 'selected'; } ?>>学生 生物学</option>
                            <option value="学生 薬学" <?php if( !empty($_POST['student']) && $_POST['student'] === "学生 薬学" ){ echo 'selected'; } ?>>学生 薬学</option>
                            <option value="学生 能楽" <?php if( !empty($_POST['student']) && $_POST['student'] === "学生 能楽" ){ echo 'selected'; } ?>>学生 能楽</option>
                            <option value="学生 専門学校" <?php if( !empty($_POST['student']) && $_POST['student'] === "学生 専門学校" ){ echo 'selected'; } ?>>学生 専門学校</option>
                            <option value="学生 その他" <?php if( !empty($_POST['student']) && $_POST['student'] === "学生 その他" ){ echo 'selected'; } ?>>学生 その他</option>
                            <option value="大学院 医学系" <?php if( !empty($_POST['student']) && $_POST['student'] === "大学院 医学系" ){ echo 'selected'; } ?>>大学院 医学系</option>
                            <option value="大学院 歯科系" <?php if( !empty($_POST['student']) && $_POST['student'] === "大学院 歯科系" ){ echo 'selected'; } ?>>大学院 歯科系</option>
                            <option value="精神・神経科" <?php if( !empty($_POST['student']) && $_POST['student'] === "精神・神経科" ){ echo 'selected'; } ?>>精神・神経科</option>
                            <option value="大学院 社会福祉・介護系" <?php if( !empty($_POST['student']) && $_POST['student'] === "大学院 社会福祉・介護系" ){ echo 'selected'; } ?>>大学院 社会福祉・介護系</option>
                            <option value="大学院 看護系" <?php if( !empty($_POST['student']) && $_POST['student'] === "大学院 看護系" ){ echo 'selected'; } ?>>大学院 看護系</option>
                            <option value="大学院 栄養系" <?php if( !empty($_POST['student']) && $_POST['student'] === "大学院 栄養系" ){ echo 'selected'; } ?>>大学院 栄養系</option>
                            <option value="大学院 化学系" <?php if( !empty($_POST['student']) && $_POST['student'] === "大学院 化学系" ){ echo 'selected'; } ?>>大学院 化学系</option>
                            <option value="大学院 生物系" <?php if( !empty($_POST['student']) && $_POST['student'] === "大学院 生物系" ){ echo 'selected'; } ?>>大学院 生物系</option>
                            <option value="大学院 工学系" <?php if( !empty($_POST['student']) && $_POST['student'] === "大学院 工学系" ){ echo 'selected'; } ?>>大学院 工学系</option>
                            <option value="大学院 その他" <?php if( !empty($_POST['student']) && $_POST['student'] === "大学院 その他" ){ echo 'selected'; } ?>>大学院 その他</option>
                        </select>

                        <div class="label-flex up">
                            <label for="">学生分野</label>
                            <p class="as">※その他を選んだ方のみ</p>
                        </div>
                        <div class="flex-item">
                            <p>
                                <input type="text" name="other_students" value="<?php if( !empty($_POST['other_students']) ){ echo $_POST['other_students']; } ?>" placeholder="">
                            </p>
                        </div>

                        <div class="agree">
                            <input type="checkbox" name="agree_student" value="同意" <?php if( !empty($clean['agree_student']) && $clean['agree_student'] === "1" ){ echo 'checked'; } ?>>
                            <label for="agreement">学生証の提出が必須になります。<br class="sp">申込完了後に公式LINEに送付をお願い致します。</label>
                        </div>

                    </div>

                    <!-- 一般会員 -->
                    <div class="target hidden">
                        <div class="label-flex up">
                            <label for="">推薦理事名</label>
                            <p>必須</p>
                        </div>
                        <div class="flex-item">
                            <p>
                                <input type="text" name="recommend_director" value="<?php if( !empty($_POST['recommend_director']) ){ echo $_POST['recommend_director']; } ?>" placeholder="">
                            </p>
                        </div>
                        <div class="label-flex up">
                            <label for="">推薦ID</label>
                            <p class="as">※任意</p>
                        </div>
                        <div class="flex-item">
                            <p>
                                <input type="text" name="recommend_id" value="<?php if( !empty($_POST['recommend_id']) ){ echo $_POST['recommend_id']; } ?>" placeholder="">
                            </p>
                        </div>
                        <div class="agree">
                            <input type="checkbox" name="agree_usual" value="同意" <?php if( !empty($clean['agree_usual']) && $clean['agree_usual'] === "1" ){ echo 'checked'; } ?>>
                            <label for="agreement">入会にあたり審査がございます。<br>審査結果は申し込み完了後に担当者よりご連絡致します。</label>
                        </div>
                    </div>

                    <div class="agree">
                        <input type="checkbox" name="agree_1" value="同意" <?php if( !empty($clean['agree_1']) && $clean['agree_1'] === "1" ){ echo 'checked'; } ?>>
                        <label for="agreement">虚偽の申請が明らかになった場合は、即時退会とする。その際、年会費等一切の返金は行わない。</label>
                    </div>

                    <div class="agree a2">
                        <input type="checkbox" name="agree_2" value="同意" <?php if( !empty($clean['agree_2']) && $clean['agree_2'] === "1" ){ echo 'checked'; } ?>>
                        <label for="agreement">個人情報保護方針に同意する。</label>
                    </div>

                    <div class="contact-attention">
                        <p>
                            当サイトは、以下のとおり個人情報保護方針を定め、その履行につとめてまいります。
                        </p>
                        <ol>
                            <li>個人情報を集めるときには、お客様等に対し、利用する目的を明確にし、その目的以外にはその情報は使用いたしません。</li>
                            <li>個人情報は漏えいを防止するため、安全に管理いたします。</li>
                            <li>個人情報を利用する際は、利用目的の範囲内で適切に行い、法令で認められている場合を除いて、ご本人の同意を取らないで第三者に提供するようなことはいたしません。</li>
                            <li>個人情報に関して本人から情報の開示、訂正、削除、利用停止等を求められたとき、速やかに対応いたします。また、個人情報を正確かつ最新の状態に保つよう努めます。</li>
                            <li>当サイトは、Googleのアクセス解析ツール「Googleアナリティクス」を利用しています。Googleアナリティクスはトラフィックデータ収集のためCookieを使用し、データは匿名で収集されています。したがって個人を特定しておりません。その機能はCookieを無効にすると収集を拒否できます。お使いのブラウザの設定をご確認ください。この規約に関して、詳しくはGoogle アナリティクス利用規約からご覧ください。</li>
                        </ol>
                    </div>

                    <div class="btn_submit">
                        <input id="open" type="submit" name="btn_confirm" value="入力内容を確認する">
                    </div>

                    <!-- バリデーションが発動した時の処理 -->
                    <?php if( !empty($_POST['type']) && $_POST['type'] === "賛助会員" | $_POST['type'] === "特別賛助会員" ): ?>
                        <script>
                            var target = document.getElementsByClassName("target")[0];
                            target.classList.remove('hidden');
                        </script>
                    <?php endif; ?>
                    <?php if( !empty($_POST['type']) && $_POST['type'] === "正会員A" ): ?>
                        <script>
                            var target = document.getElementsByClassName("target")[1];
                            target.classList.remove('hidden');
                        </script>
                    <?php endif; ?>
                    <?php if( !empty($_POST['type']) && $_POST['type'] === "正会員B" ): ?>
                        <script>
                            var target = document.getElementsByClassName("target")[2];
                            target.classList.remove('hidden');
                        </script>
                    <?php endif; ?>
                    <?php if( !empty($_POST['type']) && $_POST['type'] === "学生会員" ): ?>
                        <script>
                            var target = document.getElementsByClassName("target")[3];
                            target.classList.remove('hidden');
                        </script>
                    <?php endif; ?>
                    <?php if( !empty($_POST['type']) && $_POST['type'] === "一般会員" ): ?>
                        <script>
                            var target = document.getElementsByClassName("target")[4];
                            target.classList.remove('hidden');
                        </script>
                    <?php endif; ?>
                </form>

        </div>
    </section>

    <!-- ここまで問い合わせページが入る -->
    
    <?php endif; ?>
</main>

<?php get_footer(); ?>
