<?php

$path = $_SERVER["REQUEST_URI"];
$PATHINFO_BASENAME = pathinfo($path, PATHINFO_BASENAME);
if ($PATHINFO_BASENAME == "function.php") {
	include_once("config.php");
	header("Location: " . ROOT . "/function/");
	exit();
}

/*************** Satyendra *****************/
/*************** Functions ****************/

/**
 * word limit
 */

function limit_words($string, $word_limit)
{
	$words = explode(" ", $string);
	return implode(" ", array_splice($words, 0, $word_limit));
}

/**
 * compress files
 */


function ob_html_compress($buffer)
{

	$search = array(
		'/\>[^\S ]+/s',
		// strip whitespaces after tags, except space
		'/[^\S ]+\</s',
		// strip whitespaces before tags, except space
		'/(\s)+/s',
		// shorten multiple whitespace sequences
		'/<!--(.|\s)*?-->/' // Remove HTML comments
	);

	$replace = array(
		'>',
		'<',
		'\\1',
		''
	);

	$buffer = preg_replace($search, $replace, $buffer);

	return $buffer;
}

/**
 * special characters & trim & stripslashes
 */

function test_input($data)
{
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

/**
 * validate email address using dns
 */

function validate_email($email)
{
	// Check email syntax
	if (preg_match('/^([a-zA-Z0-9\._\+-]+)\@((\[?)[a-zA-Z0-9\-\.]+\.([a-zA-Z]{2,7}|[0-9]{1,3})(\]?))$/', $email, $matches)) {
		$user = $matches[1];
		$domain = $matches[2];

		// Check availability of DNS MX records
		if (getmxrr($domain, $mxhosts, $mxweight)) {
			for ($i = 0; $i < count($mxhosts); $i++) {
				$mxs[$mxhosts[$i]] = $mxweight[$i];
			}

			// Sort the records
			asort($mxs);
			$mailers = array_keys($mxs);
		} elseif (checkdnsrr($domain, 'A')) {
			$mailers[0] = gethostbyname($domain);
		} else {
			$mailers = array();
		}
		$total = count($mailers);

		// Added to still catch domains with no MX records
		if ($total == 0 || !$total) {
			$error = "No MX record found for the domain.";
		} else {
			$error = "TRUE";
		}
	} else {
		$error = "Address syntax not correct.";
	}

	return ($error ? $error : TRUE);
}

/**
 * get real ip from visitors
 */

function getUserIP()
{

	/**
	 * Get real visitor IP behind CloudFlare network
	 */

	if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
		$_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
		$_SERVER['HTTP_CLIENT_IP'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
	}
	$client = @$_SERVER['HTTP_CLIENT_IP'];
	$forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
	$remote = $_SERVER['REMOTE_ADDR'];
	if (filter_var($client, FILTER_VALIDATE_IP)) {
		$ip = $client;
	} elseif (filter_var($forward, FILTER_VALIDATE_IP)) {
		$ip = $forward;
	} else {
		$ip = $remote;
	}
	return $ip;
}
$user_ip = getUserIP();



/**
 * carousel banner
 */

function bann_query($db)
{
	global $page_id;
	$query = "SELECT * FROM `banners` where `asign_page`='$page_id' AND `ban_status`='publish' ORDER BY `ban_order`";
	$result = mysqli_query($db, $query);
	return $result;
}

/**
 * banner slides indicators
 */

function bann_slide_indicators($db)
{
	$output = '';
	$count = 0;
	$result = bann_query($db);
	while ($row = mysqli_fetch_array($result)) {
		if ($count == 0) {
			$output .= '
			<li data-target="#demo" data-slide-to="' . $count . '" class="active"></li>
			';
		} else {
			$output .= '
			<li data-target="#demo" data-slide-to="' . $count . '"></li>
			';
		}
		$count = $count + 1;
	}
	return $output;
}

/**
 * slide banners
 */

function bann_slides($db)
{
	$output = '';
	$count = 0;
	$result = bann_query($db);
	while ($row = mysqli_fetch_array($result)) {
		if ($count == 0) {
			$output .= '<div class="carousel-item active">';
		} else {
			$output .= '<div class="carousel-item">';
		}
		$output .= '
		<a href="' . $row["url_link"] . '" target="_blank" rel="noopener"><img src="' . ROOT . '/uploads/ban-images/' . $row["banner"] . '" alt="' . $row["alt_text"] . '" class="img-fluid" /></a>
		</div>
		';
		$count = $count + 1;
	}
	return $output;
}