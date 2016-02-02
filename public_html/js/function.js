$(document).ready(function () {
	$("#sample_table ").on("click", "#addColButton" ,function () {

		var $this = $(this), $table = $this.closest('table');
		var columnName = window.prompt("Enter Column name", "");

		$('<th>' + columnName + '</th>').insertBefore($table.find('tr').first().find('th:last'));

		$('<td><input class= "' + columnName + '"type="text" name="Samples_informations[ '+ columnName + '][]" value="" /</td>').insertBefore($table.find('tr:gt(0)').find('td:last'))
	});

    $("#sample_table ").on("click", "#delColButton" ,function () {

        var $this = $(this), $table = $this.closest('table');
        var columnName = window.prompt("Enter Column name", "");

        $("th:contains(" + columnName + ")" ).remove(); //delete the title
        $("td").find('input[name="' + columnName + '[]"]').remove(); // delete the input element
        $("." + columnName +"").remove(); //delete the td element


    });

    $(".GoButton").click(function () {

        alert("hello, "+ $(this).attr("id") + " !");
        console.log(process.cwd());

        }
    )
});