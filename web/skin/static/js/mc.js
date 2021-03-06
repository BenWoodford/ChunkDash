function getNotifications() {
	$.getJSON('/api/notifications/mini/' + $("#logged_in").text(), function(json, textStatus) {
		$("#notificationsListMini li.noti").remove();
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

			$("#notificationsListMini li#view_all").before('<li class="noti ' + val.level + '" id="notification_' + val.notification_id + '"><a href="#">&nbsp;<i class="halflings-icon ' + icon + ' white"></i> <span class="message">' + val.title + '</span> <span class="time">' + val.ago + '</span></a></li>');
		});
	});

	setTimeout("getNotifications()", 5000);
}

function setupNotifications() {
	if(window.webkitNotifications && window.webkitNotifications.checkPermission() > 0) {
		$("#notificationsListMini").append('<li><a id="enable_notifications" class="dropdown-menu-sub-footer">Enable Chrome Notifications</a></li>');
		$("#enable_notifications").click(function() {
			window.webkitNotifications.requestPermission();
		});
	}
}

$(document).ready(function() {
	setupNotifications();
	getNotifications();

	$("#sidemenu a.menu-item").click(function(e) {
		e.preventDefault();
		$("#content #innercontent").fadeOut();
		$("#sidemenu li").removeClass("active");
		$(this).parent("li").first().addClass("active");
		var page = $(this).data("page");
		$("#content").load(page + " #innercontent", function() {
			$("#content #innercontent").fadeIn();
			$.getScript("/skin/static/js/pages/" + page + "/" + page + ".js");
			template_functions();
		});
	});

	$("#viewAllNotifications").click(function() {
		$('#sidemenu a.menu-item[data-page="notifications"]').click();
	});
});