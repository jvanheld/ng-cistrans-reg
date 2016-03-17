$(document).ready(function () {

	$("#sample_table ").on("click", "#addColButton" ,function () {

		var $this = $(this), $table = $this.closest('table');
		var $columnName = window.prompt("Enter Column name", "");

        if ($columnName == null){
            //$("#sample_table ").stop(true,true);
            return;
        }
        if (! /^[a-zA-Z0-9]+$/.test($columnName)){
            return;
        }

		$('<th>' + $columnName + '</th>').insertBefore($table.find('tr').first().find('th:last'));

        //var $numberLine =  ;
        var $lastTd = $table.find('tr:gt(0)').find('td:last');

        var $compteur = 0;
        $lastTd.each(function(){
            if ($compteur == 0){
                $('<td class= ' + $columnName +'><input id="'+ $columnName +'" class= "' + $columnName + '"type="text" name="Samples_information['+ $columnName + '][]" value="" ></td>').insertBefore($(this));
                $compteur++;
                }
            else {
                $('<td class= ' + $columnName +'><input id="'+ $columnName+$compteur +'" class= "' + $columnName + '"type="text" name="Samples_information['+ $columnName + '][]" value="" ></td>').insertBefore($(this));
                $compteur++;
                }

        });

    });

    $(".Go").click(function () {

        $.ajax({
            type:"POST",
            url: "/ng-cistrans-reg/define_current_projet.php",
            data: {"currentProjet": $(this).attr("id") }
        });
        //window.location = "/ng-cistrans-reg/display_possibilities.php";
    });
    /*$("#create_project_button").click(function () {
        window.location = "/ng-cistrans-reg/create_project_form.php";
    });*/

    $("#sample_table ").on("click", "#delColButton" ,function () {

        var $columnName = window.prompt("Enter Column name", "");

        if (! /^[a-zA-Z0-9]+$/.test($columnName)){ // check if the string write by user is available
            return;
        }

        $("th:contains(" + $columnName + ")" ).remove(); //delete the title
        $("td").find('input[name="' + $columnName + '[]"]').remove(); // delete the input element
        $("." + $columnName +"").remove(); //delete the td element


    });

    $indexSample = 1;
    $("#sample_table ").on("click","#action_addLine",function (){
        $indexSample++;
        var $newTr = $("#sample_table tr:eq(1)").clone().attr("id", "Data"+ $indexSample);
        $newTr.find("input").each(function() {
            $(this).val('').attr("id",function(_, id) { return id + $indexSample });
        }).end().appendTo("#sample_table");
    });


    $("#sample_table ").on("click","#action_deleteLine",function (){
        $(this).parents().eq(1).remove();
    });

    $indexContributor = 1;
    $("#Contributor_table").on("click","#addContributor",function () {
        $indexContributor++;
        var $newEle = $("#Contributor_table tr:eq(0)").clone().attr("id", "tr_Contributor"+ $indexContributor);
        $newEle.find("input").each(function() {
            $(this).val('').attr('id',"Contributor" + $indexContributor);
        }).end().appendTo("#Contributor_table");
    });

    $("#Contributor_table").on("click","#deleteContributor",function () {
        $(this).parents().eq(1).remove();
    });

    $indexUser = 1;
    $("#User_access_table").on("click","#addUser", function() {
        $indexUser++;
        var $newEle = $("#User_access_table tr:eq(0)").clone().attr("id", "tr_User_acess"+ $indexUser);
        $newEle.find("input").each(function() {
            $(this).val('').attr('id',"User_acess" + $indexUser);
        }).end().appendTo("#User_access_table");
    });

    $("#User_access_table").on("click","#deleteUser",function() {
        $(this).parents().eq(1).remove();
    });


    });