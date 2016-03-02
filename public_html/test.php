<?php
/**
 * Created by PhpStorm.
 * User: lkhamvongsa
 * Date: 2/22/16
 * Time: 11:48 AM
 * Ce fichier contient la partie devellopé en php pour vérifier automatiquement quels sont les projets existant
 * côté serveur et les disposer en bouton solution mise de côté car JvH propose solution de passer par un fichier référence.
 */


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


    <!-- liste des répertoires
    et des sous-répertoires -->


<?php
list_dir($BASE, rawurldecode($dir), 1);
?>

<?php
echo $_SERVER['REMOTE_USER'];

?>