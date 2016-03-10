<!DOCTYPE html>
<html>
<head>
    <!-- META -->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Amidex Home Project</title>

    <script type="text/javascript" src="jQuery/jquery-1.12.0.js"></script>
    <script type="text/javascript" src="jQuery/DataTables-1.10.10/media/js/jquery.dataTables.js"></script>
    <script type="text/javascript" src="js/function.js"></script>

    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="css/mise_en_page.css">

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

            <!--<table class="dTable" id='User_access_table'>
                <tbody>
                <tr id="User_access_clone_td">
                    <td  class="User_access"><label for= "User_access_clone"><a href="#" class="info">User name<span>"Username" Each user on a separate case, add as many user cases as required.</span></a></label> <input type='text' name="User_access[]" id="User_access_clone" value="" ></td>
                    <td id="action"><a href="#!" id="deleteUser">Delete this user</a>
                </tr>
                <tr id="tr_User_acess1">
                    <td class="User_access"><label for= "User_access1"><a href="#" class="info">User name<span>"Username" Each user on a separate case, add as many user cases as required.</span></a></label> <input type='text' name="User_access[]" id="User_access1" value="" ></td>
                    <td id="action"><a href="#!" id="deleteUser">Delete this user</a>
                </tr>
                </tbody>

                <tfoot>
                <tr>
                    <th colspan="5"><a href="#!" id="addUser">Add a user</a></th>
                </tr>
                </tfoot>
            </table>-->
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