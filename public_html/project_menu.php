<?php
session_start();
/*session is started if you don't write this line can't use $_Session  global variable*/

?>

<!DOCTYPE html>
<html>
<head>
    <!-- META -->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>NG-cistrans-reg Home Project</title>

    <script type="text/javascript" src="jQuery/jquery-1.12.0.js"></script>
    <script type="text/javascript" src="js/NGcistrans_functions.js"></script>
    <!--- jQueryui --->
    <script type="text/javascript" src="jQuery/jquery-ui-1.11.4.custom/jquery-ui.js"></script>
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="css/NGcistrans_styles.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<!--    <link rel="stylesheet" href="/resources/demos/style.css">-->

</head>
<body>

<h1>Project: <?php echo $_SESSION["project"]?></h1>

<div class="home-div">
    <button onclick="window.location = 'index.php';"><img src="jQuery/img/home.png" alt="Home" height="42" width="42"></button>
</div>

<div class="logout">
    <a href="logout.php" >Logout</a>
</div>

<?php
/* Check if the user is the owner of the project, in order to display owner-specific actions*/
$txt_file = file_get_contents("../access/project_owner");
$rows = explode("\n", $txt_file);
foreach ($rows as $row ) {
    $words_in_row = explode(":",$row);
    //$words_in_row[0] is the name project and $words_in_row[1] is the owner name project
    if ($_SERVER['REMOTE_USER'] == trim($words_in_row[1])){
        if ($_SESSION["project"] == $words_in_row[0]){;?>
            <script>
                $(function() {
                    $("#project_actions ul").append("<li><a href='possibility_manage_acces_project.php'</a>Manage access users projects </li>");
                });
            </script>
<?php }}} ?>
    <script>
        $(function() {
            $("#project_actions").tabs({
                selected: -1,
                beforeLoad: function( event, ui ) {
                    ui.jqXHR.fail(function() {
                        ui.panel.html(
                            "Couldn't load this tab. We'll try to fix this as soon as possible. " +
                            "If this wouldn't be a demo." );
                    });
                }
            });


        });
    </script>

    <div class="toc_action_list" id="project_actions">
        <ul id="possibilities">
            <li><a href="possibility_upload_files.php">Upload new sequence files</a></li>
<!--            <li><a href="#files" id="show_files">Manage project files (version 1)</a></li>
            <li><a href="manage_files2.php" id="show_files2">Manage project files (version 2)</a></li>-->
            <li><a href="form_write_yaml.php">Manage project descriptions</a></li>
<!--            <li><a href="run_analysis.php">Run analysis</a></li>-->
            <li><a href="run_analysis.php">ChIP-seq Workflow</a></li>
            <li><a href="rna_analysis.php">RNA-seq Workflow</a></li>
            <li><a href="run_analysis.php">ChIP-seq and RNA-seq integration</a></li>

        </ul>
    </div>

<div id="files">

    <h2>Manage project Files</h2>
    <table class="nav_files">
    <tr>
        <th>File</th>
    </tr>
<?php
$adresse=$_SESSION["path_project"] . "/data/" ;
$dossier=Opendir($adresse);
while ($Fichier = readdir($dossier))
{
    if ($Fichier != "." && $Fichier != ".." && $Fichier != ".htaccess") // Filtre antipoint !<br/>
    {
        // C'est juste en dessous qu'il y a eu les modifications. <br/>
        echo '<tr><td><a href='.$adresse.$Fichier.' target="_blank">'.$Fichier.'</a></td>
        <td><button class="deleteFiles" id="'.$Fichier.'">Delete<img src="jQuery/img/delete.png" height="12" width="12"></button></td></tr><BR>';
    }
}
closedir($dossier);
?>
    </table>

</div>

</body>
</html>