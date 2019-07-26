<?php
			/*
			global $current_user;
			get_currentuserinfo();
			$user_id = $current_user->ID;
			$data = get_userdata( $user_id );
			if ($data->caps['administrator'] != 1)
				die(header("location: ../wp-login.php?redirect_to=http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']));
			*/
			/*
			$getir = $this->curl("http://www.fullprogramlarindir.com/");
			preg_match_all("/<span class=\"pages\">Sayfa (.*?) Toplam: (.*?)<\/span>/s", $getir, $sonuc);
			$this->sayfa = $sonuc[2][0];
			*/
			
		function curl($url)	{
			//$cookieFileLocation = "cookie.txt";
			$user_agent = 'Mozilla/5.0 (Windows NT 6.2; WOW64; rv:26.0) Gecko/20100101 Firefox/26.0';
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			//curl_setopt($ch, CURLOPT_HEADER, $header ? true : false);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			//curl_setopt($ch, CURLOPT_USERAGENT, $user_agent); gereksiz, bot bozulur olursa tekrar deneriz
			//curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);
			curl_setopt($ch, CURLOPT_TIMEOUT, 10);
			curl_setopt ($ch, CURLOPT_REFERER, $url);  // referrer burda belirt
			curl_setopt ($ch, CURLOPT_USERAGENT, $user_agent ); // siteye hangi tarayıcı ile bağlandığımı söyle
			$icerik = curl_exec($ch);
			curl_close($ch);
			return $icerik;
		}
		
		# Seflink oluşturucu
		function seflink($url) {
			$url = trim($url);

			$find = array('<b>', '</b>');
			$url = str_replace ($find, '', $url);

			$url = preg_replace('/<(\/{0,1})img(.*?)(\/{0,1})\>/', 'image', $url);

			$find = array(' ', '&quot;', '&amp;', '&', '\r\n', '\n', '/', '\\', '+', '<', '>');
			$url = str_replace ($find, '-', $url);

			$find = array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ë', 'Ê');
			$url = str_replace ($find, 'e', $url);

			$find = array('í', 'ì', 'î', 'ï', 'I', 'Í', 'Ì', 'Î', 'Ï', 'İ', 'ı');
			$url = str_replace ($find, 'i', $url);

			$find = array('ó', 'ö', 'Ö', 'ò', 'ô', 'Ó', 'Ò', 'Ô');
			$url = str_replace ($find, 'o', $url);

			$find = array('á', 'ä', 'â', 'à', 'â', 'Ä', 'Â', 'Á', 'À', 'Â');
			$url = str_replace ($find, 'a', $url);

			$find = array('ú', 'ü', 'Ü', 'ù', 'û', 'Ú', 'Ù', 'Û');
			$url = str_replace ($find, 'u', $url);

			$find = array('Ş','ş');
			$url = str_replace ($find, 's', $url);

			$find = array('ç', 'Ç');
			$url = str_replace ($find, 'c', $url);

			$find = array('Ğ', 'ğ');
			$url = str_replace ($find, 'g', $url);

			$find = array('/[^a-z0-9\-<>]/', '/[\-]+/', '/<[^>]*>/');

			$repl = array('', '-', '');
			

			$url = strtolower($url);
			$url = preg_replace ($find, $repl, $url);
			
			$url = str_replace ('---', '-', $url);
			$url = str_replace ('--', '-', $url);
			
			return $url;
		}
		
		# filtre
		function f($t) {
			if (get_magic_quotes_gpc())
				$t = stripslashes($t);
			$t = addslashes($t);
			return $t;
		}



function copcu( &$sic )
{
$sic = preg_replace( "'<script[^>]*>.*?</script>'si", '', $sic );
$sic = preg_replace( "'<ul class=\"essb_links_list\">.*?</ul>'si", '', $sic );
$sic = preg_replace( "' <ins class=\"adsbygoogle\"[^>]*>.*?</ins>'si", '', $sic );
$sic = preg_replace( "'<a[^>]*>'si", '', $sic );
$sic = str_replace("</a>","",$sic);
$sic = preg_replace( "'<div[^>]*>'si", '', $sic );
$sic = str_replace("</div>","",$sic);
$sic = preg_replace( "'<span class=\"clearfix\">.*?</span>'si", '', $sic );
$sic = str_replace('<span class="clearfix">Sponsored Links</span>', '',$sic);
return ($sic);
}

?>