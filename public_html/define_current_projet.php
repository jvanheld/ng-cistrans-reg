<?php
session_start();
/*session is started if you don't write this line can't use $_Session  global variable*/

$_SESSION["path_project"] = "./workspace/ng-cistrans-reg_projects/" . $_POST["currentProjet"];
$_SESSION["project"] = $_POST["currentProjet"];

?>











