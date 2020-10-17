<?php
session_start();
include("EnderCrypt.php");
include("EnderDatabase.php");
if(isset($_GET['EE'])){
  $TQEV = EnderCrypt(strtolower($_GET['EE']), true, false);
  $VEQ = "SELECT UserName, id FROM users WHERE UserName='$TQEV'";
  $conn = new mysqli($HostName, $UserName, $UserPassword, $DatabaseName);
  $result = $conn->query($VEQ);
  if($result->num_rows > 0){
  	echo "true";
	  $_SESSION['EATSUTSASP'] = $TQEV;
  }else{
	  echo "false";
	  $_SESSION['EATSUTSASP'] = "";
  }
  $conn->close();
}
if(isset($_GET['EP'])){
  $TQEV = $_SESSION['EATSUTSASP'];
  $TQEV2 = EnderCrypt($_GET['EP'], true, false);
  $VEQ = "SELECT * FROM users WHERE UserName='$TQEV' AND UserPassword='$TQEV2'";
  $conn = new mysqli($HostName, $UserName, $UserPassword, $DatabaseName);
  $result = $conn->query($VEQ);
  if($result->num_rows > 0){
    $_SESSION['UserEmail'] = $TQEV;
    $_SESSION['UserPassword'] = $TQEV2;
	  $_SESSION["EnderSessionKey"] = "[Coming_Soon]";//This part isn't completed!
    while($row = $result->fetch_assoc()){
      $_SESSION["TrustedAddress"] = $row["UserRIP"];
      $_SESSION["UserInfo"]->FirstName = $row["FirstName"];
      $_SESSION["UserInfo"]->LastName = $row["LastName"];
      $_SESSION["UserInfo"]->UserType = $row["UserType"];
      $_SESSION["UserInfo"]->AccountStatus = $row["AccountStatus"];
      $_SESSION["UserInfo"]->BirthdayYear = $row["BirthdayYear"];
      $_SESSION["UserInfo"]->BirthdayMonth = $row["BirthdayMonth"];
      $_SESSION["UserInfo"]->BirthdayDay = $row["BirthdayDay"];
      $_SESSION["UserInfo"]->UserGender = $row["UserGender"];
      $_SESSION["UserInfo"]->UserImage = $row["UserImage"];
      $_SESSION["UserInfo"]->UserRTime = $row["UserRTime"];
      $_SESSION["UserInfo"]->UserRAgent = $row["UserRAgent"];
      $_SESSION["UserInfo"]->Timezoon = $row["Timezoon"];
    }
	  echo $_SESSION["EnderSessionKey"];
  }else{
  	echo "false";
  }
  $conn->close();
}
?>