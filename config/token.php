<?php
// PHP 7
$token = bin2hex(random_bytes(32));
// PHP 5.3 with mcrypt
//$token = bin2hex(mcrypt_create_iv(32, MCRYPT_DEV_URANDOM));
// PHP 5.3 with openssl
//$token = bin2hex(openssl_random_pseudo_bytes(32));
// PHP 4
//$token = base64_encode(time() . sha1($_SERVER['REMOTE_ADDR'] . $_SERVER['HTTP_USER_AGENT']) . md5(uniqid(rand(), true)));
// Store the token into a session variable!
$_SESSION['token'] = $token; 