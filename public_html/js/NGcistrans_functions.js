$(document).ready(function () {

	$("#sample_table ").on("click", "#addColButton" ,function () {

		var $this = $(this), $table = $this.closest('table');
		var $columnName = window.prompt("Enter Column name", "");

        if ($columnName == null){

            return;
        }
        if (! /^[a-zA-Z0-9_-]+$/.test($columnName)){ // check if the string write by user is available
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

    $(document).on('keydown','.input_without_space',function (event) {
        switch (event.keyCode) {
            case 8:  // Backspace
            case 13: // Enter
            case 37: // Left
            case 38: // Up
            case 39: // Right
            case 40: // Down
                break;
            default:
                var regex = new RegExp("^[a-zA-Z0-9_-]+$");
                var key = event.key;
                if (!regex.test(key)) {
                    event.preventDefault();
                    alert("Blank and special characters are not allowed in this field. You can use \"-\" or \"_\"");
                    return false;
                }
                break;
        }
    });

    /*$('.input_without_space').on("keydown",function (event) {
        switch (event.keyCode) {
            case 8:  // Backspace
            case 13: // Enter
            case 37: // Left
            case 38: // Up
            case 39: // Right
            case 40: // Down
                break;
            default:
                var regex = new RegExp("^[a-zA-Z0-9_-]+$");
                var key = event.key;
                if (!regex.test(key)) {
                    event.preventDefault();
                    alert("Special characters are not allowed in this field.");
                    return false;
                }
                break;
        }

    });*/

    $(document).on('keydown','.input_with_space',function (event) {
        switch (event.keyCode) {
            case 8:  // Backspace
            case 13: // Enter
            case 37: // Left
            case 38: // Up
            case 39: // Right
            case 40: // Down
                break;
            default:
                var regex = new RegExp("^[a-zA-Z0-9\\s]+$");
                var key = event.key;
                if (!regex.test(key)) {
                    event.preventDefault();
                    alert("Special characters are not allowed in this field.");
                    return false;
                }
                break;
        }
    });

//    alert("Blank and special characters are not allowed in this field. You can use \"-\" or \"_\"");

    $(".Go").click(function () {

        $.ajax({
            type:"POST",
            url: "/ng-cistrans-reg/define_current_projet.php",
            data: {"currentProjet": $(this).attr("id") }
        });
    });

    $(".deleteFiles").click(function () {
        if(confirm("Are you sure you want to delete this file ? " + $(this).closest("tr").children(".Sample_name").children("input").attr("value"))){
            $.ajax({
                type:"POST",
                url: "/ng-cistrans-reg/manage_files.php",
                data: {"fileToDelete": $(this).closest("tr").children(".md5sum").children("input").attr("value") }
            });
        }
        location.reload();
    });

    $("#sample_table ").on("click", "#delColButton" ,function () {

        var $columnName = window.prompt("Enter Column name", "");

        if (! /^[a-zA-Z0-9]+$/.test($columnName)){ // check if the string write by user is available
            return;
        }
        $("th").filter(function() {
            return $(this).text() === $columnName;
        }).remove(); //delete the title
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
        alert('Do you want to delete this sample project?');
    });

    $indexContributor = 1;
    $("#Contributor_table").on("click","#addContributor",function () {
        $indexContributor++;
        //var $newEle = $("#Contributor_table tr:eq(0)").clone().attr("id", "tr_Contributor"+ $indexContributor);
        var $newEle = $("#Contributor_clone_td").clone().attr("id", "tr_Contributor"+ $indexContributor);
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

    $indexGroup = 1;
    $("#group_definition").on("click","#add_group",function () {
        $indexGroup++;
        var $newTr = $("#group_definition_clone").clone().attr("id", "group_definition"+ $indexGroup);
        $newTr.find("input").each(function() {
            $(this).val('').attr("id",function(_, id) { return id + $indexGroup });
        }).end().appendTo("#group_definition");
    });


    });