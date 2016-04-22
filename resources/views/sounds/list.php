<?php

$sql="select * from users"; 
$str ="<?xml version="1.0" encoding="UTF-8"?>n<student>";

foreach ($sql) as $row) {
$str .= "\n<details>\n\t\t\t<id>$row[userID]</id>\n\t\t\t<name>$row[username]</name> ";
$str .= "\n\t\t\t <class>$row[profilePicture]</class>\n</details>";
}
$str.= "\n</student>";
//$str=nl2br($str);
//echo htmlspecialchars($str); // remove this line if you are writing to file
echo $str;
///////////////////////////// 
/// Write to file ////////////
/*
$file_name="test_file.xml"; // file name
$fp = fopen ($file_name, "w"); 
// Open the file in write mode, if file does not exist then it will be created.
fwrite ($fp,$str); // entering data to the file
fclose ($fp); // closing the file pointer
chmod($file_name,0777); 
*/

?>