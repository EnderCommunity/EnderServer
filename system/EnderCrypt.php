<?php
function EnderCrypt($string, $action, $type = false){
  $output = false;
  $encrypt_method = "AES-256-CBC";
  //Your secret key and the secret IV should be the same length!
  $secret_key = '[Your_Secret_Key]';
  $secret_iv = '[Your_Secret_IV]';
  $key = hash('sha256', $secret_key);
  $iv = substr(hash('sha256', $secret_iv), 0, 16);
  if($action == true){
    $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
    $output = base64_encode($output);
  }else{
    $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
  }
  return $output;
}
//EnderCrypt([TheDataThatNeedsToBeEncrtptedOrDecrypted], "[true/false] true if you want to encrypt and false for decryption", "[true/false] true if you want to check if the data is empty");
?>