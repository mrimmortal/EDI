<script type="text/javascript"> //customise date range filter 
	$(function() {
		var start = moment().subtract(6, 'days');
		var end = moment();

		function cb(start, end) {
// $('#reportrange').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
//document.getElementById('startdate').value = start.format('DD/MM/YYYY');
//document.getElementById('enddate').value = end.format('DD/MM/YYYY');
$('#startdate').val(start.format('MMMM D, YYYY'));
$('#enddate').val(end.format('MMMM D, YYYY'));
}

$('#reportrange').daterangepicker({
	startDate: start,
	endDate: end,
	ranges: {
		'Today': [moment(), moment()],
		'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
		'Last 7 Days': [moment().subtract(6, 'days'), moment()],
		'Last 30 Days': [moment().subtract(29, 'days'), moment()],
		'This Month': [moment().startOf('month'), moment().endOf('month')],
		'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
	}
}, cb);

cb(start, end);
});
</script>


<script> //Tabs Functions
	function openCity(evt, cityName) {
		var i, tabcontent, tablinks;
		tabcontent = document.getElementsByClassName("tabcontent");
		for (i = 0; i < tabcontent.length; i++) {
			tabcontent[i].style.display = "none";
		}
		tablinks = document.getElementsByClassName("tablinks");
		for (i = 0; i < tablinks.length; i++) {
			tablinks[i].className = tablinks[i].className.replace("active", "");
		}
		document.getElementById(cityName).style.display = "block";
		evt.currentTarget.className += " active";
	}
//Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").click();
</script>


<script> //Incident Pivot Chart
	new Chart(document.getElementById("chart_incident_pivot"), {
		type: 'bar',
				data: {
labels: ['3 Days','4-6 Days','7-9 Days','more than 9 days'], // responsible for how many bars are gonna show on the chart
// create 12 datasets, since we have 12 items
// data[0] = labels[0] (data for first bar - 'Standing costs') | data[1] = labels[1] (data for second bar - 'Running costs')
// put 0, if there is no data for the particular bar
datasets: [{
	label: 'Other Team/Group Dependency',
	data: [<?php echo $i3_days_other_team;?>,
	<?php echo $i4_6_days_other_team;?>,
	<?php echo $i7_9_days_other_team;?>,
	<?php echo $more_than_9_days_other_team?>],
	backgroundColor: '#22aa99'							
}, {
	label: 'User Response Awaited',
	data: [<?php echo $i3_days_user_response;?>,
	<?php echo $i4_6_days_user_response;?>,
	<?php echo $i7_9_days_user_response;?>,
	<?php echo $more_than_9_days_user_response;?>],
	backgroundColor: '#994499'														
}, {
	label: 'Vendor Dependency',
	data: [<?php echo $i3_days_vendor_dependency;?>,
	<?php echo $i4_6_days_vendor_dependency;?>,
	<?php echo $i7_9_days_vendor_dependency;?>,
	<?php echo $more_than_9_days_vendor_dependency;?>],
	backgroundColor: '#316395'
}, {
	label: 'In Progress',
	data: [<?php echo $i3_days_under_observation;?>,
	<?php echo $i4_6_days_under_observation;?>,
	<?php echo $i7_9_days_under_observation;?>,
	<?php echo $more_than_9_days_under_observation;?>],
	backgroundColor: '#b82e2e'														
}, {
	label: 'Under Observation',
	data: [<?php echo $i3_days_in_progress;?>,
	<?php echo $i4_6_days_in_progress;?>,
	<?php echo $i7_9_days_in_progress;?>,
	<?php echo $more_than_9_days_in_progress;?>],
	backgroundColor: '#66aa00'
},]
},
options: {
	responsive: false,
	legend: {
position: 'right' // place legend on the right side of chart
},
scales: {
	xAxes: [{
stacked: true // this should be set to make the bars stacked
}],
yAxes: [{
stacked: true // this also..
}]
}
}
	});
</script>

