var employees = employees || []; //Sets a default if the variable is missing.

$(function(){
	/*
	 * DataTables will build out the table once the array has been loaded into the Javascript.
	 *
	 * lengthMenu: [labels], [items to show]
	 * order: column number (boss id), direction
	 */
	$('#employees').DataTable({
		lengthMenu: [[100, 50, 10], [100, 50, 10]],
		order: [[ 2, "asc" ]],
		searching: false,
		data: employees,
		columns: [
			{ title: 'Employee Name' },
			{ title: 'Boss Name' },
			{ title: 'Distance from CEO' }
		]
	});
});