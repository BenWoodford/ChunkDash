function getNotifications(firstPoll) {
	$.getJSON('/api/notifications/mini/' + $("#logged_in").text(), function(json, textStatus) {
		$("#notificationsList li.noti").remove();
		$.each(json, function(index, val) {
			if(!val.seen && window.webkitNotifications) {
				notification = window.webkitNotifications.createNotification("/skin/static/img/notificationicon.png", val.title, val.text);
				notification.show();
			}

			$("#notificationsList li#view_all").before('<li class="noti" id="notification_' + val.notification_id + '"><a href="#">&nbsp;<i class="halflings-icon white comment"></i> <span class="message">' + val.title + '</span> <span class="time">' + val.ago + '</span></a></li>');
		});
	});
}

function setupNotifications() {
	if(window.webkitNotifications && window.webkitNotifications.checkPermission() > 0) {
		$("#notificationsList").append('<li><a id="enable_notifications" class="dropdown-menu-sub-footer">Enable Chrome Notifications</a></li>');
		$("#enable_notifications").click(function() {
			window.webkitNotifications.requestPermission();
		});
	}
}

$(document).ready(function() {
	setupNotifications();
	getNotifications();
});