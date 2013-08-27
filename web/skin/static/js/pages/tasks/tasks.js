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

		cat.append('<div class="task ' + pclass + '"><div class="desc"><div class="title">' + val.title + '</div><div>' + val.note + '</div></div><div class="time"><div class="date">' + val.clean_date + '</div><div> ' + val.ago + '</div></div>');
	});
});