<script> //SR Pivote Chart
	var chart = new Chart(chart_sr_pivot, {
		type: 'bar',
		data: {
labels: ['15-50 Days','51-70 Days','71-90 Days','more than 90 days'], // responsible for how many bars are gonna show on the chart
// create 12 datasets, since we have 12 items
// data[0] = labels[0] (data for first bar - 'Standing costs') | data[1] = labels[1] (data for second bar - 'Running costs')
// put 0, if there is no data for the particular bar
datasets: [{
	label: 'Other Team/Group Dependency',
	data: [<?php echo $other_Team_15_50;?>,
	<?php echo $other_Team_51_70;?>,
	<?php echo $other_Team_71_90;?>,
	<?php echo $other_Team_90;?>],
	backgroundColor: '#22aa99'
}, {
	label: 'User Response Awaited',
	data: [<?php echo $user_response_awaited_15_50;?>,
	<?php echo $user_response_awaited_51_70;?>,
	<?php echo $user_response_awaited_71_90;?>,
	<?php echo $user_response_awaited_90;?>],
	backgroundColor: '#994499'
}, {
	label: 'Vendor Dependency',
	data: [<?php echo $vendor_dependency_15_50;?>,
	<?php echo $vendor_dependency_51_70;?>,
	<?php echo $vendor_dependency_71_90;?>,
	<?php echo $vendor_dependency_90;?>],
	backgroundColor: '#316395'
}, {
	label: 'In Progress',
	data: [<?php echo $in_progress_15_50;?>,
	<?php echo $in_progress_51_70;?>,
	<?php echo $in_progress_71_90;?>,
	<?php echo $in_progress_90;?>],
	backgroundColor: '#b82e2e'
}, {
	label: 'Scheduled Ticket',
	data: [<?php echo $scheduled_ticket_15_50;?>,
	<?php echo $scheduled_ticket_51_70;?>,
	<?php echo $scheduled_ticket_71_90;?>,
	<?php echo $scheduled_ticket_90;?>],
	backgroundColor: '#66aa00'
},]
},
options: {
	responsive: false,
	legend: {
position: 'right' // place legend on the right side of chart
},
scales: {
	xAxes: [{
stacked: true // this should be set to make the bars stacked
}],
yAxes: [{
stacked: true // this also..
}]
}
}
});
</script>

<script> //Incident Report Chart
	new Chart(document.getElementById("chart_incident_report"), {
		type: 'bar',
				data: {
labels: ['3 Days','4-6 Days','7-9 Days','more than 9 days'], // responsible for how many bars are gonna show on the chart
// create 12 datasets, since we have 12 items
// data[0] = labels[0] (data for first bar - 'Standing costs') | data[1] = labels[1] (data for second bar - 'Running costs')
// put 0, if there is no data for the particular bar
datasets: [{
	label: 'Other Team/Group Dependency',
	data: [<?php echo $i3_days_other_team;?>,
	<?php echo $i4_6_days_other_team;?>,
	<?php echo $i7_9_days_other_team;?>,
	<?php echo $more_than_9_days_other_team?>],
	backgroundColor: '#22aa99'							
}, {
	label: 'User Response Awaited',
	data: [<?php echo $i3_days_user_response;?>,
	<?php echo $i4_6_days_user_response;?>,
	<?php echo $i7_9_days_user_response;?>,
	<?php echo $more_than_9_days_user_response;?>],
	backgroundColor: '#994499'														
}, {
	label: 'Vendor Dependency',
	data: [<?php echo $i3_days_vendor_dependency;?>,
	<?php echo $i4_6_days_vendor_dependency;?>,
	<?php echo $i7_9_days_vendor_dependency;?>,
	<?php echo $more_than_9_days_vendor_dependency;?>],
	backgroundColor: '#316395'
}, {
	label: 'In Progress',
	data: [<?php echo $i3_days_under_observation;?>,
	<?php echo $i4_6_days_under_observation;?>,
	<?php echo $i7_9_days_under_observation;?>,
	<?php echo $more_than_9_days_under_observation;?>],
	backgroundColor: '#b82e2e'														
}, {
	label: 'Under Observation',
	data: [<?php echo $i3_days_in_progress;?>,
	<?php echo $i4_6_days_in_progress;?>,
	<?php echo $i7_9_days_in_progress;?>,
	<?php echo $more_than_9_days_in_progress;?>],
	backgroundColor: '#66aa00'
},]
},
options: {
	responsive: false,
	legend: {
position: 'right' // place legend on the right side of chart
},
scales: {
	xAxes: [{
stacked: true // this should be set to make the bars stacked
}],
yAxes: [{
stacked: true // this also..
}]
}
}
	});
</script>

