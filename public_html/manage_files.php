<?php
session_start();
/*session is started if you don't write this line can't use $_Session  global variable*/

//Part concerned by Delete files in project/data
$fileToDelete = $_SESSION["path_project"] . "/data/" . $_POST["fileToDelete"];
unlink($fileToDelete);


?>