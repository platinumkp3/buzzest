<?php
$key = 'buzzest';
 
function encrypt_val($string)
{ 
	global $key;
	 
	$encrypted = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($key), $string, MCRYPT_MODE_CBC, md5(md5($key))));
	
	return $encrypted;
}

function decrypt_val($encrypted_val)
{
	global $key;
	$decrypted = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($key), base64_decode($encrypted_val), MCRYPT_MODE_CBC, md5(md5($key))), "\0");
	
	return $decrypted;

}
?>