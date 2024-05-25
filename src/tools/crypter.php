<?php
// Definición de constantes si no están definidas
if (!defined('SECRET_KEY')) {
  define('SECRET_KEY', 'PitusaGordoAmor');
}
if (!defined('SECRET_IV')) {
  define('SECRET_IV', '69236945');
}
if (!defined('METHOD')) {
  define('METHOD', 'AES-256-CBC');
}

function encryption($string)
{
  $output = FALSE;
  $key = hash('sha256', SECRET_KEY);
  $iv = substr(hash('sha256', SECRET_IV), 0, 16);
  $output = openssl_encrypt($string, METHOD, $key, 0, $iv);
  $output = base64_encode($output);
  return $output;
}

function decryption($string)
{
  $key = hash('sha256', SECRET_KEY);
  $iv = substr(hash('sha256', SECRET_IV), 0, 16);
  $output = openssl_decrypt(base64_decode($string), METHOD, $key, 0, $iv);
  return $output;
}
