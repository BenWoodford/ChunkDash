/*								<li>
                                    <a href="#">
										+ <i class="halflings-icon white comment"></i> <span class="message">New comment</span> <span class="time">yesterday</span> 
                                    </a>
                                </li>*/

function getNotifications() {
	$.getJSON('/api/notifications/mini/' + $("#logged_in").text(), function(json, textStatus) {
		$.each(json, function(index, val) {
			console.log(val);
		});
	});
}

$(document).ready(function() {
	getNotifications();
});