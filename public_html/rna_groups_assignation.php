<?php
session_start();
/*session is started if you don't write this line can't use $_Session  global variable*/
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>NG-cistrans-reg Project</title>
    <!--
            <link rel="stylesheet" type="text/css" href="mise_en_page.css">
    -->
</head>

<body>

<h1>Groups assignation</h1>

<?php

$db = new SQLite3( $_SESSION["path_project"] . "/" . $_SESSION["project"] . ".db");// open the project database

//Part about groups assignation
//Table rna_groups_assignation = $_POST["rna_groups_assignation"]
$db->exec('DROP TABLE IF EXISTS rna_groups_assignation');//remove old table

/*$featureList = "";
foreach (array_keys($_POST["rna_groups_assignation"])as $item) {
    $featureList = $featureList . $item . ", ";
}
$featureListTrimmed = rtrim($featureList,", ");*/

//Create table
$db->exec("CREATE TABLE rna_groups_assignation (md5sum STRING, Sample_name STRING, groups_associated STRING)");

//print_r($_POST["rna_groups_assignation"]);

/*foreach($_POST["rna_groups_assignation"]["md5sum"] as $key => $value) {
    //echo $key . "<br>";
    $md5=$value;


}*/

//Get value line by line without the first one because it empty (hidden line use like template)
for($sample = 1; $sample < count($_POST["rna_groups_assignation"]["md5sum"]); $sample++){
    $md5= $_POST["rna_groups_assignation"]["md5sum"][$sample];
    $Sample_name=$_POST["rna_groups_assignation"]["Sample_name"][$sample];
    $groups = "";
    foreach($_POST["rna_groups_assignation"][$md5] as $group => $groupName){
        $groups = $groups  . $groupName .  ", ";
    }
    $groupsToAdd=rtrim($groups,", ");
    //echo $groupsToAdd;

    $valueToAddTrimmed = "'" . $md5 .  "'" . ", " .  "'" . $Sample_name . "'" . ", " .  "'" . $groupsToAdd . "'";
    //echo $valueToAddTrimmed;

    $db->exec("INSERT INTO rna_groups_assignation (md5sum,Sample_name,groups_associated) VALUES ($valueToAddTrimmed)");//request to insert a new line who correspond to the new description

}

?>

<a href="javascript:history.go(-1)">Go Back</a>

</body>
</html>