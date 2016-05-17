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
<h1>Define groups</h1>

<?php

//Part for write grouping_table on current database project.
$db = new SQLite3( $_SESSION["path_project"] . "/" . $_SESSION["project"] .".db");//open database project

$db->exec('DROP TABLE IF EXISTS rna_groups_table');//remove old table if exist

$featureList = "";
foreach (array_keys($_POST)as $item) {
    $featureList = $featureList . $item . ", ";
}
$featureListTrimmed = rtrim($featureList,", ");

//Read all keys for create the table
$featureCount= 1;
foreach (array_keys($_POST)as $item) {
    if ($featureCount == 1){
        $db->exec("CREATE TABLE rna_groups_table ($item STRING)");
    }
    else{
        $db->exec("ALTER TABLE rna_groups_table ADD COLUMN $item STRING");
    }
    $featureCount ++;
}
//Get value line by line without the first one because it empty (hidden line use like template)
for($sample = 1; $sample < count($_POST["Group_name"]); $sample++){
    $valueToAdd = "";

    foreach($_POST as $key => $value) {
        if(preg_match("#/^[a-zA-Z0-9\s]+$#",$value)){
            $valueToAdd = $valueToAdd . "'" .$value[$sample] . "'" . ", ";

        }else{
            $valueToAdd = $valueToAdd . "'" .filter_var($value[$sample],FILTER_SANITIZE_FULL_SPECIAL_CHARS) . "'" . ", ";
        }
    }

    $valueToAddTrimmed = rtrim($valueToAdd,", ");
    echo $valueToAddTrimmed;

    $db = new SQLite3( $_SESSION["path_project"] . "/" . $_SESSION["project"] .".db");//open database project

    $db->exec("INSERT INTO rna_groups_table ($featureListTrimmed) VALUES ($valueToAddTrimmed)");//request to insert a new line who correspond to the new description

}

?>