<script> //SR Report Chart
	var chart = new Chart(chart_sr_report, {
		type: 'bar',
		data: {
labels: ['15-50 Days','51-70 Days','71-90 Days','more than 90 days'], // responsible for how many bars are gonna show on the chart
// create 12 datasets, since we have 12 items
// data[0] = labels[0] (data for first bar - 'Standing costs') | data[1] = labels[1] (data for second bar - 'Running costs')
// put 0, if there is no data for the particular bar
datasets: [{
	label: 'Other Team/Group Dependency',
	data: [<?php echo $other_Team_15_50;?>,
	<?php echo $other_Team_51_70;?>,
	<?php echo $other_Team_71_90;?>,
	<?php echo $other_Team_90;?>],
	backgroundColor: '#22aa99'
}, {
	label: 'User Response Awaited',
	data: [<?php echo $user_response_awaited_15_50;?>,
	<?php echo $user_response_awaited_51_70;?>,
	<?php echo $user_response_awaited_71_90;?>,
	<?php echo $user_response_awaited_90;?>],
	backgroundColor: '#994499'
}, {
	label: 'Vendor Dependency',
	data: [<?php echo $vendor_dependency_15_50;?>,
	<?php echo $vendor_dependency_51_70;?>,
	<?php echo $vendor_dependency_71_90;?>,
	<?php echo $vendor_dependency_90;?>],
	backgroundColor: '#316395'
}, {
	label: 'In Progress',
	data: [<?php echo $in_progress_15_50;?>,
	<?php echo $in_progress_51_70;?>,
	<?php echo $in_progress_71_90;?>,
	<?php echo $in_progress_90;?>],
	backgroundColor: '#b82e2e'
}, {
	label: 'Scheduled Ticket',
	data: [<?php echo $scheduled_ticket_15_50;?>,
	<?php echo $scheduled_ticket_51_70;?>,
	<?php echo $scheduled_ticket_71_90;?>,
	<?php echo $scheduled_ticket_90;?>],
	backgroundColor: '#66aa00'
},]
},
options: {
	responsive: false,
	legend: {
position: 'right' // place legend on the right side of chart
},
scales: {
	xAxes: [{
stacked: true // this should be set to make the bars stacked
}],
yAxes: [{
stacked: true // this also..
}]
}
}
});
</script>

<script> //Hide Buttion(for hidding range form) 
var myForm = $('#rangeForm');
var toggleMyForm = $('#toggleMyForm');

toggleMyForm.on('click', function(){
    myForm.toggle();
    myForm.is(":visible") ? $(this).html('Hide') : $(this).html('Show');
});
</script>


<script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js'></script>
<script> // Export PDF for all three tabs
	var inc_img;
    var sr_img;
    var repo_img;
    var trend_img;
	//export page
	$('#exportForm').click(function(){
  
  var pdf = new jsPDF('a', 'mm', 'a4');

  inc();
  sr();
  repo();
  trend();
  
  setTimeout(function(){
    pdf.addImage(inc_img, 'JPEG', 5, 5, 200, 0);
    pdf.addPage();
    pdf.addImage(sr_img, 'JPEG', 5, 5, 200, 0);
    pdf.addPage();
    pdf.addImage(repo_img, 'JPEG', 5, 5, 200, 0);
    pdf.addPage();
    pdf.addImage(trend_img, 'JPEG', 5, 5, 200, 0);
    pdf.save("export.pdf");
  }, 150);
 document.location.reload(true);
});
 
function inc()
{
	document.getElementById("defaultOpen").click();
	document.getElementById('Incident_pivot').className = "tabcontent1";
	html2canvas($('#Incident_pivot'), { //Incident_pivot
    onrendered: function(canvas) {    	
    	inc_img = canvas.toDataURL('image/jpeg', 1.0);
    }
  });
}
function sr()
{
	document.getElementById("defaultOpen1").click();
	document.getElementById('Sr_pivot').className = "tabcontent1";
	html2canvas($('#Sr_pivot'), { //Sr_pivot
    onrendered: function(canvas) {    	
    	sr_img = canvas.toDataURL('image/jpeg', 1.0);
    }
  });
}
function repo()
{
	document.getElementById("defaultOpen2").click();
	document.getElementById('Report').className = "tabcontent1";
	html2canvas($('#Report'), { //Report
    onrendered: function(canvas) {    	
    	repo_img = canvas.toDataURL('image/jpeg', 1.0);
    }
  });
}
function trend()
{
	document.getElementById("defaultOpen3").click();
	document.getElementById('Trend_data').className = "tabcontent1";
	html2canvas($('#Trend_data'), { //Trend_data
    onrendered: function(canvas) {    	
    	trend_img = canvas.toDataURL('image/jpeg', 1.0);
    }
  });
}
	
</script>
