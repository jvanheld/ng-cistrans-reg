<!DOCTYPE html>
<html>
<head>
	<!-- META -->
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Amidex Home Project</title>

		
	
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="mise_en_page.css">

	<script type="text/javascript" src="jQuery/jquery-1.12.0.js"></script>
    <script type="text/javascript" src="js/function.js"></script>
</head>


<body>

	
		<h1>
		Welcome to ng-cistrans-reg project </h1>
		<h4>To use this tool, you have to be register By Lucie Khamvongsa </h4>




<?php
$BASE = "./workspace";
function list_dir($base, $cur, $level=0) {
  global $PHP_SELF, $BASE;
  if ($dir = opendir($base)) {
    while($entry = readdir($dir)) {
      /* chemin relatif à la racine */
      $file = $base."/".$entry;
      if(is_dir($file) && !in_array($entry, array(".",".."))) {
        /* marge gauche */
        for($i=1; $i<=(4*$level); $i++) {
            echo "&nbsp;";
        }
        /* l'entrée est-elle le dossier courant */
        if($file == $cur) {
          echo "<b>$entry</b><br />\n";
        } else {
//          echo "<a href=$file> $entry </a><br />\n";
          echo "<button class='GoButton' id=$entry > $entry </button><br />\n";
        }
        /* l'entrée est-elle dans la branche dont le dossier courant est la feuille */
        if(ereg($file."/",$cur."/")) {
            list_dir($file, $cur, $level+1);
        }
      }
    }
    closedir($dir);
  }
}
function list_file($cur) {
  if ($dir = opendir($cur)) {
    while($file = readdir($dir)) {
      echo "$file<br />\n";
    }
    closedir($dir);
  }
}
?>


<!--<table > <tr valign="top"><td>-->


<!-- liste des répertoires
et des sous-répertoires -->
<?php
/* lien sur la racine */
list_dir($BASE, rawurldecode($dir), 1);

echo $_SERVER['REMOTE_USER'];

?>




<!--</td></tr>
</table>-->




</body>
</html>
