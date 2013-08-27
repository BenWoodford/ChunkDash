$.getJSON('/api/tasks/list', function(json, textStatus) {
	$.each(json.tasks, function(index, val) {
		var cat;
		var pclass;

		if(val.completed_by_id != null) {
			if(val.starred) {
				cat = $("#tasksHighPriority");
				pclass = "high";
			} else {
				cat = $("#tasksNormalPriority");
				pclass = "low";
			}
		} else {
			cat = $("#tasksCompleted");
			pclass = "medium";
		}

		var due;

		if(val.due_readable == null)
			due = "whenever";
		else
			due = val.due_readable;

		if(val.note == null)
			val.note = "";

		$(cat).append('<div class="task ' + pclass + ' row-fluid"><div class="desc span9"><div class="title">' + val.title + '</div><div>' + val.note + '</div></div><div class="time span3"><div class="date">' + due + '</div><div>created ' + val.created_ago + '</div></div>');
	});
});