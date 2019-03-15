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

</head>

<body>
	<div align="center">
		<h1>Date Range Filter</h1>
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


<!--  	<h4>
		<pre>
	<?php
	print_r($formdata);	
	?>
	</pre>
	</h4> 
 -->

<div class="container">
  <table class="table">
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

    	foreach ($formdata as $row) 
    	{   
    		$Total_Resolved = $Total_Resolved + $row->Resolved;
    		$Total_Close =$Total_Close + $row->Closed;
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


<div class="container">
  <table class="table">
    <thead>
      <tr class="table-success">
        <th>Row Labels</th>
        <th>Average of MTTR</th>
    </thead>
    <tbody>
      <?php
    	$Grand_Total=0;
    	foreach ($formdata as $row) 
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


</html>