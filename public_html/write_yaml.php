

<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Amidex Home Project</title>
<!--
		<link rel="stylesheet" type="text/css" href="mise_en_page.css">
-->

	</head>

	<body>
		<h1>Ecriture du fichier YAML</h1>
<?php

// Il faut retirer dans chacuns des tableaux la premiere ligne qui est la ligne "template" donc vide


//echo is_array($_POST[Serie_informations][Contributor]) ? 'Tableau' : 'ce n\'est pas un tableau';

//echo "<br>";

foreach($_POST as $key1 => $value1){
	if (is_array($value1)){
		echo $key1." est un tableau <br>";
		foreach($value1 as $key2 => $value2){
			if (is_array($value2)){
				echo $key2." est un tableau <br>";
			}
			
		}
	}
//	echo "\$_POST[$key] => $value <br>";
	
	
	
}


$yaml = yaml_emit($_POST,$encoding = YAML_UTF8_ENCODING );
var_dump($yaml);

$filename = "description.yaml";
$res = yaml_emit_file($filename, $_POST, $encoding = YAML_UTF8_ENCODING );


?>



	</body>
</html>
