<?php
session_start();
/*session is started if you don't write this line can't use $_Session  global variable*/

?>
<!DOCTYPE html>
<html>
<head>
	<!-- META -->
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Amidex Home Project</title>

    <script type="text/javascript" src="jQuery/jquery-1.12.0.js"></script>
    <script type="text/javascript" src="js/function.js"></script>
	
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="mise_en_page.css">


</head>


<body>

	
		<h1>
		Welcome to ng-cistrans-reg project </h1>
		<h4>To use this tool, you have to be register By Lucie Khamvongsa </h4>



<?php

$txt_file = file_get_contents("../access/groups");
$rows = explode("\n", $txt_file);

$projects =array();

foreach($rows as $row ) {
    $words_in_row = explode(":",$row);
    $users = explode(" ", $words_in_row[1]);
    array_shift($users);
    $projects[$words_in_row[0]]= $users;
}

foreach(array_keys($projects) as $key){
    if (in_array($_SERVER['REMOTE_USER'],$projects[$key])){
        echo "<button class='GoButton' id=$key > $key </button>";
    }

}
?>

        <a href="form_write_yaml.php">Form annotation</a>



</body>



</html>
