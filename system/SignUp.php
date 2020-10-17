<?php
session_start();
include("TD/SavePassword.php");
include("EnderCrypt.php");
include("EnderDatabase.php");
include("EnderAddress.php");
function GPIN($digits = 4){
  $strongnumber = 0;
  $confirmcode = "EC-";
  while($strongnumber < $digits){
    $confirmcode .= mt_rand(0, 9);
    $strongnumber++;
  }
  return $confirmcode;
}
/*
Check the variables before creating the account!
*/
if(isset($_GET['EE'])){
  $EAUserName = strtolower(utf8_decode($_GET['EE']));
  if(preg_match('/^[0-9a-zA-Z_]+$/', $EAUserName)){
    $EAUserName = EnderCrypt($EAUserName, true, false);
    $EAPassword = EnderCrypt(utf8_decode($_GET['EP']), true, false);//Find a better way to pass the password
    $EAFirstName = EnderCrypt(utf8_decode($_GET['RFN']), true, false);
    $EALastName = EnderCrypt(utf8_decode($_GET['RLN']), true, false);
    $EABYear = EnderCrypt(utf8_decode($_GET['RBY']), true, false);
    $EABMonth = EnderCrypt(utf8_decode($_GET['RBM']), true, false);
    $EABDay = EnderCrypt(utf8_decode($_GET['RBD']), true, false);
    $EAGender = EnderCrypt(utf8_decode($_GET['RG']), true, false);
    $EATimeZoon = EnderCrypt(utf8_decode($_GET['RTZ']), true, false);
    $UserCode = GPIN(6);
    $OriginalIP = EnderAddress($_GET['EE']);
    $OriginalAgent = EnderCrypt($_SERVER['HTTP_USER_AGENT']."", true, false);
    $CreateTime = EnderCrypt((date('m/d/Y h:i:s a', time())), true, false);
    $VEQ = "SELECT UserName, id FROM users WHERE UserName='$EAUserName'";
    $conn = new mysqli($HostName, $UserName, $UserPassword, $DatabaseName);
    $result = $conn->query($VEQ);
    if($result->num_rows <= 0){
      $conn->close();
      $EnderDatabaseConnection = MySQLi_Connect($HostName, $UserName, $UserPassword, $DatabaseName);
      $EnderQuery = "INSERT INTO users (FirstName, LastName, UserName, UserType, UserPassword, AccountStatus, RecoveryEmail, BirthdayYear, BirthdayMonth, BirthdayDay, UserGender, UserImage, UserRIP, UserRTime, UserRAgent, Timezoon) VALUES('$EAFirstName', '$EALastName', '$EAUserName', 'EnderUser', '$EAPassword', 'Active', '', '$EABYear','$EABMonth','$EABDay', '$EAGender', 'none', '$OriginalIP', '$CreateTime', '$OriginalAgent', '$EATimeZoon')";
      if(mysqli_query($EnderDatabaseConnection, $EnderQuery)){
        mysqli_close($EnderDatabaseConnection);
        echo "true";
      }else{
        mysqli_close($EnderDatabaseConnection);
        echo "false";
      }
    }else{
      $conn->close();
      echo "false";
    }
  }else{
    echo "false";
  }
}
?>