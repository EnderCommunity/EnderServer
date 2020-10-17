<?php
session_start();
$_SESSION = array();
if(ini_get("session.use_cookies")){
  $params = session_get_cookie_params();
  setcookie(session_name(), '', time() - 42000, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);
}
session_destroy();
if(isset($_GET['CLOSE'])){
  echo  "<script type='text/javascript'>window.close();</script>";
}else if(isset($_GET['URL'])){
  header("Location: ".$_GET['URL']);
}else{
  header("Location: [Your_Default_URL]"); 
}
?>