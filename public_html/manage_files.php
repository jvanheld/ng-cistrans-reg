<?php
session_start();
/*session is started if you don't write this line can't use $_Session  global variable*/

//Part concerned by Delete files in project/data
$folderToDelete = $_SESSION["path_project"] . "/data/" . $_POST["fileToDelete"];
$fileToDelete = $_SESSION["path_project"] . "/data/" . $_POST["fileToDelete"] . "/" .$_POST["fileToDelete"];
$fileName = $_POST["fileToDelete"];
unlink($fileToDelete);//delete file
rmdir($folderToDelete);//delete folder

//Part concerned by delete files in database project
$db = new SQLite3($_SESSION["path_project"] . "/" . $_SESSION["project"] . ".db");// open the project database
$results = $db->query("DELETE FROM files WHERE md5sum='$fileName' ");//request to insert a new line who correspond to the new file uploaded

?>