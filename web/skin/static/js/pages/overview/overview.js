$(document).ready(function() {
	$.getJSON('/api/graphs/social/week', function(data, textStatus) {
		var plot = $.plot($("#fbgraph"),
				[ { label: "Likes", data: data.facebook.likes } ], {
					series: {
						lines: { show: true,
							lineWidth: 2,
							fill: true, fillColor: { colors: [ { opacity: 0.5}, {opacity: 0.2}]}
						},
						points: { show: true },
						shadowSize: 0
					},
					grid: { hoverable: false,
						clickable: false,
						tickColor: "#dddddd",
						borderWidth: 0
					},
					legend: { show: true },
					yaxis: { min: 0, max: data.axis.y.max },
					xaxis: {
				   		mode: "time",
				   		minTickSize: [1, "day"],
					},
					colors: ["#3B5998"],
			}
		);
	});
});