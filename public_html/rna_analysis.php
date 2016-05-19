<?php
session_start();
/*session is started if you don't write this line can't use $_Session  global variable*/

//Part about Group assignation field
//input text on mode read only are filled automatically
$db = new SQLite3( $_SESSION["path_project"] . "/" . $_SESSION["project"] . ".db");// open the project database

$results = $db->query('SELECT * FROM files');//make request to get all md5sum and name who correspond to files uploaded
$filesTable2 = array();//create an array
$i = 0;
while($res = $results->fetchArray(SQLITE3_ASSOC)){// Store all results in an array
    $filesTable2[$i]['md5sum'] = $res['md5sum'];
    $filesTable2[$i]['name'] = $res['name'];
    $i++;
}

//Get name of each table defined
$allNameTables = $db->query('select name from sqlite_master where type="table"');//make request to get each table name
$allNameTablesDefined = array();//create an array

$i = 0;
while($oneNameTable = $allNameTables->fetchArray(SQLITE3_ASSOC)){// Store all results in an array
    $allNameTablesDefined[$i] = $oneNameTable["name"];
    $i++;
}

//Check if groups are defined
if( in_array("rna_groups_table",$allNameTablesDefined)){
    $numberOfGroups = $db->query('SELECT COUNT(*) FROM rna_groups_table');//make request to get all Group_name defined
    $numberOfGroupsArray = $numberOfGroups->fetchArray(SQLITE3_ASSOC);

    if( in_array("rna_groups_table",$allNameTablesDefined) && $numberOfGroupsArray["COUNT(*)"]>=1){
        //each groups defined are display by one checkbox
        $results2 = $db->query('SELECT Group_name FROM rna_groups_table');//make request to get all Group_name defined
        $groupsTable = array();//create an array
        $i = 0;
        while($res2 = $results2->fetchArray(SQLITE3_ASSOC)){// Store all results in an array
            $groupsTable[$i] = $res2["Group_name"];
            $i++;
        }
    }

}

//Check if at least 2 groups are defined and associated with at least one sample by group.
//Check if rna_groups_assignation table exist
if( in_array("rna_groups_assignation",$allNameTablesDefined)) {
    $groupsAssoToSample = $db->query('SELECT groups_associated FROM rna_groups_assignation');//make request to get all Group_name defined and associated with at least one sample
    $groupsAssoToSampleArray = array();
    $i = 0;
    while($resultsInter = $groupsAssoToSample->fetchArray(SQLITE3_ASSOC)){// Store all results in an array
        $groupsAssoToSampleArray[$i] = $resultsInter["groups_associated"];
        $i++;
    }
    $groupsAssoToSampleArrayUnique = array_unique($groupsAssoToSampleArray);

    foreach($groupsAssoToSampleArrayUnique as $toto){
        echo $toto;
    }
}

?>
<script type="text/javascript" src="js/NGcistrans_functions.js"></script>

<h2>Sample grouping</h2>

<form id="form-define-groups" action="define_groups.php" method="post">

    <fieldset>
        <legend>Group definitions</legend>

        <table id="group_definition">
            <tr>
                <th>Group_name</th>
                <th>Group_description</th>
            </tr>
            <tr id="group_definition_clone">
                <td class="Group_name"><input id="Group_name" class="input_without_space" type="text" name="Group_name[]" /></td>
                <td class="Group_description"><input id="Group_description" class="input_with_space" type="text" name="Group_description[]" /></td>
            </tr>
            <tr id="group_definition1">
                <td class="Group_name"><input id="Group_name1" class="input_without_space" type="text" name="Group_name[]" /></td>
                <td class="Group_description"><input id="Group_description1" class="input_with_space" type="text" name="Group_description[]" /></td>
            </tr>
            <tfoot>
            <tr>
                <td><a href="#!" id="add_group"> Add Group</a></td>
            </tr>
            </tfoot>
        </table>

        <p>This part is devoted to the definition of "groups". Whatever the type of data samples corresponding to a group, a condition.
            In RNA-seq there are different conditions such as "KOnameGene" or "WildType". A sample can belong to several groups.
            Please choose the name of groups wisely, without blankspace.</p>

    </fieldset>
    <input type="submit" value="Valider">

</form>

