function loadNotifications(page) {
	$.getJSON('/api/notifications/full/' + page, function(json, textStatus) {
		$.each(json, function(index, val) {
			$("#notificationsList").append('<li class="notification" data-notification-id="' . val.notification_id + '"><span class="from"><span class="glypihons dislikes"><i></i></span> ' + val.type + '</span><span class="title">' + val.title + '</span><span class="date" title="' + val.cleantime + '">' + val.ago + '</span></li>');
		});
	});

	$("#messagesList .message").click(function() {
		$.getJSON('/api/notifications/single/', function(json, textStatus) {
			var view = $("#notificationVew");

			$(view).find("#notificationTitle").text(json.title);
			$(view).find("#notificationText").text(json.text);
			$(view).find("#notificationTime").text(json.cleantime);
			$(view).find("#notificationLevel").text(json.level);
			$(view).find("#notificationType").text(json.type);
		});
	});
}

loadNotifications(parseInt($("#page_identifier").text()));