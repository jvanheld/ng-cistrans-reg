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
<!--    a refaire-->

    <script type="text/javascript" src="jQuery/jquery-1.12.0.js"></script>
    <script type="text/javascript" src="js/NGcistrans_functions.js"></script>
    <!--- jQueryui --->
    <script type="text/javascript" src="jQuery/jquery-ui-1.11.4.custom/jquery-ui.js"></script>
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="css/NGcistrans_styles.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<!--    <link rel="stylesheet" href="/resources/demos/style.css">-->

</head>

<h1>Welcome to the <?php echo $_SESSION["project"]?> project</h1>


<div class="home-div">
    <a href='index.php';">Home</a>
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

<!-- Check if there are already files in the project and adapt the menu accordingly -->
<!--//if (count(scandir($_SESSION["path_project"] . "/data")) != 2): -->

    <script>
        $(function() {
            $( "#project_actions" ).tabs({
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
        <ul>
            <li><a href="possibility_upload_files.php">Upload new sequence files</a></li>
            <li><a href="form_write_yaml.php">Manage project descriptions</a></li>
            <li><a href="run_analysis.php">Run analysis</a></li>
        </ul>

    </div>


</body>
</html>