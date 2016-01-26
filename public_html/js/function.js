$(document).ready(function () {
	$("#boutonmort").click(function () {
        alert("oui oui !");
		//var $this = $(this), $table = $this.closest('table');
        $("#monid").html("Coucou");
		window.prompt("Enter Column name", "");

		//$('<th>' + columnName + '</th>').insertBefore($table.find('tr').first().find('th:last'));

		//var idx = $(this).closest('td').index() + 1;
		//$('<td><input type="text" name="col' + idx + '[]" value="" /</td>').insertBefore($table.find('tr:gt(0)').find('td:last'))
	});
});