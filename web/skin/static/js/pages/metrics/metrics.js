$(document).ready(function() {
	$('.daterange-prepick').each(function() {
		var picker = $(this);
		$(picker).daterangepicker(
		    {
		      timePicker: true,
		      timePickerIncrement: 30,
		      ranges: {
		      	 'Last Hour': [moment().subtract('hours', 1), moment()],
		         'Today': [moment(), moment()],
		         'Yesterday': [moment().subtract('days', 1), moment().subtract('days', 1)],
		         'Last 7 Days': [moment().subtract('days', 6), moment()],
		         'Last 30 Days': [moment().subtract('days', 29), moment()],
		         'This Month': [moment().startOf('month'), moment().endOf('month')],
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
						[ data.series ], {
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
							yaxis: { min: data.axis.y.min, max: data.axis.y.max },
							xaxis: {
						   		mode: "time",
						   		minTickSize: [1, data.axis.x.unit],
						   		min: new Date(data.axis.x.min * 1000),
						   		max: new Date(data.axis.x.max * 1000),
							},
							colors: data.colours,
					}
				);
			}
		});
	});
});