/*								<li>
                                    <a href="#">
										+ <i class="halflings-icon white comment"></i> <span class="message">New comment</span> <span class="time">yesterday</span> 
                                    </a>
                                </li>*/

function getNotifications(firstPoll) {
	$.getJSON('/api/notifications/mini/' + $("#logged_in").text(), function(json, textStatus) {
		$.each(json, function(index, val) {
			if(!val.seen && window.webkitNotifications) {
				window.webkitNotifications.createNotification("icon.png", val.title, val.text);
			}
		});
	});
}

function setupNotifications() {
	if(window.webkitNotifications && window.webkitNotifications.checkPermission() > 0) {
		$("#notificationList").append('<li><a id="enable_notifications" class="dropdown-menu-sub-footer">Enable Chrome Notifications</a></li>');
		$("#enable_notifications").click(function( {
			window.webkitNotifications.requestPermission();
		});
	}
}

$(document).ready(function() {
	setupNotifications();
	getNotifications();
});