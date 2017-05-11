<!DOCTYPE html>
<html dir="ltr" lang="ja">
<head>
<meta charset="UTF-8" />
<title>ランダム文字列を生成｜h3x.jp URL Shortener</title>
<!-- html は 2017/05/12 に更新 Ver. 13.0.0 -->
<meta name="robots" content="none" />
<style>
@font-face {
font-family: Koruri-Regular;
src: local('Koruri-Regular'),
	url('/media/fonts/Koruri-Regular.woff2') format('woff2'), 
	url('/media/fonts/Koruri-Regular.woff') format('woff'),
	url('/media/fonts/Koruri-Regular.ttf') format('truetype');
}
body {
   font-family: Koruri-Regular, sans-serif;
   font-size:12px;
}
</style>
</head>
<body>
<p style="font-size: 1.4em;">ランダム文字列を生成&nbsp;(&beta;&nbsp;Ver.)</p>
<?php
require_once ('url-password.php');
// HTTPパラメータ取得
$length =  (is_numeric($_GET['len']) and $_GET['len'] >= 3)? intval($_GET['len']) : 8;
$zumomo = new ZumomoPassword($length);

$pass = array();
$pass[] = $zumomo->generate();

print "<div style=\"font-size: 150%; border: double 3px silver; padding: 8px; margin: 8px; \"><b>" . join('</b></div><div><b>', $pass) . "</b></div>";

?>
<form action='?' method='GET'>
文字列長= <input type="text" name="len" value="8" size="3" /> 文字位  <input type="submit" value="生成">
</form>
</body>
</html>
