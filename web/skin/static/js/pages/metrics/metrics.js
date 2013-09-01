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
		        $(picker).find('span').html(start.format('MM D, YYYY h:mm A') + ' - ' + end.format('MM D, YYYY h:mm A'));
		        $(picker).find('input.start').val(start);
		        $(picker).find('input.end').val(end);
		    }
		);
	});
});