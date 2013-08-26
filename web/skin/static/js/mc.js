function getNotifications() {
	$.getJSON('/api/notifications/mini/' + $("#logged_in").text(), function(json, textStatus) {
		$("#notificationsList li.noti").remove();
		$.each(json, function(index, val) {
			if(!val.seen && window.webkitNotifications) {
				notification = window.webkitNotifications.createNotification("/skin/static/img/notificationicon.png", val.title, val.text);
				notification.show();
			}

			var icon = "info-sign";

			if(val.type == "kick")
				icon = "warning-sign";
			else if(val.type == "ban")
				icon = "remove";
			else if(val.type == "callstaff")
				icon = "phone_alt";
			else if(val.type == "mute")
				icon = "volume-off";
			else if(val.type == "jail")
				icon = "align-justify";

			$("#notificationsList li#view_all").before('<li class="noti ' + val.level + '" id="notification_' + val.notification_id + '"><a href="#">&nbsp;<i class="halflings-icon ' + icon + ' white"></i> <span class="message">' + val.title + '</span> <span class="time">' + val.ago + '</span></a></li>');
		});
	});

	setTimeout("getNotifications()", 5000);
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