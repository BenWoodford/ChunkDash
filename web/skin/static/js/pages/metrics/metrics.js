$(document).ready(function() {
	var colours = ["#FA5833", "#2FABE9", "#FABB3D", "#78CD51"];

	$('.daterange-prepick').each(function() {
		var picker = $(this);
		$(picker).daterangepicker(
		    {
		      timePicker: true,
		      timePickerIncrement: 30,
		      ranges: {
		      	 'Last Hour': [moment().subtract('hours', 1), moment()],
		         'Today': [moment().startOf('day'), moment()],
		         'Yesterday': [moment().subtract('days', 1).startOf('day'), moment().subtract('days', 1).endOf('day')],
		         'Last 7 Days': [moment().subtract('days', 6).startOf('day'), moment().endOf('day')],
		         'Last 30 Days': [moment().subtract('days', 29).startOf('day'), moment().endOf('day')],
		         'This Month': [moment().startOf('month').startOf('day'), moment().endOf('month').endOf('day')],
		         'Last Month': [moment().subtract('month', 1).startOf('month'), moment().subtract('month', 1).endOf('month')]
		      },
		      startDate: moment().subtract('days', 29),
		      endDate: moment(),
		    },
		    function(start, end) {
		        $(picker).find('span').html(start.format('MMM D, YYYY h:mm A') + ' - ' + end.format('MMM D, YYYY h:mm A'));
		        $(picker).find('input.start').val(start);
		        $(picker).find('input.end').val(end);
		    }
		);
	});

	$("#graph-it").click(function(e) {
		e.preventDefault();
		$.post('/api/graphs', $("#filterForm").serialize(), function(data, textStatus, xhr) {
			if(data.series.length > 0) {
				var plot = $.plot($("#graph"),
						data.series, {
							series: {
								lines: { show: true,
									lineWidth: 2,
								},
								points: { show: true },
								shadowSize: 2
							},
							grid: { hoverable: false,
								clickable: false,
								tickColor: "#dddddd",
								borderWidth: 0
							},
							legend: { position: 'ne' },
							yaxis: { min: data.axis.y.min, max: data.axis.y.max },
							xaxis: {
						   		mode: "time",
						   		minTickSize: [1, data.axis.x.unit],
						   		min: (new Date(data.axis.x.min)).getTime(),
						   		max: (new Date(data.axis.x.max)).getTime(),
							},
							colors: colours.slice(0,data.series.length),
					}
				);
			}
		});
	});

	$("#graph-it").click(); // First click, why re-invent the wheel?
});