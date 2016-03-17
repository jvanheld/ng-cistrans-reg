<!DOCTYPE html>
<html>
<head>
    <!-- META -->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>NG-cistrans-reg Project</title>

    <script type="text/javascript" src="jQuery/jquery-1.12.0.js"></script>
    <script type="text/javascript" src="jQuery/DataTables-1.10.10/media/js/jquery.dataTables.js"></script>
    <script type="text/javascript" src="js/NGcistrans_functions.js"></script>

    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="css/NGcistrans_styles.css">

</head>
<body>

<h1>Create a new project</h1>

<div class="home-div">
    <button class="home" onclick="window.location = 'index.php';"> Home </button>
</div>

    <form id="create_project_form" action="create_project.php"  method="post">
        <fieldset>
            <legend>Information</legend>
        <label for= "Name_project"><a href="#" class="info">Project name <span>Enter the name project.</span></a></label>
        <input type='text' name="Name_project" id="Name_project" value="" ><br>

            Select users you invite to collaborate on this new project <br>
<?php
$txt_file = file_get_contents("../access/.htpasswd");
$rows = explode("\n", $txt_file);

$users =array();

foreach($rows as $row ) {
    $words_in_row = explode(":",$row);
    if ($_SERVER['REMOTE_USER'] != $words_in_row[0]){
        array_push($users, $words_in_row[0]);
    }

};

?>
            <table id="User_access_table">
                <tr></tr>
            </table>
            <script type="text/javascript">
                    var tableUsers = <?php echo json_encode($users)?>;
                    var user_in_line = 0;
                    tableUsers.forEach(function(entry) {
                        if (user_in_line == 10){
                            $("#User_access_table").append("<tr></tr>");
                            user_in_line =0;
                        }
                        $("#User_access_table tr:last").append("<td><input type='checkbox' name='User_access[]' value=" + entry + ">" + entry + "</td>");
                        user_in_line ++;
                    })
            </script>

        </fieldset>
        <input type="submit" value="Valider">
    </form>

</body>
</html>