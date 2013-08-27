$.getJSON('/api/tasks/list', function(json, textStatus) {
	$.each(json.tasks, function(index, val) {
		var cat;

		if(true) {
			if(val.starred) {
				cat = $("#tasksHighPriority");
			} else {
				cat = $("#tasksNormalPriority");
			}
		} else {
			cat = $("#tasksCompleted");
		}
	});
});