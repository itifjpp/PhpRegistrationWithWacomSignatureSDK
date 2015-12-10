CREATE TABLE IF NOT EXISTS `registration` (
  `ID` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `Name` text NOT NULL,
  `Title` text NOT NULL,
  `Company` text NOT NULL,
  `Signature` text,
  `Timestamp` datetime DEFAULT NULL,
  `Remarks` text 
)
