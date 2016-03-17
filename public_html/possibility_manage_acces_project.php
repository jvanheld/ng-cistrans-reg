<?php
session_start();
/*session is started if you don't write this line can't use $_Session  global variable*/

//Part for Delete user to the current project
$contributors_file = file_get_contents("../access/groups");
$rows = explode("\n", $contributors_file);

$contributors_array =array();

foreach($rows as $row ) {
    $words_in_row = explode(":",$row);
    if ($_SESSION["project"] == $words_in_row[0]){
        $contributors = explode(" ", $words_in_row[1]);
        array_shift($contributors);
        foreach($contributors as $name){
            if($_SERVER['REMOTE_USER'] != $name){
                array_push($contributors_array, $name);
            }
        }

    }
};

// Part for Add user to the current project
$users_file = file_get_contents("../access/.htpasswd");
$rows = explode("\n", $users_file);

$users =array();

foreach($rows as $row ) {
    $words_in_row = explode(":",$row);
    if ($_SERVER['REMOTE_USER'] != $words_in_row[0] ){// User who are the project owner have to be exclude
        if (!in_array($words_in_row[0],$contributors_array)){// Users already include in this project can't be added again
            array_push($users, $words_in_row[0]);
        }
    }
};

?>
<h2>Manage access</h2>

<form id="create_project_form" action="modif_users_access.php"  method="post">
    <fieldset>
        <legend>Delete User</legend>
        Select users you withdraw from the project <br>
        <table id="revoke_user_access_table">
            <tr></tr>
        </table>

        <script type="text/javascript">
            var tableUsersToRevoke = <?php echo json_encode($contributors_array)?>;
            var userToRevoke_in_line = 0;
            tableUsersToRevoke.forEach(function(entry) {
                if (userToRevoke_in_line == 10){
                    $("#revoke_user_access_table").append("<tr></tr>");
                    userToRevoke_in_line =0;
                }
                $("#revoke_user_access_table tr:last").append("<td><input type='checkbox' name='revoke_user_access[]' value=" + entry + ">" + entry + "</td>");
                userToRevoke_in_line ++;
            })
        </script>

    </fieldset>

    <fieldset>
        <legend>Add user</legend>
        Select users you invite to collaborate on this project <br>
    <table id="new_user_access_table">
        <tr></tr>
    </table>

    <script type="text/javascript">
        var tableUsers = <?php echo json_encode($users)?>;
        var user_in_line = 0;
        tableUsers.forEach(function(entry) {
            if (user_in_line == 10){
                $("#new_user_access_table").append("<tr></tr>");
                user_in_line =0;
            }
            $("#new_user_access_table tr:last").append("<td><input type='checkbox' name='add_user_access[]' value=" + entry + ">" + entry + "</td>");
            user_in_line ++;
        })
    </script>
    </fieldset>
    <input type="submit" value="Valider">
</form>
