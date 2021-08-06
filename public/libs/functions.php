<?php 
//Mobile Detect の読み込み（パスは環境に応じて変更）
require_once $_SERVER['DOCUMENT_ROOT'] . '/public/libs/Mobile_Detect.php';

// インスタンスを生成
$detect = new Mobile_Detect ;
 
//判定結果を変数に代入
$isMobile = $detect->isMobile();  //タブレットまたはスマホの場合は true
$isTablet = $detect->isTablet();  //タブレットの場合は true
$isPhone = false;   //スマホの場合は true
if($detect->isMobile() && !$detect->isTablet()){ $isPhone = true; }