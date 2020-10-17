<?php
session_start();
include("EnderAddress.php");
include("EnderCrypt.php");
include("EnderDatabase.php");
?>
{
  "isSignedIn": <?php echo ("" + isset($_SESSION['UserEmail'])); ?>,
  "email": "<?php $TEmail = EnderCrypt($_SESSION['UserEmail'], false); echo $TEmail; ?>",
  "profilePhoto": "<?php echo $_SESSION["UserInfo"]->UserImage; ?>",
  "address": {
    "trusted": "<?php echo $_SESSION['TrustedAddress']; ?>",
    "current": "<?php echo EnderAddress($TEmail); ?>"
  },
  "name": {
    "first": "<?php echo EnderCrypt($_SESSION["UserInfo"]->FirstName, false); ?>",
    "last": "<?php echo EnderCrypt($_SESSION["UserInfo"]->LastName, false); ?>"
  },
  "userType": "<?php echo $_SESSION["UserInfo"]->UserType; ?>",
  "accountStatus": "<?php echo $_SESSION["UserInfo"]->AccountStatus; ?>",
  "birthDate": {
    "day": "<?php echo EnderCrypt($_SESSION["UserInfo"]->BirthdayDay, false); ?>",
    "month": "<?php echo EnderCrypt($_SESSION["UserInfo"]->BirthdayMonth, false); ?>",
    "year": "<?php echo EnderCrypt($_SESSION["UserInfo"]->BirthdayYear, false); ?>"
  },
  "gender": "<?php echo EnderCrypt($_SESSION["UserInfo"]->UserGender, false); ?>",
  "accountCreationTime": "<?php echo EnderCrypt($_SESSION["UserInfo"]->UserRTime, false); ?>",
  "firstUserAgent": "<?php echo EnderCrypt($_SESSION["UserInfo"]->UserRAgent, false); ?>",
  "timezoon": "<?php echo EnderCrypt($_SESSION["UserInfo"]->Timezoon, false); ?>"
}