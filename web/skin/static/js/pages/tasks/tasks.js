$.getJSON('/api/tasks/list', function(json, textStatus) {
	$.each(json.tasks, function(index, val) {
		 console.log(val);
	});
});