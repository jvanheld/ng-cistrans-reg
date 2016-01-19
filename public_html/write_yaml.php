<?php


?>




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

$yaml = yaml_emit($_POST);
var_dump($yaml);

$filename = "boum.yaml";
$res = yaml_emit_file($filename, $_POST);

?>



	</body>
</html>
