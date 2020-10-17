SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";
CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `FirstName` varchar(100) NOT NULL,
  `LastName` varchar(100) NOT NULL,
  `UserName` varchar(100) NOT NULL,
  `UserType` varchar(100) NOT NULL,
  `UserPassword` varchar(100) NOT NULL,
  `AccountStatus` varchar(100) NOT NULL,
  `RecoveryEmail` varchar(100) NOT NULL,
  `BirthdayYear` varchar(100) NOT NULL,
  `BirthdayMonth` varchar(100) NOT NULL,
  `BirthdayDay` varchar(100) NOT NULL,
  `UserGender` varchar(100) NOT NULL,
  `UserImage` varchar(100) NOT NULL,
  `UserRIP` varchar(100) NOT NULL,
  `UserRTime` varchar(100) NOT NULL,
  `UserRAgent` varchar(200) NOT NULL,
  `Timezoon` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;
COMMIT;