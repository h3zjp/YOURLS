<?php

error_reporting(0);

stream_context_set_default( [
    'http' => [
	'header'=>"User-Agent: h3zjpApp/1.0\n",
	'method' => 'HEAD',
	'ignore_errors' => true,
    ],
    'ssl' => [
	'verify_peer' => false,
	'verify_peer_name' => false,
	'crypto_method' => STREAM_CRYPTO_METHOD_ANY_CLIENT,
	'header'=>"User-Agent: h3zjpApp/1.0\n",
	'method' => 'HEAD',
	'ignore_errors' => true,
    ],
]);

$shortURL = isset($_GET['short']) ? $_GET['short'] : '';
$shorten_url = $shortURL;
$shorten_url1 = $shortURL;

if(strpos($shorten_url,'h3x.jp/') !== false){
	$shorten_url = $shorten_url . '*';
}

$header_data = get_headers($shorten_url, true);

if(isset($header_data['Location'])){
	$original_url = $header_data['Location'];
	$original_url1 = $original_url;
	if(is_array($original_url)){
		$original_url = end($original_url);
		$original_url1 = $original_url;
	}
}else{
	if($_GET['short'] == ""){
		$original_url = '';
		$original_url1 = '';
	}else{
		$original_url = 'URLを復元することが出来ませんでした。短縮URLではない可能性があります。';
		$original_url1 = '';
	}
}

?>

<!DOCTYPE html>
<html dir="ltr" lang="ja">
<head>
<meta charset="UTF-8" />
<title>短縮URLを復元する｜h3x.jp URL Shortener</title>
<!-- html は 2017/05/04 に更新 Ver. 13.0.0 -->
<meta name="keywords" content="短縮URL,復元,展開" />
<meta name="robots" content="all" />
<link rel="icon" type="image/x-icon" href="/media/favicon.ico" />
<link rel="Shortcut Icon" type="image/x-icon" href="/media/favicon.ico" />
<link rel="apple-touch-icon-precomposed" href="/images/apple-touch-icon.png" />
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
<p style="font-size: 1.4em;">短縮URLを復元する (&beta; Ver.)<br />
by <a href="https://xn--48jwg508p.net/" target="_top">hama3.net</a></p>
<form name="MyForm" method="get">
短縮URL :
<input type="text" name="short" style="width:50%;" value="http://" />
<input type="submit" value="復元!" />
</form>
<br />
<b>【使い方】</b>
<ol>
<li>[<strong>短縮URL</strong>] に短縮URLを入力して下さい。<br />
<li>[<strong>復元</strong>] ボタンを押して下さい。</li>
<li>元のURLが下記に表示されます。</li>
</ol>
<br />
<p><strong>短縮されたURL :</strong> <?php echo $shorten_url1; ?></p>
<p><strong>元のURL :</strong> <?php echo $original_url; ?></p>
<br />
<b>【ページの画像】</b>
<p><img src="https://app.h3z.jp/thumbnail/?url=<?php echo $original_url1; ?>" width="100%" /></p>
<form><input type="button" value="ページを閉じる" onClick="window.close()"></form>
</body>
</html>
