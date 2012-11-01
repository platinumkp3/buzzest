<?php
 
$key = 'buzzest';
$string = 'password'; // note the spaces
 
$encrypted = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($key), $string, MCRYPT_MODE_CBC, md5(md5($key))));
$decrypted = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($key), base64_decode($encrypted), MCRYPT_MODE_CBC, md5(md5($key))), "\0");
 
echo 'Encrypted:' . "\n";
var_dump($encrypted);
 
echo "\n";
 
echo 'Decrypted:' . "\n";
var_dump($decrypted); // spaces are preserved
 
?>