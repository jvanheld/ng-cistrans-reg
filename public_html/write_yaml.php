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
		<h1>Saving data</h1>
<?php
//Faire une transposition de tableau


// Il faut retirer dans chacuns des tableaux la premiere ligne qui est la ligne "template" donc vide

//echo is_array($_POST[Serie_informations][Contributor]) ? 'Tableau' : 'ce n\'est pas un tableau';

//echo "<br>";

/*foreach($_POST as $key1 => $value1){
	if (is_array($value1)) {
        echo $key1 . " est un tableau <br>";
        foreach ($value1 as $key2 => $value2) {
            if (is_array($value2)) {
                echo $key2 . " est un tableau ";
            }

        }

    }
	
}
foreach($_POST["Samples_information"] as $key1 => $value1) {
    if (is_array($value1)) {
        echo $key1 . " est un tableau <br>";
    }
}

foreach($_POST["Series_information"]["Contributor"] as $key1 => $value1) {
        echo $key1 . $value1. " est un là <br>";
}*/

//Check if the first line is empty, if is it remove this one
/*if (empty($_POST["Series_information"]["Contributor"][0])){
    array_shift($_POST["Series_information"]["Contributor"]);
}

if (empty($_POST["Samples_information"]["Sample_name"][0])){
    foreach ($_POST["Samples_information"] as $key => $value) {
        array_shift($value);
    }*/


    /*foreach ($_POST["Samples_information"] as $tab){
        array_shift($tab); Not run
    }*/
//}

//Part for write all information in a YAML file.
$filename = $_SESSION["path_project"] . "/data" . "/description.yml";
$res = yaml_emit_file($filename, $_POST, $encoding = YAML_UTF8_ENCODING );

//Part for write 3 tables in the database project.
$db = new SQLite3( $_SESSION["path_project"] . "/" . $_SESSION["project"] .".db");//open database project

//Table Serie_descriptions = $_POST["Series_information"]
$db->exec('DROP TABLE IF EXISTS serie_descriptions');//remove old table

$db->exec('CREATE TABLE serie_descriptions (feature STRING, value STRING)');
foreach($_POST["Series_information"] as $key => $value){
    if (is_array($value)){// if is array we have to insert all value contained by this array
        foreach($value as $key2 => $value2){
            if(empty($value2)){//skip the empty line
                continue;
            }else{
                $db->exec("INSERT INTO serie_descriptions (feature, value) VALUES ('$key','$value2')");//request to insert a new line who correspond to the new description
            }
        }
        //continue;
    }else{
        $db->exec("INSERT INTO serie_descriptions (feature, value) VALUES ('$key','$value')");//request to insert a new line who correspond to the new description
    }
}

//Table Sample_descriptions = $_POST["Samples_information"]
$db->exec('DROP TABLE IF EXISTS sample_descriptions');//remove old table

$featureList = "";
foreach (array_keys($_POST["Samples_information"])as $item) {
    $featureList = $featureList . $item . ", ";
}
$featureListTrimmed = rtrim($featureList,", ");

//Read all keys for create the table
$featureCount= 1;
foreach (array_keys($_POST["Samples_information"])as $item) {
    if ($featureCount == 1){
        $db->exec("CREATE TABLE sample_descriptions ($item STRING)");
    }
    else{
        $db->exec("ALTER TABLE sample_descriptions ADD COLUMN $item STRING");
    }
    $featureCount ++;
}
//Get value line by line without the first one because it empty (hidden line use like template)
for($sample = 1; $sample < count($_POST["Samples_information"]["md5sum"]); $sample++){
    $valueToAdd = "";
    foreach($_POST["Samples_information"] as $key => $value) {
        $valueToAdd = $valueToAdd . "'" .$value[$sample] . "'" . ", ";
    }
    $valueToAddTrimmed = rtrim($valueToAdd,", ");
    $db->exec("INSERT INTO sample_descriptions ($featureListTrimmed) VALUES ($valueToAddTrimmed)");//request to insert a new line who correspond to the new description
}

//Table Protocol_descriptions = $_POST["Protocols_information"]
$db->exec('DROP TABLE IF EXISTS protocol_descriptions');//remove old table

$db->exec('CREATE TABLE protocol_descriptions (feature STRING, value STRING)');
foreach($_POST["Protocols_information"] as $key => $value){
    if (is_array($value)){// if is array we have to insert all value contained by this array
        foreach($value as $key2 => $value2){
            if(empty($value2)){//skip the empty line
                continue;
            }else{
                $db->exec("INSERT INTO protocol_descriptions (feature, value) VALUES ('$key','$value2')");//request to insert a new line who correspond to the new description
            }
        }
        //continue;
    }else{
        $db->exec("INSERT INTO protocol_descriptions (feature, value) VALUES ('$key','$value')");//request to insert a new line who correspond to the new description
    }
}


?>

	<a href="javascript:history.go(-1)">Go Back</a>

	</body>
</html>