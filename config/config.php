<?php

session_start();

//error_reporting(E_ALL | E_DEPRECATED | E_STRICT);
// Same as error_reporting(E_ALL);
//ini_set("error_reporting", E_ALL);
// Report all errors except E_NOTICE
error_reporting(E_ALL & ~E_NOTICE);

// Report all errors
//error_reporting(E_ALL);
/*
* set default time-zone to confirm the timezone
* else it will show an error that system time is not reliable
* Change it as per your timezone
*/
date_default_timezone_set('Asia/Kolkata');

/*
 * set maximum script execution time to overcome
 * timeout situations
 * I have set it for 5 minutes, i.e. 5 mins * 60 seconds,
 * But dont use unlimited or too much time as it may cause
 * too much server load and even breakdown
 */

/** No timeout */
set_time_limit(0);

$utmSource = isset($_GET["utm_source"]) ? $_GET["utm_source"] : "";
$utmMedium = isset($_GET["utm_medium"]) ? $_GET["utm_medium"] : "";
$utmCampaign = isset($_GET["utm_campaign"]) ? $_GET["utm_campaign"] : "";
$gclid = isset($_GET["gclid"]) ? $_GET["gclid"] : "";
define('serverName', $_SERVER['SERVER_NAME']);
define('host', $_SERVER['HTTP_HOST']);
if (serverName == "localhost") {
	$proFold = 'yellowbird';
	$REQUEST_URI = $_SERVER["REQUEST_URI"];
	$REQUEST_URI = str_replace("/" . $proFold, "", $REQUEST_URI);

	/** define */
	define('ROOT', 'http://' . serverName . '/' . $proFold);
	define('AdminRoot', ROOT . '/yb-admin');
	define("canonical", $REQUEST_URI);

	// ** Database settings - You can get this info from your web host ** //
	/** The name of the database */
	define('DB_NAME', 'yellow_bird');

	/** Database username */
	define('DB_USER', 'root');

	/** Database password */
	define('DB_PASSWORD', '');

	/** Database hostname */
	define('DB_HOST', 'localhost');

	/** Open a new connection to the MySQL server */
	$db = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

	/** Output any connection error */
	if ($db->connect_errno) {
		echo "Failed to connect to MySQL: " . $db->connect_error;
		exit();
	}


	/** for pages */
	$res = ltrim($REQUEST_URI, '/');
	$res2 = str_replace($proFold . '/', '', $res);

	/** for categories */
	$catres = ltrim($REQUEST_URI, '/');
	$catres2 = str_replace($proFold . '/blog/category/', '', $catres);

	/** for news category */
	$ncatres = ltrim($REQUEST_URI, '/');
	$ncatres2 = str_replace($proFold . '/news/category/', '', $ncatres);

	/** for authors */
	$authres = ltrim($REQUEST_URI, '/');
	$authres2 = str_replace($proFold . '/author/', '', $authres);

	/** for tags */
	$tagres = ltrim($REQUEST_URI, '/');
	$tagres2 = str_replace($proFold . '/tag/', '', $tagres);
	$tagres2 = str_replace("-", " ", $tagres2);

	/** for utm, google ads, fb ads etc */
	$res3 = explode("/?", $REQUEST_URI);
	$res3 = $res3[0];
	$res3 = ltrim($res3, '/');
	$res3 = str_replace($proFold . '/', '', $res3);
	if ($res3 == $proFold) {
		$res3 = str_replace($proFold, '', $res3);
	} else {
		$res3 = $res3;
	}

	/** get page from url through htaccess */
	$page = isset($_GET["page"]) ? $_GET["page"] : '';

	/** get search keywords for search page */
	$q = isset($_GET["q"]) ? $_GET["q"] : '';
} else {
	$REQUEST_URI = $_SERVER["REQUEST_URI"];

	/** define */
	define('ROOT', 'https://www.satyenfotech.com/yellowbird');
	define('AdminRoot', 'https://www.satyenfotech.com/yellowbird/yb-admin');
	define("canonical", $REQUEST_URI);

	// ** Database settings - You can get this info from your web host ** //
	/** The name of the database */
	define('DB_NAME', 'satyeccg_yellowbird');

	/** Database username */
	define('DB_USER', 'satyeccg_yellowbird');

	/** Database password */
	define('DB_PASSWORD', 'ckjf@tYR^P4,');

	/** Database hostname */
	define('DB_HOST', 'localhost');

	/** Open a new connection to the MySQL server */
	$db = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

	/** Output any connection error */
	if ($db->connect_errno) {
		echo "Failed to connect to MySQL: " . $db->connect_error;
		exit();
	}

	/** for pages */
	$res = ltrim($REQUEST_URI, '/');

	/** for categories */
	$catres = ltrim($REQUEST_URI, '/');
	$catres2 = str_replace('blog/category/', '', $catres);

	/** for news categories */
	$ncatres = ltrim($REQUEST_URI, '/');
	$ncatres2 = str_replace('news/category/', '', $ncatres);

	/** for authors */
	$authres = ltrim($REQUEST_URI, '/');
	$authres2 = str_replace('author/', '', $authres);

	/** for tags */
	$tagres = ltrim($REQUEST_URI, '/');
	$tagres2 = str_replace('tag/', '', $tagres);
	$tagres2 = str_replace("-", " ", $tagres2);

	/** for utm, google ads, fb ads etc */
	$res3 = explode("/?", $REQUEST_URI);
	$res3 = $res3[0];
	$res3 = ltrim($res3, '/');

	/** get page from url through htaccess */
	$page = isset($_GET["page"]) ? $_GET["page"] : '';

	/** get search keywords for search page */
	$q = isset($_GET["q"]) ? $_GET["q"] : '';
}



$PATHINFO_BASENAME = pathinfo($REQUEST_URI, PATHINFO_BASENAME);
if ($PATHINFO_BASENAME == "config.php") {
	header("Location: " . ROOT . "/config/");
	exit();
}