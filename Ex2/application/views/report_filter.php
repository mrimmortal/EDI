<!DOCTYPE html>
<html>
<head>

	<title>Excel Import</title>
	<link rel="stylesheet" href="<?php echo base_url('bootstrap/css/bootstrap.min.css');?>">
	<script src="<?php echo base_url('bootstrap/js/bootstrap.min.js')?>"></script>	
	<script type="text/javascript" src="<?php echo base_url('bootstrap/js/jquery.min.js')?>"></script>
	<script type="text/javascript" src="<?php echo base_url('bootstrap/js/moment.min.js')?>"></script>
	<script type="text/javascript" src="<?php echo base_url('bootstrap/js/daterangepicker.min.js')?>"></script>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('bootstrap/css/daterangepicker.css');?>" />

	<style>

/* Style the tab */
.tab {
  overflow: hidden;
  border: 1px solid #ccc;
  background-color: #f1f1f1;
}

/* Style the buttons inside the tab */
.tab button {
  background-color: inherit;
  float: left;
  border: none;
  outline: none;
  cursor: pointer;
  padding: 14px 16px;
  transition: 0.3s;
  font-size: 17px;
}

/* Change background color of buttons on hover */
.tab button:hover {
  background-color: #ddd;
}

/* Create an active/current tablink class */
.tab button.active {
  background-color: #ccc;
}

/* Style the tab content */
.tabcontent {
  display: none;
  padding: 6px 12px;
  border: 1px solid #ccc;
  border-top: none;
}
</style>

</head>

<body>


<div align="center">
		<br>
		<div align="left" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 17%">
			<form action="<?php echo base_url()."Report/genrate_Report";?>" method="post">
				<input id="reportrange" type="text" name="daterange" class="fa fa-calendar" style="width: 100%"></input>

				<input  id="startdate" type="text" name="start_date" class="fa fa-calendar invisible" style="width: 100%" ></input>

				<input  id="enddate" type="text" name="end_date" class="fa fa-calendar invisible" style="width: 100%" ></input>
				<!-- <span></span> <i class="fa fa-caret-down"></i> -->
				<div align="center">
					<button class="btn btn-primary" type="submit" >Genrate Report</button>
				</div>
			</form>
		</div>
<!-- <br>
	<a class="btn btn-primary"href="<?php echo base_url()."Report/index";?>">Genrate Report</a> -->
</div>

<pre>
	<?php
	print_r($insident_pivot_data);
	 ?>
</pre>


<div class="tab">
  <button class="tablinks" onclick="openCity(event,'Incident_pivot')" id="defaultOpen">Incident Pivot</button>
  <button class="tablinks" onclick="openCity(event,'Sr_pivot')">SR Pivot</button>
  <button class="tablinks" onclick="openCity(event,'Trend_data')">Trend Data</button>
  <button class="tablinks" onclick="openCity(event,'Report')">Report</button>
</div>

<div id="Incident_pivot" class="tabcontent">
 <div class="row">
	<div class="col-lg-6">
		<table class="table border">
			<thead>
				<tr class="table-success">
					<th>No of Incidents</th>
					<th>Status</th>
				</tr>
				<tr>
					<th>Assignee</th>
					<th>Resolved</th>
					<th>Closed</th>
					<th>Total</th>
				</tr>
			</thead>
			<tbody>
				<?php

				$Total_Resolved=0;
				$Total_Close=0;
				$Total_Incident=0;

				foreach ($insident_pivot_data as $row) 
				{   
					$Total_Resolved = $Total_Resolved + $row->Resolved;
					$Total_Close = $Total_Close + $row->Closed;
					$Total_Incident = $Total_Incident + $row->incident_count;
				?> 	 
					<tr>
						<td><?php echo $row->assigned_to; ?></td>
						<td><?php echo $row->Resolved; ?></td>
						<td><?php echo $row->Closed; ?></td>
						<td><?php echo $row->incident_count; ?></td>
					</tr>
					<?php
				}   
					?>   
			</tbody>
			<tfoot>
				<tr>
					<th class="table-success">Total</th>
					<th> <?php echo $Total_Resolved; ?> </th>
					<th> <?php echo $Total_Close; ?> </th>
					<th> <?php echo $Total_Incident; ?> </th>
				</tr>
			</tfoot>
		</table>
	</div>
	<div class="col-lg-6">
		<table class="table border">
			<thead>
				<tr class="table-success">
					<th>Row Labels</th>
					<th>Average of MTTR</th>
				</tr>
				</thead>
				<tbody>
					<?php
					$Grand_Total= 0;
					foreach ($insident_pivot_data as $row) 
					{  
						$Grand_Total = $Grand_Total + $row->Avg_mmtr;
						?> 	 
						<tr>
							<td><?php echo $row->assigned_to; ?></td>
							<td><?php echo $row->Avg_mmtr; ?></td>       
						</tr>
						<?php
					}   
					?>   
				</tbody>
				<tfoot>
					<tr>
						<th class="table-success">Grand Total</th>
						<th ><?php echo $Grand_Total; ?></th>
					</tr>
				</tfoot>
			</table>
		</div>

		<div class="col-lg-6">
		<table class="table border">
			<thead>
				<tr class="table-success">
					<th>Status</th>
				</tr>
				<tr>
					<th>
						Open
					</th>
				</tr>

				</thead>
				<tbody>
					<?php
					$open_Total = 0;
					foreach ($insident_pivot_data as $row) 
					{  
						$open_Total = $open_Total + $row->Pending + $row->In_Process;
					}   
					?>   
					<tr>
						<td><?php echo $open_Total; ?></td>       
					</tr>
				</tbody>				
			</table>
		</div>

		<div class="col-lg-6">
		<table class="table border">
			<thead>
				<tr class="table-success">
					<th>Status</th>
					<th>Count</th>
				</tr>

				</thead>
				<tbody>
					<?php
					$pending_Total = 0;
					$in_process_Total = 0;
					$Grand_Total = 0;
					foreach ($insident_pivot_data as $row) 
					{  
						$pending_Total = $pending_Total + $row->Pending;
						$in_process_Total = $in_process_Total + $row->In_Process;
					}   
					?>   
					<tr>
						<td>In_Process</td>
						<td>
							<?php echo $in_process_Total; ?>
						</td>
					</tr>
					<tr>
						<td>Pending</td>   
						<td>
							<?php echo $pending_Total; ?>	
						</td>    
					</tr>					
				</tbody>		
				<tfoot>
					<tr>
						<th class="table-success">Grand Total</th>
						<th ><?php echo $Grand_Total = $in_process_Total + $pending_Total; ?></th>
					</tr>
				</tfoot>			
			</table>
		</div>

	</div>
</div>	

<div id="Sr_pivot" class="tabcontent">
  <h3>SR Pivot</h3>
</div>

<div id="Trend_data" class="tabcontent">
  <h3>Trend Data</h3>
</div>

<div id="Report" class="tabcontent">
  <h3>Report</h3>
</div>


<!-- <h4>
<pre>
<?php
print_r($formdata);	
?>
</pre>
</h4> 
-->


</body>
<script type="text/javascript">

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

<script>
function openCity(evt, cityName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}

// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").click();
</script>


</html>