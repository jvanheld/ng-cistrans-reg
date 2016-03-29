<?php
session_start();
/*session is started if you don't write this line can't use $_Session  global variable*/
?>

<!DOCTYPE html>
<html>
<head>
    <!-- META -->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>NG-cistrans-reg Project</title>

    <script type="text/javascript" src="jQuery/jquery-1.12.0.js"></script>
    <script type="text/javascript" src="js/NGcistrans_functions.js"></script>

    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="css/NGcistrans_styles.css">


</head>
<body>

    <h1>Create a new project</h1>

    <div class="home-div">
        <button onclick="window.location = 'index.php';"><img src="jQuery/img/home.png" alt="Home" height="42" width="42"></button>
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

        // Avertissement
        case E_USER_WARNING:
            echo '<p><strong>Avertissement</strong> : '.$str.'</p>';
            break;

        // Note
        case E_USER_NOTICE:
            echo '<p><strong>Note</strong> : '.$str.'</p>';
            break;

        // Erreur générée par PHP
        default:
            echo '<p><strong>Erreur inconnue</strong> ['.$no.'] : '.$str.'<br/>';
            echo 'Dans le fichier : "'.$file.'", à la ligne '.$line.'.</p>';
            break;
    }
}

set_error_handler('my_error_handler');

$projectExist = file_get_contents("../access/groups");
$rows = explode("\n", $projectExist);

$projects =array();

foreach($rows as $row ) {
    $words_in_row = explode(":",$row);
    array_push($projects,$words_in_row[0]);
}

if(empty($_POST["Name_project"]) ){
    trigger_error('Please enter a name project for create it', E_USER_NOTICE);
}else {
        if (in_array($_POST["Name_project"],$projects)){
            foreach($projects as $proj) {
                echo $proj." <br> ";
            }
            trigger_error('The name project is already use. Please choose another one.', E_USER_NOTICE);
        }else{
            $pathFolder = "./workspace/ng-cistrans-reg_projects/" . $_POST["Name_project"];
            mkdir($pathFolder, 0777);//folder project
            $pathSubFolderData = "./workspace/ng-cistrans-reg_projects/" . $_POST["Name_project"] . "/data";
            mkdir($pathSubFolderData, 0777);//subfolder data
            $pathSubFolderResults = "./workspace/ng-cistrans-reg_projects/" . $_POST["Name_project"] . "/results";
            mkdir($pathSubFolderResults, 0777);//subfolder results
            $pathSubFolderScripts = "./workspace/ng-cistrans-reg_projects/" . $_POST["Name_project"] . "/scripts";
            mkdir($pathSubFolderScripts, 0777);//subfolder scripts
            echo "The creation of the project directory succeeded";
            echo "<br>";


            $htaccessfile = fopen($pathFolder . "/.htaccess", "w+");

            $contents = "\tAuthName \"restricted\" \n\tRequire group " . $_POST["Name_project"];

            if (fwrite($htaccessfile, $contents)) {
                echo "The access to the project has been correctly defined";

            } else {
                // Erreur
                echo "There is a problem with access restrictions to the project";
            }
            fclose($htaccessfile);

            $usersList = "";

            //echo count($_POST["User_access"]);

            if (!empty($_POST["User_access"])) {
                echo "c'est 0";
                for ($i = 0; $i < count($_POST["User_access"]); $i++) {
                    $usersList = $usersList . $_POST["User_access"][$i] . " ";
                }
            }

            $groupsfile = fopen("../access/groups", "a");

            $contentsgroups = "\n" . $_POST["Name_project"] . ": " . $_SERVER['REMOTE_USER'] . " " . $usersList;

            fwrite($groupsfile, $contentsgroups);

            fclose($groupsfile);

            $ownersfile = fopen("../access/project_owner", "a");

            $contentsowners = "\n" . $_POST["Name_project"] . ": " . $_SERVER['REMOTE_USER'];

            fwrite($ownersfile, $contentsowners);

            fclose($ownersfile);
        }
}

?>
</body>