<form id="form-assignation-groups" action="rna_groups_assignation.php" method="post">
<fieldset>
    <legend>Sample-Group assignation</legend>

    <table id="group_assignation">
        <tr>
            <th>md5sum</th>
            <th>Sample_name</th>
            <th>Groups_available</th>
        </tr>
        <tr id="group_assignation_clone">
            <td class="md5sum2"><input id="md5sum" type="text" name="rna_groups_assignation[md5sum][]" readonly/></td>
            <td class="Sample_name2"><input id="Sample_name" type="text" name="rna_groups_assignation[Sample_name][]" readonly/></td>
            <td class="Groups_available2"></td>
        </tr>
        <tr id="group_assignation1">
            <td class="md5sum2"><input id="md5sum1" type="text" name="rna_groups_assignation[md5sum][]" readonly/></td>
            <td class="Sample_name2"><input id="Sample_name1" type="text" name="rna_groups_assignation[Sample_name][]" readonly/></td>
            <td class="Groups_available2"></td>
        </tr>

    </table>

</fieldset>
<input type="submit" value="Valider">

</form>

<h2>Design description</h2>

<p>Select groups/conditions you want to analyze, if some are not available it's because they are not associated with any sample.</p>

<form id="form-groups-to-analyse" action="write_design_file.php" method="post">


    <input type="submit" value="Valider">
</form>

<script type="text/javascript">
    function load_file_id_uploaded(){
        var tableId2 = <?php echo json_encode($filesTable2)?>;
        var $indexSample2 = 1;
        //first create lines
        var $numberOfLineToAdd = tableId2.length -1 ;
        while ($numberOfLineToAdd != 0) {
            $indexSample2++;
            var $newTr = $("#group_assignation tr:eq(1)").clone().attr("id", "group_assignation" + $indexSample2);
            $newTr.find("input").each(function () {
                $(this).val('').attr("id", function (_, id) {
                    return id + $indexSample2
                });
            }).end().appendTo("#group_assignation");

            $numberOfLineToAdd--;
        }
        //Fill these lines
        var indexFile = 0;
        $("td.md5sum2 input:not(td.md5sum2 input:eq(0))").each(function(){
            $(this).val(tableId2[indexFile]["md5sum"]);
            $(this).attr("placeholder",tableId2[indexFile]["md5sum"]);
            $(this).attr("value",tableId2[indexFile]["md5sum"]);
            indexFile++;
        });
        var indexFile = 0;
        $("td.Sample_name2 input:not(td.Sample_name2 input:eq(0))").each(function(){
            $(this).val(tableId2[indexFile]["name"]);
            $(this).attr("value",tableId2[indexFile]["name"]);
            $(this).attr("placeholder",tableId2[indexFile]["name"]);
            indexFile++;
        });
    };
</script>

<script type="text/javascript">
    function load_groups_defined() {
        var tableGroupsDefined = <?php echo json_encode($groupsTable)?>;
        var tableId2 = <?php echo json_encode($filesTable2)?>;
        //$("td.Groups_available2").append('<input type=checkbox class="clone">');

        tableGroupsDefined.forEach(function (entry) {
            for (var i=0; i < tableId2.length; i++){
                //console.log(i);
                var name = "rna_groups_assignation[" + tableId2[i]["md5sum"] +"][]";
                //console.log(name);
                var selectTd = "td.Groups_available2:eq("+(i+1)+")";
                //console.log(selectTd);
                $(selectTd).append('<input type=checkbox name=' + name +' value=' + entry + '>' + entry);
            }
        });

    }
    </script>

<script type="text/javascript">
    function load_groups_defined_and_associated_with_sample() {
        var tableGroupsDefinedAndAssoUnique = <?php echo json_encode($groupsAssoToSampleArrayUnique)?>;

        /*tableGroupsDefinedAndAssoUnique.forEach(function (entry) {
            $("#form-groups-to-analyse").append('<input type=checkbox name="condition_to_analyse[]" value=' + entry + '>' + entry);
        });*/
        Array.prototype.forEach.call(tableGroupsDefinedAndAssoUnique, entry =>{$("#form-groups-to-analyse").append('<input type=checkbox name="condition_to_analyse[]" value=' + entry + '>' + entry);})

    }
</script>


<?php if(!empty($filesTable2)){
    echo "<script type=\"text/javascript\">load_file_id_uploaded()</script>";
}?>

<?php if(!empty($groupsTable)){
    echo "<script type=\"text/javascript\">load_groups_defined()</script>";
}?>

<?php if(!empty($groupsAssoToSampleArrayUnique)){
    echo "<script type=\"text/javascript\">load_groups_defined_and_associated_with_sample()</script>";
}?>
