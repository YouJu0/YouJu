<?php
if (!function_exists('encryption')) {
  define('METHOD', 'AES-256-CBC');
  define('SECRET_KEY', 'PitusaGordoAmor');
  define('SECRET_IV', '69236945');

  function encryption($string)
  {
    $key = hash('sha256', SECRET_KEY);
    $iv = substr(hash('sha256', SECRET_IV), 0, 16);
    $output = openssl_encrypt($string, METHOD, $key, 0, $iv);
    $output = base64_encode($output);
    return $output;
  }
}

if (!function_exists('decryption')) {
  function decryption($string)
  {
    $key = hash('sha256', SECRET_KEY);
    $iv = substr(hash('sha256', SECRET_IV), 0, 16);
    $output = openssl_decrypt(base64_decode($string), METHOD, $key, 0, $iv);
    return $output;
  }
}
