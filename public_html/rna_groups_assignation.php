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

$featureList = "";
foreach (array_keys($_POST["rna_groups_assignation"])as $item) {
    $featureList = $featureList . $item . ", ";
}
$featureListTrimmed = rtrim($featureList,", ");

//Read all keys for create the table
$featureCount= 1;
foreach (array_keys($_POST["rna_groups_assignation"])as $item) {
    if ($featureCount == 1){
        $db->exec("CREATE TABLE rna_groups_assignation ($item STRING)");
    }
    else{
        $db->exec("ALTER TABLE rna_groups_assignation ADD COLUMN $item STRING");
    }
    $featureCount ++;
}
//Creation of groups associated column
$db->exec("ALTER TABLE rna_groups_assignation ADD COLUMN 'groups associated' STRING");
$featureListTrimmed= $featureListTrimmed . ", groups associated";

print_r($_POST["rna_groups_assignation"]);

//Get value line by line without the first one because it empty (hidden line use like template)
for($sample = 1; $sample < count($_POST["rna_groups_assignation"]["md5sum"]); $sample++){
    $valueToAdd = "";
    foreach($_POST["rna_groups_assignation"] as $key => $value) {
        $valueToAdd = $valueToAdd . "'" .$value[$sample] . "'" . ", ";
    }
    $valueToAddTrimmed = rtrim($valueToAdd,", ");

    $db->exec("INSERT INTO rna_groups_assignation ($featureListTrimmed) VALUES ($valueToAddTrimmed)");//request to insert a new line who correspond to the new description

}

?>

</body>
</html>