<?php
set_time_limit(0);
include '../blog/wp-load.php';
    include '../blog/wp-admin/includes/image.php';
    include 'html_parse.php';
    include 'functions.php';

    global $wpdb;
function baglan($url, $ref = false)
{
    if (!$ref) {
        $ref = $url;
    }
    $ch = curl_init();
    $timeout = 0;
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
    curl_setopt($ch, CURLOPT_REFERER, $ref);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
    $veri = curl_exec($ch);
    curl_close($ch);

    return $veri;
}
?>
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dolor Bot</title>
    <link type="text/css" rel="stylesheet" href="css/responsive-tabs.css" />
    <link type="text/css" rel="stylesheet" href="css/style.css" />
	<!-- jQuery with fallback to the 1.* for old IE -->
    <!--[if lt IE 9]>
        <script src="js/jquery-1.11.0.min.js"></script>
    <![endif]-->
    <!--[if gte IE 9]><!-->
        <script src="js/jquery-2.1.0.min.js"></script>
    <!--<![endif]-->
    <script src="js/jquery.responsiveTabs.js" type="text/javascript"></script>
    <script src="js/function.js" type="text/javascript"></script>

</head>
	<body>
	<div id="main">
	<div id="header">
		<div class="logo">
		<a href="index.php"><img src="images/logo.png" alt="logo" /></a>
		<h1>Dolor Bot</h1>
		</div>
	</div>
	<div class="clear"></div>
    <div id="horizontalTab">
        <ul>
            <li><a href="#tab-1">Bot Panel</a></li>  
        </ul>

        <div id="tab-1">
<?php

for ($k = $_POST['sayfa']; $k <= $_POST['sayfab']; $k++) {
    if ($k == 1) {
        $veri = baglan('https://www.mactip.net/iphone/');
    } else {
        $veri = baglan("https://www.mactip.net/mac/iphone/$k/");
    }

    preg_match_all('#<div class="readMore"> (.*?)</div>#', $veri, $konular); //Tüm Konular
    //print_r($konular).'<br>';
    echo "<h1>$k.Sayfa</h1>";

    for ($i = 0; $i < count($konular[0]); $i++) {
        preg_match_all('@<a href="(.*?)" title="(.*?)">(.*?)</a>@si', $konular[1][$i], $basliklar);  //tüm başlıklar

        preg_match_all('@<a href="(.*?)" title="(.*?)">(.*?)</a>@si', $konular[1][$i], $linkler); //print_r($linkler);
        //başlıkları temizle
        $baslik = copcu($basliklar[0]);
        $temizbas = preg_replace('/<a href=\"(.*?)\" title="(.*?)" rel="nofollow">(.*?)<\/a>/', '\\2', $baslik); //temiz başlık
        //print_r ($temizbas);
        for ($z = 0; $z <= 10; $z++) {
            $linkbas = $linkler[1][$z]; //print_r($linkbas);
            $bag = baglan($linkbas);
            preg_match_all('@<div class="thecontent" itemprop="articleBody">(.*?)</div></div>@si', $bag, $icerik);
            preg_match_all('@<h1 class="title single-title entry-title" itemprop="headline">(.*?)</h1>@si', $bag, $baslik);
            preg_match_all('@<img class="(.*?)" src="(.*?)" alt="(.*?)" width="(.*?)" height="(.*?)" srcset="(.*?)" sizes="(.*?)" /></a>@si', $bag, $resimler);
            //print_r($baslik).'<br><br>';
            //print_r($resimler[2]).'<br><br>';

            $salla = $baslik[1][0];
            $sic = $icerik[0][0];
            echo copcu($salla);
            //echo copcu($sic);

            $post = [
                'post_title'    => $salla,
                'post_content'  => copcu($sic),
                'post_status'   => 'draft',
                'post_author'   => 1,
                'post_category' => [$sic, 1],
            ];
            $post_id = wp_insert_post($post);
            // Resim Ekleme
        }
    }
}

?>
<h3>Yazılar başarıyla taslak olarak eklendi!</h3>
        </div>
    </div>
	</div>
</body>
</html>