<?php
session_start();
/*session is started if you don't write this line can't use $_Session  global variable*/

?>
<!DOCTYPE html>
<html>
<head>
	<!-- META -->
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Ng-cistrans-reg Project</title>

    <script type="text/javascript" src="jQuery/jquery-1.12.0.js"></script>
    <script type="text/javascript" src="js/NGcistrans_functions.js"></script>
	
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="css/NGcistrans_styles.css">


</head>


<body>

	
    <h1>Welcome to ng-cistrans-reg project</h1>

    <fieldset>
        <legend>Access to your projects</legend>
        <ul>
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
        echo "<li><a href='project_menu.php' class='Go' id=$key > $key </a></li>";
    }
}
?>
        </ul>
    </fieldset>

<div id="create_project">
    <a href="create_project_form.php">Create project</a>
</div>


</body>
</html>
