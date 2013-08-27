$.getJSON('/api/tasks/list', function(json, textStatus) {
	$.each(json.tasks, function(index, val) {
		var cat;
		var pclass;

		if(val.completed_by_id == null) {
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

		var subhtml = "";

		$.each(val.subtasks, function(sindex, sval) {
			 var tmp = "";

			 if(sval.completed_by_id != null) {
			 	tmp += "<strike>" + sval.title + "</strike>";
			 }

			 subhtml += tmp + ", ";
		});

		if(subhtml.charAt(subhtml.length - 1) == ',')
			subhtml.slice(0, -1);

		$(cat).append('<div id="task_' + val.id + '" data-task-id="' + val.id + '" class="task ' + pclass + ' row-fluid"><div class="desc span8"><div class="title"><a target="_blank" href="https://www.wunderlist.com/#/tasks/' + val.id + '">' + val.title + '</a></div><div><p>' + val.note + '</p><p><small>' + subhtml + '</small></p></div></div><div class="time span4"><div class="date">' + due + '</div><div>created ' + val.created_ago + '</div></div>');
	});
});