<?php

//$img_name_back = 'white.png';
$img_name_back = 'back.png';
$img_name_mini_icon1 = 'icon1.png';
$img_name_mini_icon2 = 'icon2.png';
$img_name_mini_icon3 = 'icon3.png';
$img_name_mini_icon4 = 'icon4.png';
$img_name_twitter = 'twitter.png';

$width_back_resized = 450;
$height_back_resized  = 300;

$width_icon_resized = 40;
$height_icon_resized  = 40;

$width_mini_icon_resized = 20;
$height_mini_icon_resized  = 20;

$width_twitter_resized = 30;
$height_twitter_resized  = 30;

$root_path = dirname(__FILE__);

//$font = 'WebKoruri.ttf';
//$font = 'GenShinGothic-Bold.ttf';
$font = 'GenShinGothic-Heavy.ttf';
if (PHP_OS == "WIN32" || PHP_OS == "WINNT") {
    // Windwos用の処理
    $font = "$root_path\\$font";
} else {
    // サーバ環境用の処理
    $font = "$root_path/$font";
}
$id_font_size = 8;
$font_size = 11;

$csvfilepath = $argv[1];

$file = new SplFileObject($csvfilepath);
$file->setFlags(SplFileObject::READ_CSV);
foreach ($file as $index => $line) {
  if (!is_null($line[0])) {
    $username = $line[0];
    $id = $line[1];
    $sentence = $line[2];
    $day = $line[3];
    $time = $line[4];
    $comments = $line[5];
    $RT = $line[6];
    $good = $line[7];
    $img_name_icon = $line[8];
    $output_number = $index + 1;
    $output_filename = "output/image$output_number.png";

    $img_back = imagecreatefrompng($img_name_back);
    $img_icon = imagecreatefrompng($img_name_icon);
    $img_mini_icon1 = imagecreatefrompng($img_name_mini_icon1);
    $img_mini_icon2 = imagecreatefrompng($img_name_mini_icon2);
    $img_mini_icon3 = imagecreatefrompng($img_name_mini_icon3);
    $img_mini_icon4 = imagecreatefrompng($img_name_mini_icon4);
    $img_twitter = imagecreatefrompng($img_name_twitter);

    //画像の幅と高さを取得
    list($width_back, $height_back, $type_back, $attr_back) = getimagesize($img_name_back);
    list($width_icon, $height_icon, $type_icon, $attr_icon) = getimagesize($img_name_icon);
    list($width_mini_icon1, $height_mini_icon1, $type_mini_icon1, $attr_mini_icon1) = getimagesize($img_name_mini_icon1);
    list($width_mini_icon2, $height_mini_icon2, $type_mini_icon2, $attr_mini_icon2) = getimagesize($img_name_mini_icon2);
    list($width_mini_icon3, $height_mini_icon3, $type_mini_icon3, $attr_mini_icon3) = getimagesize($img_name_mini_icon3);
    list($width_mini_icon4, $height_mini_icon4, $type_mini_icon4, $attr_mini_icon4) = getimagesize($img_name_mini_icon4);
    list($width_twitter, $height_twitter, $type_twitter, $attr_twitter) = getimagesize($img_name_twitter);

    $img_back_resized = imagecreatetruecolor($width_back_resized, $height_back_resized);
    $img_icon_resized = imagecreatetruecolor($width_icon_resized, $height_icon_resized);
    $img_mini_icon1_resized = imagecreatetruecolor($width_mini_icon_resized, $height_mini_icon_resized);
    $img_mini_icon2_resized = imagecreatetruecolor($width_mini_icon_resized, $height_mini_icon_resized);
    $img_mini_icon3_resized = imagecreatetruecolor($width_mini_icon_resized, $height_mini_icon_resized);
    $img_mini_icon4_resized = imagecreatetruecolor($width_mini_icon_resized, $height_mini_icon_resized);
    $img_twitter_resized = imagecreatetruecolor($width_twitter_resized, $height_twitter_resized);

    imagecopyresized($img_back_resized, $img_back, 0, 0, 0, 0, $width_back_resized, $height_back_resized, $width_back, $height_back);
    imagecopyresized($img_icon_resized, $img_icon, 0, 0, 0, 0, $width_icon_resized, $height_icon_resized, $width_icon, $height_icon);
    imagecopyresized($img_mini_icon1_resized, $img_mini_icon1, 0, 0, 0, 0, $width_mini_icon_resized, $height_mini_icon_resized, $width_mini_icon1, $height_mini_icon1);
    imagecopyresized($img_mini_icon2_resized, $img_mini_icon2, 0, 0, 0, 0, $width_mini_icon_resized, $height_mini_icon_resized, $width_mini_icon2, $height_mini_icon2);
    imagecopyresized($img_mini_icon3_resized, $img_mini_icon3, 0, 0, 0, 0, $width_mini_icon_resized, $height_mini_icon_resized, $width_mini_icon3, $height_mini_icon3);
    imagecopyresized($img_mini_icon4_resized, $img_mini_icon4, 0, 0, 0, 0, $width_mini_icon_resized, $height_mini_icon_resized, $width_mini_icon4, $height_mini_icon4);
    imagecopyresized($img_twitter_resized, $img_twitter, 0, 0, 0, 0, $width_twitter_resized, $height_twitter_resized, $width_twitter, $height_twitter);

    //角の大きさ
    $cornerRad = 40;
    
    //元画像の読み込み
    //$originalImage = imageCreateFromJPEG('images/test.png');
    //角画像の読み込み
    $cornerPng = ImageCreateFromPNG('rounded_corner.png');
    
    //角をリサンプリングするための画像
    $cornerResized = imageCreateTrueColor($cornerRad,$cornerRad);
    //リサンプリング用の画像（真っ黒）に角画像をコピーしてついでに大きさを調整する（$cornerRad）
    imageCopyResampled($cornerResized,$cornerPng,0,0,0,0,$cornerRad,$cornerRad,imageSX($cornerPng),imageSY($cornerPng));
    //黒を透明にするため黒を定義
    $black = imageColorAllocate($cornerResized,0,0,0);
    //リサンプル画像の黒を透明にする
    imageColorTransparent($cornerResized,$black);
    
    //元画像のデータ取得
    $sizeX = imageSX($img_icon_resized);
    $sizeY = imageSY($img_icon_resized);
    
    //元データの左上の角を丸める
    imageCopyMerge($img_icon_resized,$cornerResized,0,0,0,0,$cornerRad,$cornerRad,100);
    
    //imageRotateで角丸画像を回転させて、元データの右上の角を丸める
    $rotated = imageRotate($cornerResized,90,0);
    imageCopyMerge($img_icon_resized,$rotated,0,$sizeY - $cornerRad,0,0,$cornerRad,$cornerRad,100);
    
    //imageRotateで角丸画像を回転させて、元データの左下の角を丸める
    $rotated = imageRotate($cornerResized,270,0);
    imageCopyMerge($img_icon_resized,$rotated,$sizeX - $cornerRad,0,0,0,$cornerRad,$cornerRad,100);
    
    //imageRotateで角丸画像を回転させて、元データの右下の角を丸める
    $rotated = imageRotate($cornerResized,180,0);
    imageCopyMerge($img_icon_resized,$rotated,$sizeX - $cornerRad,$sizeY - $cornerRad,0,0,$cornerRad,$cornerRad,100);

    //画像を合成する
    imagecopymerge(
        $img_back_resized,  //コピー先の画像リンクリソース
        $img_icon_resized, //コピー元の画像リンクリソース
        20,           //コピー先の x 座標
        20,           //コピー先の y 座標
        0,            //コピー元の x 座標
        0,            //コピー元の y 座標
        $width_icon_resized,       //コピー元の幅
        $height_icon_resized,      //コピー元の高さ
        100            //透過度（%）
    );

    imagecopymerge(
        $img_back_resized,  //コピー先の画像リンクリソース
        $img_twitter_resized, //コピー元の画像リンクリソース
        400,           //コピー先の x 座標
        20,           //コピー先の y 座標
        0,            //コピー元の x 座標
        0,            //コピー元の y 座標
        $width_twitter_resized,       //コピー元の幅
        $height_twitter_resized,      //コピー元の高さ
        100            //透過度（%）
    );
    imagecopymerge(
        $img_back_resized,  //コピー先の画像リンクリソース
        $img_mini_icon1_resized, //コピー元の画像リンクリソース
        20,           //コピー先の x 座標
        260,           //コピー先の y 座標
        0,            //コピー元の x 座標
        0,            //コピー元の y 座標
        $width_mini_icon_resized,       //コピー元の幅
        $height_mini_icon_resized,      //コピー元の高さ
        100            //透過度（%）
    );
    imagecopymerge(
        $img_back_resized,  //コピー先の画像リンクリソース
        $img_mini_icon2_resized, //コピー元の画像リンクリソース
        80,           //コピー先の x 座標
        260,           //コピー先の y 座標
        0,            //コピー元の x 座標
        0,            //コピー元の y 座標
        $width_mini_icon_resized,       //コピー元の幅
        $height_mini_icon_resized,      //コピー元の高さ
        100            //透過度（%）
    );
    imagecopymerge(
        $img_back_resized,  //コピー先の画像リンクリソース
        $img_mini_icon3_resized, //コピー元の画像リンクリソース
        140,           //コピー先の x 座標
        260,           //コピー先の y 座標
        0,            //コピー元の x 座標
        0,            //コピー元の y 座標
        $width_mini_icon_resized,       //コピー元の幅
        $height_mini_icon_resized,      //コピー元の高さ
        100            //透過度（%）
    );
    imagecopymerge(
        $img_back_resized,  //コピー先の画像リンクリソース
        $img_mini_icon4_resized, //コピー元の画像リンクリソース
        200,           //コピー先の x 座標
        260,           //コピー先の y 座標
        0,            //コピー元の x 座標
        0,            //コピー元の y 座標
        $width_mini_icon_resized,       //コピー元の幅
        $height_mini_icon_resized,      //コピー元の高さ
        100            //透過度（%）
    );

    //テキスト色の指定
    //$text_color= imagecolorallocate($img_back_resized, 0, 0, 0);
    //$text_color= imagecolorallocate($img_back_resized, 255, 255, 255);
    $text_color_black = imagecolorallocate($img_back_resized, 20, 23, 26);
    //$text_color_gray = imagecolorallocate($img_back_resized, 206, 212, 217);
    $text_color_gray = imagecolorallocate($img_back_resized, 111, 129, 143);

    //画像に書き込むテキストの設定
    imagettftext($img_back_resized, $id_font_size, 0, 65, 35, $text_color_black, $font, $username);
    imagettftext($img_back_resized, $id_font_size, 0, 65, 48, $text_color_black, $font, $id);
    $array = mb_str_split_auto($sentence, $font_size, $font, $width_back_resized - 50);
    foreach ($array as $id => $row) {
      imagettftext($img_back_resized, $font_size, 0, 20, 90 + (($font_size + 10) * $id), $text_color_black, $font, $row);
    }
    imagettftext($img_back_resized, $id_font_size, 0, 345, 280, $text_color_gray, $font, $day);
    imagettftext($img_back_resized, $id_font_size, 0, 305, 280, $text_color_gray, $font, $time);
    imagettftext($img_back_resized, $id_font_size, 0, 42, 275, $text_color_gray, $font, "$comments");
    imagettftext($img_back_resized, $id_font_size, 0, 102, 275, $text_color_gray, $font, "$RT");
    imagettftext($img_back_resized, $id_font_size, 0, 162, 275, $text_color_gray, $font, "$good");

    //ヘッダーの設定
    header("Content-type: image/png");
    //画像の保存
    //imagepng($img_back_resized, 'output/test_output.png');
    imagepng($img_back_resized, $output_filename);

    //画像の消去（メモリの解放）
    imagedestroy($img_back);
    imagedestroy($img_icon);
    imagedestroy($img_back_resized);
    imagedestroy($img_icon_resized);

  }
}

function mb_str_split_auto($str, $font_size, $font, $width_back) {

    mb_internal_encoding('UTF-8');
    mb_regex_encoding('UTF-8');

    $strlen = mb_strlen($str, 'UTF-8');
    $ret    = array();
    $row = '';
    for ($i = 0; $i < $strlen; $i += 1) {
        $row .= mb_substr($str, $i, 1);
        $pos = imagettfbbox ($font_size, 0, $font, $row);
        $row_width = $pos[2] - $pos[0];
        if ($row_width > $width_back) {
          $ret[ ] = $row;
          $row = '';
        }
    }
    $ret[ ] = $row;
    return $ret;
}

?>
