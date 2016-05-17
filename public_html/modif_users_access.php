<?php
session_start();
/*session is started if you don't write this line can't use $_Session  global variable*/

//Part who manage all modifications make on the contributor list

//Part about delete some users
$tmp_file = fopen("../access/tmp_groups", "w");

if (isset($_POST['revoke_user_access'])) {
    $contributors_file_modified = file_get_contents("../access/groups");
    $rows = explode("\n", $contributors_file_modified);

    $contributorsToKeep_list = "";

    foreach ($rows as $row) {
        $words_in_row = explode(":",$row);
        if ($_SESSION["project"] == $words_in_row[0]) {
            $contributors = explode(" ", $words_in_row[1]);
            array_shift($contributors);
            foreach ($contributors as $name) {
                if ($_SERVER['REMOTE_USER'] != $name) {
                    if (!in_array($name,$_POST['revoke_user_access'])){
                        $contributorsToKeep_list = $contributorsToKeep_list . $name . " ";
                    }
                }

            }
            $contributorsToKeepFinal = trim($contributorsToKeep_list);
            $contentsgroups = $_SESSION["project"] . ": " . $_SERVER['REMOTE_USER'] . " " . $contributorsToKeepFinal . "\n" ;
            fwrite($tmp_file,$contentsgroups);

        }else{//Rewrite other composition project
            $contentsgroups = $row . "\n";
            fwrite($tmp_file,$contentsgroups);
        }
    }

    fclose($tmp_file);
    unlink("../access/groups");
    rename("../access/tmp_groups","../access/groups");
    chmod("../access/groups",0777);
}

//Part about add some users
$tmp_file = fopen("../access/tmp_groups", "w");

if (isset($_POST['add_user_access'])) {
    $contributors_file_modified = file_get_contents("../access/groups");
    $rows = explode("\n", $contributors_file_modified);

    $contributorsToKeep_list = "";

    foreach ($rows as $row) {
        $words_in_row = explode(":",$row);
        if ($_SESSION["project"] == $words_in_row[0]) {
            foreach ($_POST['add_user_access'] as $name) {
                $contributorsToKeep_list = $contributorsToKeep_list . $name . " ";
            }

            $contributorsToKeepFinal = trim($contributorsToKeep_list);
            $contentsgroups = $row . " " . $contributorsToKeepFinal . "\n" ;
            fwrite($tmp_file,$contentsgroups);

        }else{//Rewrite other composition project
            $contentsgroups = $row . "\n";
            fwrite($tmp_file,$contentsgroups);
        }
    }

    fclose($tmp_file);
    unlink("../access/groups");
    rename("../access/tmp_groups","../access/groups");
    chmod("../access/groups",0777);

}

?>

<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>NG-cistrans-reg Project</title>

		<link rel="stylesheet" type="text/css" href="css/NGcistrans_styles.css">

<script type="text/javascript" src="jQuery/jquery-1.12.0.js"></script>

	</head>

<h2>Manage access</h2>

    <script language="javascript">
        window.location.href = "project_menu.php"
    </script>
