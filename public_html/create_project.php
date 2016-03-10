<?php
session_start();
/*session is started if you don't write this line can't use $_Session  global variable*/
?>

<!DOCTYPE html>
<html>
<head>
    <!-- META -->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Amidex Home Project</title>

    <script type="text/javascript" src="jQuery/jquery-1.12.0.js"></script>
    <script type="text/javascript" src="js/function.js"></script>

    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="css/mise_en_page.css">


</head>
<body>

    <h1>Create a new project</h1>

    <div class="home-div">
        <button class="home" onclick="window.location = 'index.php';"> Home </button>
    </div>

<?php
function my_error_handler($no, $str, $file, $line)
{
    switch ($no) {
        // Erreur fatale
        case E_USER_ERROR:
            echo '<p><strong>Erreur fatale</strong> : ' . $str . '</p>';
            exit; // On arrête le script
            break;

        // Erreur générée par PHP
        default:
            echo '<p><strong>Erreur inconnue</strong> ['.$no.'] : '.$str.'<br/>';
            echo 'Dans le fichier : "'.$file.'", à la ligne '.$line.'.</p>';
            break;
    }
}

set_error_handler('my_error_handler');

if(empty($_POST["Name_project"])){
    trigger_error('Please enter a name project for create it', E_USER_NOTICE);
}else {
    $pathFolder = "./workspace/" . $_POST["Name_project"];
    mkdir($pathFolder,0755);
    echo "The creation of the project directory succeeded";
    echo "<br>";
}

$htaccessfile = fopen($pathFolder . "/.htaccess","w+");

$contents = "\tAuthName \"restricted\" \n\tRequire group " . $_POST["Name_project"];

if(fwrite($htaccessfile,$contents)) {
    echo "The access to the project has been correctly defined";

}else{
    // Erreur
    echo "There is a problem with access restrictions to the project";
}
fclose($htaccessfile);

$usersList = "";
for ($i = 0 ;$i < count($_POST["User_access"]); $i++) {
    $usersList = $usersList . $_POST["User_access"][$i] . " ";
}

$groupsfile = fopen("../access/groups","a");

$contentsgroups = "\n" . $_POST["Name_project"] . ": " . $_SERVER['REMOTE_USER'] . " " . $usersList ;

fwrite($groupsfile,$contentsgroups);

fclose($groupsfile);

$ownersfile = fopen("../access/project_owner","a");

$contentsowners = "\n" . $_POST["Name_project"] . ": " . $_SERVER['REMOTE_USER'];

fwrite($ownersfile,$contentsowners);

fclose($ownersfile);

?>
    <a href="javascript:history.go(-1)">Retour</a>
</body>
