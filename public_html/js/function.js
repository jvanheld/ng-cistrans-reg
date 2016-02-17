$(document).ready(function () {

	$("#sample_table ").on("click", "#addColButton" ,function () {

		var $this = $(this), $table = $this.closest('table');
		var $columnName = window.prompt("Enter Column name", "");

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

    $("#sample_table ").on("click", "#delColButton" ,function () {

        var $columnName = window.prompt("Enter Column name", "");

        $("th:contains(" + $columnName + ")" ).remove(); //delete the title
        $("td").find('input[name="' + $columnName + '[]"]').remove(); // delete the input element
        $("." + $columnName +"").remove(); //delete the td element


    });

    $(".GoButton").click(function () {

        alert("hello, "+ $(this).attr("id") + " !");


        }
    );


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
        $indexSample--;
        var $indexRenameSample = $indexSample;
        $("#sample_table tbody tr:not('#Data_clone')").each(function() {
            $(this).val('').attr('id',"Data" + $indexRenameSample );
            $(this).find("input").each(function() {
                $(this).val('').attr('id',function(_, id) { return id.substr(0,id.length-1) + $indexRenameSample});
            });
            $indexRenameSample--;
        })

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
        $indexContributor--;
        var $indexRename = $indexContributor;
        $("#Contributor_table tbody tr:not('#Contributor_clone_td')").each(function() {
            $(this).val('').attr('id',"tr_Contributor" + $indexRename );
            $(this).find("input").each(function() {
                $(this).val('').attr('id',"Contributor" + $indexRename);
            });
            $indexRename--;
        })
    });


    });