<?php
session_start();
/*session is started if you don't write this line can't use $_Session  global variable*/

//Part who manage all modifications make on the contributor list
if (isset($_POST['revoke_user_access'])) {
    $contributors_file_modified = file_get_contents("../access/groups");
    $rows = explode("\n", $contributors_file_modified);

    $contributorsToKeep_array = array();

    foreach ($rows as $row) {
        if ($_SESSION["project"] == $words_in_row[0]) {
            $contributors = explode(" ", $words_in_row[1]);
            array_shift($contributors);
            foreach ($contributors as $name) {
                if ($_SERVER['REMOTE_USER'] != $name) {
                    if (!in_array($name,$_POST['revoke_user_access'])){
                        array_push($contributorsToKeep_array, $name);
                    }
                }

            }

        }
    }
    $groupsfile = fopen("../access/groups","a");

    $contentsgroups = "\n" . $_SESSION["project"] . ": " . $_SERVER['REMOTE_USER'] . " " . $contributorsToKeep_array ;

    fwrite($groupsfile,$contentsgroups);

    fclose($groupsfile);
}