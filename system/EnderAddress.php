<?php
session_start();
function GetOS(){
  $os_platform = "Unknown OS Platform";
  $os_array = array('/windows nt 10/i' => 'Windows 10', '/windows nt 6.3/i' => 'Windows 8.1', '/windows nt 6.2/i' => 'Windows 8', '/windows nt 6.1/i' => 'Windows 7', '/windows nt 6.0/i' => 'Windows Vista', '/windows nt 5.2/i' => 'Windows Server 2003/XP x64', '/windows nt 5.1/i' => 'Windows XP', '/windows xp/i' => 'Windows XP', '/windows nt 5.0/i' => 'Windows 2000', '/windows me/i' => 'Windows ME', '/win98/i' => 'Windows 98', '/win95/i' => 'Windows 95', '/win16/i' => 'Windows 3.11', '/macintosh|mac os x/i' => 'Mac OS X', '/mac_powerpc/i' => 'Mac OS 9', '/linux/i' => 'Linux', '/ubuntu/i' => 'Ubuntu', '/cros/i' => 'Chrome OS', '/iphone/i' => 'iPhone', '/ipod/i' => 'iPod', '/ipad/i' => 'iPad', '/android/i' => 'Android', '/blackberry/i' => 'BlackBerry', '/webos/i' => 'Mobile');
  foreach ($os_array as $regex => $value)
    if(preg_match($regex, $_SERVER['HTTP_USER_AGENT']))
      $os_platform = $value;
  return $os_platform;
}
function HostName($THV = ""){
  if(!isset($THV))
	$THV = $_SERVER['HTTP_HOST'];
  $V = str_split(md5($THV), 2);
  $V2 = "";
  for($i =0; $i < 16; $i++)
	$V2 .= $V[i];
  $V2 = str_split(md5($V2), 2);
  $V3 = "";
  for($i =0; $i < 8; $i++)
	$V3 .= $V2[i];
  $V3 = str_split(md5($V3), 2);
  $FN = "!".$V3[3].$V3[0].$V3[2];
  return strtoupper($FN);
}
function getClientIP(){
  $ipaddress = 'UNKNOWN';
  $keys=array('HTTP_CLIENT_IP','HTTP_X_FORWARDED_FOR','HTTP_X_FORWARDED','HTTP_FORWARDED_FOR','HTTP_FORWARDED','REMOTE_ADDR');
  foreach($keys as $k){
    if(isset($_SERVER[$k]) && !empty($_SERVER[$k]) && filter_var($_SERVER[$k], FILTER_VALIDATE_IP)){
      $ipaddress = $_SERVER[$k];
      break;
    }
  }
  return $ipaddress;
}
/*function GetSession(){
  return $_COOKIE["EnderSessionKey"];
}
function CheckSession(){
  if(isset(GetSession()))
	return true;
  else
	return false;
}
function SetSession(){
  //EmailMetaphone@XXXXXXXXXXXXXXXX!XXXXXX
  if(($_SESSION["TrustedAddress"] == EnderAddress(EnderCrypt($_SESSION["EnderSessionKey"], false, false))) && !isset($_COOKIE["EnderSessionKey"])){
    setcookie("EnderSessionKey", (metaphone(str_replace("@enderadel.net", "", EnderCrypt($_SESSION["EnderSessionKey"], false, false)))."@".substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 16)."!".HostName(getClientIP())), time() + (86400 * 14), "/", "enderadel.net", true, true);
  }
}
function RemoveSession(){
  setcookie("EnderSessionKey", "", time() - 3600); 
}*/
function EnderAddress($CD){
  $CD = str_replace(".", "", $CD);
  $OS = GetOS();
  $HOST = HostName();
  $HOST .= getClientIP();
  $HOST = HostName($HOST);
  $AGENT = $_SERVER['HTTP_USER_AGENT'];
  if(!(strpos($AGENT, "Mozilla/5.0") !== false)){
	//<product> / <product-version> <comment>
	$AGENT = str_replace("Mozilla/5.0", "", $AGENT);
	$AGENT = substr($AGENT, 0, strpos($AGENT, "/"));
  }else{
    //Mozilla/5.0 (<system-information>) <platform> (<platform-details>) <extensions>
	$AGENT = str_replace("Mozilla/5.0", "", $AGENT);
	$AGENT = strstr($AGENT, ')');
	$AGENT = substr($AGENT, 0, strpos($AGENT, "("));
  }
  $EnderAddress = str_split(md5($OS.$AGENT), 8);
  function NumbersOnly($v){
    $char = array("a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z", "0", "1", "2", "3", "4", "5", "6", "7", "8", "9");
    $num = array("10.1000", "11.2000", "12.3000", "13.4000", "14.5000", "15.6000", "16.7000", "17.8000", "18.9000", "19.0100", "20.0200", "21.0300", "22.0400", "23.0500", "24.0600", "25.0700", "26.0800", "27.0900", "28.0010", "29.0020", "30.0030", "31.0040", "32.0050", "33.0060", "34.0070", "35.0080", "36.0090", "37.0001", "38.0002", "39.0003", "40.0004", "41.0005", "42.0006", "43.0007", "44.0008", "45.0009");
    return str_ireplace($char, $num, $v);
  }
  function StringChange($v){
    $v = str_split(NumbersOnly($v), 7);
    $r = 0;
    foreach ($v as &$value){
      $r += $value;
    }
    return str_replace(".", "", $r);
  }
  //EmailMetaphone@000000000000:000000000000:000000000000:000000000000!XXXXXX
  return metaphone(str_replace("@enderadel.net", "", $CD))."@".StringChange($EnderAddress[0]).":".StringChange($EnderAddress[1]).":".StringChange($EnderAddress[2]).":".StringChange($EnderAddress[3]).$HOST;
}
?>