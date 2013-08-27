function loadNotifications(page) {
	$.getJSON('/api/notifications/full/' + page, function(json, textStatus) {
		$.each(json.tasks, function(index, val) {
			$("#messagesList").append('<li><span class="from"><span class="glypihons dislikes"><i></i></span> ' + val.type + '</span><span class="title">' + val.title + '</span><span class="date">' + val.ago + '</span></li>');
		});
	});
}

loadNotifications(1);