<?php
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
<form action="cek.php"  enctype="multipart/form-data" method="POST">
		<b>Sayfa Başlangıç</b><br>
		<select name="sayfa">
		<?php
        for ($i = 1; $i <= 1000; $i++) {
            echo '<option value="'.$i.'">'.$i.'</option>';
        }
        ?>
		</select>
		<br>
		<b>Sayfa Son</b><br>
		<select name="sayfab">
		<?php
        for ($i = 1; $i <= 1000; $i++) {
            echo '<option value="'.$i.'">'.$i.'</option>';
        }
        ?>
		</select>
		<br>
		<br>
	
		<input type="submit" name="gonder" class="submit" value="Çekim Başlasın!">
		</form>
        </div>
    </div>
	</div>
</body>
</html>

