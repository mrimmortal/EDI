<!DOCTYPE html>
<html>
<head>

	<title>Excel Import</title>
	<link rel="stylesheet" href="<?php echo base_url('bootstrap/css/bootstrap.min.css');?>">
	<script src="<?php echo base_url('bootstrap/js/bootstrap.min.js')?>"></script>	

	<script type="text/javascript" src="<?php echo base_url('bootstrap/js/jquery.min.js')?>"></script>
	<script type="text/javascript" src="<?php echo base_url('bootstrap/js/moment.min.js')?>"></script>
	<script type="text/javascript" src="<?php echo base_url('bootstrap/js/daterangepicker.min.js')?>"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('bootstrap/css/daterangepicker.css');?>" />
    <!-- https://stackoverflow.com/questions/29228163/call-javascript-a-function-in-html-submit-button -->
	<style>
		/* Style the tab */
		.tab {
			float: left;
			border: 1px solid #ccc;
			background-color: #f1f1f1;
			width: 9%;
			height: 10%;
		}

		/* Style the buttons inside the tab */
		.tab button {
			display: block;
			background-color: inherit;
			color: black;
			padding: 22px 16px;
			width: 100%;
			border: none;
			outline: none;
			text-align: left;
			cursor: pointer;
			transition: 0.3s;
			font-size: 17px;
		}

		/* Change background color of buttons on hover */
		.tab button:hover {
			background-color: #ddd;
		}

		/* Create an active/current "tab button" class */
		.tab button.active {
			background-color: #ccc;
		}

		/* Style the tab content */
		.tabcontent {
			float: left;
			padding: 0px 12px;
			width: 91%;
			border-left:none;
			height: 500px;
			overflow-y:scroll;
		}
			.tabcontent1 {
				background-color: white;
		}
	</style>
</head>
<body>
	<div id = "rangeForm" align="center">
		<br>
		<div align="left" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 17%">
			<form action="<?php echo base_url()."Report/genrate_Report";?>" method="post">
				<input id="reportrange" id="a" type="text" name="daterange" class="fa fa-calendar" style="width: 100%; margin-top: 8px; text-align: center;"></input>

				<input  id="startdate" type="text" name="start_date" class="fa fa-calendar invisible" style="width: 100%" ></input>

				<input  id="enddate" type="text" name="end_date" class="fa fa-calendar invisible" style="width: 100%" ></input>
				<!-- <span></span> <i class="fa fa-caret-down"></i> -->
				<div align="center">
					<button class="btn btn-primary" type="submit" style="margin-top:-35px; margin-bottom: 8px;" >Genrate Report</button>
				</div>
			</form>
		</div>
<!-- <br>
	<a class="btn btn-primary"href="<?php echo base_url()."Report/index";?>">Genrate Report</a> -->
</div>


<!-- <pre>
	<?php
	if($sr_pivot_data != null)
	{
		print_r($trend_data);
	}
	?>
</pre> -->
<div style="margin: 10px;
    
    text-align: right;" >
	<button class="btn btn-primary col-lg-2" id='toggleMyForm'>Hide</button>
</div>

<div style="margin: 10px;
    
    text-align: right;" >
	<button class="btn btn-primary" id='exportForm'>Export to PDF</button>
	 
</div>

<div class="row">
	<div class="col-lg-12">
	</br>

	<h5 align="center">
		<?php
		if($start_date!= null && $end_date!= null)
		{
			echo "Report From ".$start_date." To ".$end_date;
		}
		?>
	</h5>
</br>
</div>
</div>

<div class="tab">
	<button class="tablinks btn btn-primary" onclick="openCity(event,'Incident_pivot')" id="defaultOpen">Incident Pivot</button>
	<button class="btn btn-primary tablinks" onclick="openCity(event,'Sr_pivot')" id="defaultOpen1">SR Pivot</button>
	<button class="btn btn-primary tablinks" onclick="openCity(event,'Report')" id="defaultOpen2">Report</button>
	<button class="btn btn-primary tablinks" onclick="openCity(event,'Trend_data')" id="defaultOpen3">Trend Data</button>
</div>

<div id="Incident_pivot" class="tabcontent">
	<h3>Incident Pivot</h3>
	<div class="row">
		<div class="col-lg-auto"> <!-- Assignee,Resolved,Closed,Total -->
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
					if($insident_pivot_data)
					{
						$i_Total_Resolved=0;
						$i_Total_Close=0;
						$i_Total_R_C_Incident=0;
						$i_New_incident=0;

						foreach ($insident_pivot_data as $row) 
						{   
							$i_Total_Resolved = $i_Total_Resolved + $row->Resolved;
							$i_Total_Close = $i_Total_Close + $row->Closed;
							$i_New_incident = $i_New_incident +$row->New_Count;
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
							<th> <?php echo $i_Total_Resolved; ?> </th>
							<th> <?php echo $i_Total_Close; ?> </th>
							<th> <?php echo $i_Total_R_C_Incident = $i_Total_Close + $i_Total_Resolved; ?> </th>
						</tr>
					</tfoot>
					<?php
				}   
				?>
			</table>
		</div>
		<div class="col-lg-auto"> <!-- Row Labels,Average of MTTR -->
			<table class="table border">
				<thead>
					<tr class="table-success">
						<th>Row Labels</th>
						<th>Average of MTTR</th>
					</tr>
				</thead>
				<tbody>
					<?php
					if($insident_pivot_data != null){
						$i_avg_mmtr_Grand_Total= 0;
						$i_c=0;
						foreach ($insident_pivot_data as $row) 
						{  
							$i_c++;
						   $i_avg_mmtr_Grand_Total = $i_avg_mmtr_Grand_Total + $row->Avg_mmtr;
							?> 	 
							<tr>
								<td><?php echo $row->assigned_to; ?></td>
								<td><?php echo round($row->Avg_mmtr,2); ?></td>       
							</tr>
							<?php
						}   
						?>   
					</tbody>
					<tfoot>
						<tr>
							<th class="table-success">Grand Total</th>
							<th><?php echo round($i_avg_mmtr_Grand_Total=($i_avg_mmtr_Grand_Total/$i_c),2);?></th>
						</tr>
					</tfoot>
					<?php
				}
				?>
			</table>
		</div>
		<div class="col-lg-auto"> <!-- Status,Open -->
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
					if($insident_pivot_data != null){
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
					<?php
				}
				?>				
			</table>
		</div>
		<div class="col-lg-auto"><!-- Status,Count -->
			<table class="table border">
				<thead>
					<tr class="table-success">
						<th>Status</th>
						<th>Count</th>
					</tr>

				</thead>
				<tbody>
					<?php
					if($insident_pivot_data != null)
					{
						$i_pending_Total = 0;
						$i_in_process_Total = 0;
						$i_Grand_Total = 0;
						foreach ($insident_pivot_data as $row) 
						{  
							$i_pending_Total = $i_pending_Total + $row->Pending;
							$i_in_process_Total = $i_in_process_Total + $row->In_Process;
						}   
						?>   
						<tr>
							<td>In_Process</td>
							<td>
								<?php echo $i_in_process_Total; ?>
							</td>
						</tr>
						<tr>
							<td>Pending</td>   
							<td>
								<?php echo $i_pending_Total; ?>	
							</td>    
						</tr>					
					</tbody>		
					<tfoot>
						<tr>
							<th class="table-success">Grand Total</th>
							<th ><?php echo $Grand_Total = $i_in_process_Total + $i_pending_Total; ?></th>
						</tr>
					</tfoot>
					<?php
				}
				?>			
			</table>
		</div>		
		<div class="col-lg-auto"><!-- Row Lables,Count of Incident ID -->
			<table class="table border">
				<thead>
					<tr class="table-success">
						<th>Row Lables</th>
						<th>Count of Incident ID </th>
					</tr>

				</thead>
				<tbody>
					<?php
					if($insident_pivot_data != null)
					{
						$i_yes_Total = 0;
						$i_no_Total = 0;
						$incident_total = 0;
						$i_yes_no_Grand_Total = "100%";
						foreach ($insident_pivot_data as $row) 
						{  
							$i_yes_Total = $i_yes_Total + $row->resolution_violation_yes;
							$i_no_Total = $i_no_Total + $row->resolution_violation_no;
							$incident_total = $i_yes_Total + $i_no_Total;
						}   
						?>   
						<tr>
							<td>Yes</td>
							<td>
								<?php 
								$i_yes_Total = $i_yes_Total/$incident_total;
								echo round($i_yes_Total*100,0)."%" ;
								?>
							</td>
						</tr>
						<tr>
							<td>No</td>   
							<td>
								<?php
								$i_no_Total = $i_no_Total/$incident_total;
								echo round($i_no_Total*100,0)."%";
								?>	
							</td>    
						</tr>					
					</tbody>		
					<tfoot>
						<tr>
							<th class="table-success">Grand Total</th>
							<th><?php echo $i_yes_no_Grand_Total; ?></th>
						</tr>
					</tfoot>
					<?php
				}
				?>			
			</table>
		</div>
		<div class="col-lg-auto"><!-- Row Labels,User Response Awaited,Grand Total -->
			<table class="table border">
				<thead>
					<tr class="table-success">
						<th>Count of Incident ID</th>
						<th>Column Labels</th>
					</tr>
					<tr class="table-success">
						<th>Row Labels</th>
						<th>Other Team/Group Dependency</th>						
						<th>User Response Awaited</th>
						<th>In Progress</th>
						<th>Under Observation</th>
						<th>Vendor Dependency</th>
						<th>Grand Total</th>
					</tr>
				</thead>
				<tbody>
					<?php
					if($insident_pivot_data != null)
					{
						$i_backlog= 0;

						$i3_days_other_team = 0;
						$i3_days_user_response = 0;
						$i3_days_in_progress = 0;
						$i3_days_under_observation = 0;
						$i3_days_vendor_dependency = 0;

						$i4_6_days_other_team = 0;
						$i4_6_days_user_response = 0;
						$i4_6_days_in_progress = 0;
						$i4_6_days_under_observation = 0;
						$i4_6_days_vendor_dependency = 0;

						$i7_9_days_other_team = 0;
						$i7_9_days_user_response = 0;
						$i7_9_days_in_progress = 0;
						$i7_9_days_under_observation = 0;
						$i7_9_days_vendor_dependency = 0;

						$more_than_9_days_other_team = 0;
						$more_than_9_days_user_response = 0;
						$more_than_9_days_in_progress = 0;
						$more_than_9_days_under_observation = 0;
						$more_than_9_days_vendor_dependency = 0;

						foreach ($insident_pivot_data as $row) 
						{  
							$i3_days_other_team = $i3_days_other_team + $row->i3_days_other_team;
							$i3_days_user_response = $i3_days_user_response + $row->i3_days_user_response;
							$i3_days_in_progress = $i3_days_in_progress + $row->i3_days_in_progress;
							$i3_days_under_observation = $i3_days_under_observation + $row->i3_days_under_observation;
							$i3_days_vendor_dependency = $i3_days_vendor_dependency + $row->i3_days_vendor_dependency;

							$i4_6_days_other_team = $i4_6_days_other_team + $row->i4_6_days_other_team;
							$i4_6_days_user_response = $i4_6_days_user_response + $row->i4_6_days_user_response;
							$i4_6_days_in_progress = $i4_6_days_in_progress + $row->i4_6_days_in_progress;
							$i4_6_days_under_observation = $i4_6_days_under_observation + $row->i4_6_days_under_observation;
							$i4_6_days_vendor_dependency = $i4_6_days_vendor_dependency + $row->i4_6_days_vendor_dependency;

							$i7_9_days_other_team = $i7_9_days_other_team + $row->i7_9_days_other_team;
							$i7_9_days_user_response = $i7_9_days_user_response + $row->i7_9_days_user_response;
							$i7_9_days_in_progress = $i7_9_days_in_progress + $row->i7_9_days_in_progress;
							$i7_9_days_under_observation = $i7_9_days_under_observation + $row->i7_9_days_under_observation;
							$i7_9_days_vendor_dependency = $i7_9_days_vendor_dependency + $row->i7_9_days_vendor_dependency;

							$more_than_9_days_other_team = $more_than_9_days_other_team + $row->more_than_9_days_other_team;
							$more_than_9_days_user_response = $more_than_9_days_user_response + $row->more_than_9_days_user_response;
							$more_than_9_days_in_progress = $more_than_9_days_in_progress + $row->more_than_9_days_in_progress;
							$more_than_9_days_under_observation = $more_than_9_days_under_observation + $row->more_than_9_days_under_observation;
							$more_than_9_days_vendor_dependency = $more_than_9_days_vendor_dependency + $row->more_than_9_days_vendor_dependency;
						}   

						?>  
						<tr>
							<td>3 Days</td>
							<td><?php echo $i3_days_other_team; ?></td>
							<td><?php echo $i3_days_user_response; ?></td>
							<td><?php echo $i3_days_in_progress; ?></td>
							<td><?php echo $i3_days_under_observation; ?></td>
							<td><?php echo $i3_days_vendor_dependency; ?></td>
							<td><?php echo $i3_days_other_team+
							$i3_days_user_response+
							$i3_days_in_progress+
							$i3_days_under_observation+
							$i3_days_vendor_dependency; ?></td>
						</tr>
						<tr>
							<td>4-6 Days</td>
							<td><?php echo $i4_6_days_other_team; ?></td>
							<td><?php echo $i4_6_days_user_response; ?></td>
							<td><?php echo $i4_6_days_in_progress; ?></td>
							<td><?php echo $i4_6_days_under_observation; ?></td>
							<td><?php echo $i4_6_days_vendor_dependency; ?></td>
							<td><?php echo $i4_6_days_other_team+
							$i4_6_days_user_response+
							$i4_6_days_in_progress+
							$i4_6_days_under_observation+
							$i4_6_days_vendor_dependency; ?></td>
						</tr>
						<tr>
							<td>7-9 Days</td>
							<td><?php echo $i7_9_days_other_team; ?></td>
							<td><?php echo $i7_9_days_user_response; ?></td>
							<td><?php echo $i7_9_days_in_progress; ?></td>
							<td><?php echo $i7_9_days_under_observation; ?></td>
							<td><?php echo $i7_9_days_vendor_dependency; ?></td>
							<td><?php echo $i7_9_days_other_team+
							$i7_9_days_user_response+
							$i7_9_days_in_progress+
							$i7_9_days_under_observation+
							$i7_9_days_vendor_dependency; ?></td>
						</tr>
						<tr>
							<td>More than 9 days</td>
							<td><?php echo $more_than_9_days_other_team; ?></td>
							<td><?php echo $more_than_9_days_user_response; ?></td>
							<td><?php echo $more_than_9_days_in_progress; ?></td>
							<td><?php echo $more_than_9_days_under_observation; ?></td>  
							<td><?php echo $more_than_9_days_vendor_dependency; ?></td>
							<td><?php echo $more_than_9_days_other_team+
							$more_than_9_days_user_response+
							$more_than_9_days_in_progress+
							$more_than_9_days_under_observation+
							$more_than_9_days_vendor_dependency; ?></td>         
						</tr>
					</tbody>
					<tfoot>
						<tr>
							<th class="table-success">Grand Total</th>
							<th>
								<?php echo $i3_days_other_team+
								$i4_6_days_other_team+
								$i7_9_days_other_team+
								$more_than_9_days_other_team; ?>
							</th>
							<th>
								<?php echo $i3_days_user_response+
								$i4_6_days_user_response+
								$i7_9_days_user_response+
								$more_than_9_days_user_response; ?> 
							</th>
							<th>
								<?php echo $i3_days_in_progress+
								$i4_6_days_in_progress+
								$i7_9_days_in_progress+
								$more_than_9_days_in_progress; ?>
							</th>
							<th>
								<?php echo $i3_days_under_observation+
								$i4_6_days_under_observation+
								$i7_9_days_under_observation+
								$more_than_9_days_under_observation; ?>
							</th>
							<th>
								<?php echo $i3_days_vendor_dependency+
								$i4_6_days_vendor_dependency+
								$i7_9_days_vendor_dependency+
								$more_than_9_days_vendor_dependency; ?>
							</th>
							<th>
								<?php echo $i_backlog=$i3_days_other_team+
								$i4_6_days_other_team+
								$i7_9_days_other_team+
								$more_than_9_days_other_team+
								$i3_days_user_response+
								$i4_6_days_user_response+
								$i7_9_days_user_response+
								$more_than_9_days_user_response+
								$i3_days_in_progress+
								$i4_6_days_in_progress+
								$i7_9_days_in_progress+
								$more_than_9_days_in_progress+
								$i3_days_under_observation+
								$i4_6_days_under_observation+
								$i7_9_days_under_observation+
								$more_than_9_days_under_observation+
								$i3_days_vendor_dependency+
								$i4_6_days_vendor_dependency+
								$i7_9_days_vendor_dependency+
								$more_than_9_days_vendor_dependency; ?>
							</th>

						</tr>
					</tfoot>
					<?php
				}
				?>				
			</table>
		</div>
		<div class="col-lg-auto">	
			<canvas id="chart_incident_pivot" width="800" height="450"></canvas>
		</div>
	</div>
</div>
<div id="Sr_pivot" class="tabcontent">
	<h3>SR Pivot</h3>
	<div class="row">
		<div class="col-lg-auto"> <!-- Assignee,Closed,Resolved,Total -->
			<table class="table border">
				<thead>
					<tr class="table-success">
						<th>No of SRs</th>
						<th>Status</th>
					</tr>
					<tr>
						<th>Assignee</th>
						<th>Closed</th>
						<th>Resolved</th>
						<th>Total</th>
					</tr>
				</thead>
				<tbody>
					<?php
					if($sr_pivot_data){
						$sr_Total_Resolved=0;
						$sr_Total_Close=0;
						$sr_Total_sr=0;
						$sr_new_count=0;

						foreach ($sr_pivot_data as $row) 
						{   
							$sr_Total_Resolved = $sr_Total_Resolved + $row->Resolved;
							$sr_Total_Close = $sr_Total_Close + $row->Closed;
							$sr_Total_sr = $sr_Total_Resolved + $sr_Total_Close;
							$sr_new_count = $sr_new_count + $row->new_count;
							?> 	 
							<tr>
								<td><?php echo $row->assigned_to; ?></td>
								<td><?php echo $row->Closed; ?></td>
								<td><?php echo $row->Resolved; ?></td>
								<td><?php echo $row->Closed + $row->Resolved; ?></td>
							</tr>
							<?php
						}   
						?>   
					</tbody>
					<tfoot>
						<tr>
							<th class="table-success">Total</th>
							<th> <?php echo $sr_Total_Close; ?> </th>
							<th> <?php echo $sr_Total_Resolved; ?> </th>
							<th> <?php echo $sr_Total_sr; ?> </th>
						</tr>
					</tfoot>
					<?php
				}   
				?>
			</table>
		</div>
		<div class="col-lg-auto"> <!-- Row Labels,Average of MTTR -->
			<table class="table border">
				<thead>
					<tr class="table-success">
						<th>Row Labels</th>
						<th>Average of MTTR</th>
					</tr>
				</thead>
				<tbody>
					<?php
					if($sr_pivot_data != null){
						$s_Grand_Total= 0;
						$s_c=0;
						foreach ($sr_pivot_data as $row) 
						{  
							$s_c++;
							$s_Grand_Total = $s_Grand_Total + $row->Avg_mmtr;
							?> 	 
							<tr>
								<td><?php echo $row->assigned_to; ?></td>
								<td><?php echo round($row->Avg_mmtr,2); ?></td>       
							</tr>
							<?php
						}   
						?>   
					</tbody>
					<tfoot>
						<tr>
							<th class="table-success">Grand Total</th>
							<th ><?php echo round(($s_Grand_Total=$s_Grand_Total/$s_c),2); ?></th>
						</tr>
					</tfoot>
					<?php
				}
				?>
			</table>
		</div>
		<div class="col-lg-auto"> <!-- Consultant,Count of SR ID (In_Process, Pending)-->
			<table class="table border">
				<thead>
					<tr class="table-success">
						<th>Consultant</th>
						<th>Count of SR ID<br>(In Process, Pending)</th>
					</tr>
				</thead>
				<tbody>
					<?php
					if($sr_pivot_data != null){
						$s_sr_Count_Grand_Total= 0;
						foreach ($sr_pivot_data as $row) 
						{  
							$s_sr_Count_Grand_Total = $s_sr_Count_Grand_Total + $row->In_Process + $row->Pending;
							?> 	 
							<tr>
								<td><?php echo $row->assigned_to; ?></td>
								<td><?php echo $row->In_Process + $row->Pending; ?></td>       
							</tr>
							<?php
						}   
						?>   
					</tbody>
					<tfoot>
						<tr>
							<th class="table-success">Grand Total</th>
							<th ><?php echo round($s_sr_Count_Grand_Total,2); ?></th>
						</tr>
					</tfoot>
					<?php
				}
				?>
			</table>
		</div>
		<div class="col-lg-auto"> <!-- Consultant,Count of SR ID (Closed, Resolved) -->
			<table class="table border">
				<thead>
					<tr class="table-success">
						<th>Consultant</th>
						<th>Count of SR ID<br>(Closed, Resolved)</th>
					</tr>
				</thead>
				<tbody>
					<?php
					if($sr_pivot_data != null){
						$s_sr_Count_Grand_Total= 0;
						foreach ($sr_pivot_data as $row) 
						{  
							$s_sr_Count_Grand_Total = $s_sr_Count_Grand_Total + $row->Closed + $row->Resolved;
							?> 	 
							<tr>
								<td><?php echo $row->assigned_to; ?></td>
								<td><?php echo $row->Closed + $row->Resolved; ?></td>       
							</tr>
							<?php
						}   
						?>   
					</tbody>
					<tfoot>
						<tr>
							<th class="table-success">Grand Total</th>
							<th ><?php echo round($s_sr_Count_Grand_Total,2); ?></th>
						</tr>
					</tfoot>
					<?php
				}
				?>
			</table>
		</div>
		<div class="col-lg-auto"> <!-- Status,Open -->
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
					if($sr_pivot_data != null){
						$sr_open_Total = 0;
						foreach ($sr_pivot_data as $row) 
						{  
							$sr_open_Total = $sr_open_Total + $row->Pending + $row->In_Process;
						}   
						?>   
						<tr>
							<td><?php echo $sr_open_Total; ?></td>       
						</tr>
					</tbody>
					<?php
				}
				?>				
			</table>
		</div>
		<div class="col-lg-auto"><!-- Row Lables,Count of SR ID -->
			<table class="table border">
				<thead>
					<tr class="table-success">
						<th>Row Lables</th>
						<th>Count of SR ID </th>
					</tr>

				</thead>
				<tbody>
					<?php
					if($sr_pivot_data != null)
					{
						$sr_yes_Total = 0;
						$sr_no_Total = 0;
						$sr_total = 0;
						$sr_yes_no_Grand_Total = "100%";
						foreach ($sr_pivot_data as $row) 
						{  
							$sr_yes_Total = $sr_yes_Total + $row->resolution_violation_yes;
							$sr_no_Total = $sr_no_Total + $row->resolution_violation_no;
							$sr_total = $sr_yes_Total + $sr_no_Total;
						}   
						?>   
						<tr>
							<td>Yes</td>
							<td>
								<?php 
								$sr_yes_Total = $sr_yes_Total/$sr_total;
								echo round($sr_yes_Total*100,0)."%" ;
								?>
							</td>
						</tr>
						<tr>
							<td>No</td>   
							<td>
								<?php
								$sr_no_Total = $sr_no_Total/$sr_total;
								echo round($sr_no_Total*100,0)."%";
								?>	
							</td>    
						</tr>					
					</tbody>		
					<tfoot>
						<tr>
							<th class="table-success">Grand Total</th>
							<th><?php echo $sr_yes_no_Grand_Total; ?></th>
						</tr>
					</tfoot>
					<?php
				}
				?>			
			</table>
		</div>
		<div class="col-lg-auto"><!-- Status,Count -->
			<table class="table border">
				<thead>
					<tr class="table-success">
						<th>Status</th>
						<th>Count</th>
					</tr>

				</thead>
				<tbody>
					<?php
					if($sr_pivot_data != null)
					{
						$sr_pending_Total = 0;
						$sr_in_process_Total = 0;
						$sr_Grand_Total = 0;
						foreach ($sr_pivot_data as $row) 
						{  
							$sr_pending_Total = $sr_pending_Total + $row->Pending;
							$sr_in_process_Total = $sr_in_process_Total + $row->In_Process;
						}   
						?>   
						<tr>
							<td>In_Process</td>
							<td>
								<?php echo $sr_in_process_Total; ?>
							</td>
						</tr>
						<tr>
							<td>Pending</td>   
							<td>
								<?php echo $sr_pending_Total; ?>	
							</td>    
						</tr>					
					</tbody>		
					<tfoot>
						<tr>
							<th class="table-success">Grand Total</th>
							<th ><?php echo $sr_Grand_Total = $sr_in_process_Total + $sr_pending_Total; ?></th>
						</tr>
					</tfoot>
					<?php
				}
				?>			
			</table>
		</div>
		<div class="col-lg-auto"><!-- Category,SR Count (Pending And In-Progress) -->
			<table class="table border">
				<thead>
					<tr class="table-success">
						<th>Category</th>
						<th>SR Count</th>

					</tr>
				</thead>
				<tbody>
					<?php
					if($sr_pivot_data != null)
					{
						$EUC_master_data_count = 0;
						$EUC_minor_edi_map_change = 0;
						$EUC_new_connection = 0;
						$EUC_new_customer_setup = 0;
						$EUC_new_edi_map = 0;
						$EUC_new_vendor_setup = 0;
						$Others = 0;
						$sr_c_grand_Total = 0;
						foreach ($sr_pivot_data as $row) 
						{  
							$EUC_master_data_count = $EUC_master_data_count + $row->EUC_master_data_count;
							$EUC_minor_edi_map_change = $EUC_minor_edi_map_change + $row->EUC_minor_edi_map_change;
							$EUC_new_connection = $EUC_new_connection + $row->EUC_new_connection;
							$EUC_new_customer_setup = $EUC_new_customer_setup + $row->EUC_new_customer_setup;
							$EUC_new_edi_map = $EUC_new_edi_map + $row->EUC_new_edi_map;
							$EUC_new_vendor_setup = $EUC_new_vendor_setup + $row->EUC_new_vendor_setup;
							$Others = $Others + $row->Others;						
						}   
						?>   
						<tr>
							<td>EUC-Master Data</td>
							<td>
								<?php echo $EUC_master_data_count; ?>
							</td>
						</tr>
						<tr>
							<td>EUC-Minor EDI Map Change</td>
							<td>
								<?php echo $EUC_minor_edi_map_change; ?>
							</td>
						</tr>
						<tr>
							<td>EUC-New connection</td>
							<td>
								<?php echo $EUC_new_connection; ?>
							</td>
						</tr>
						<tr>
							<td>EUC-New customer setup</td>
							<td>
								<?php echo $EUC_new_customer_setup; ?>
							</td>
						</tr>
						<tr>
							<td>EUC-New EDI Map</td>
							<td>
								<?php echo $EUC_new_edi_map; ?>
							</td>
						</tr>
						<tr>
							<td>EUC-New vendor setup</td>
							<td>
								<?php echo $EUC_new_vendor_setup; ?>
							</td>
						</tr>
						<tr>
							<td>Others</td>
							<td>
								<?php echo $Others; ?>
							</td>
						</tr>			
					</tbody>		
					<tfoot>
						<tr>
							<th class="table-success">Grand Total</th>
							<th ><?php  echo $EUC_master_data_count+
							$EUC_minor_edi_map_change +
							$EUC_new_connection +
							$EUC_new_customer_setup +
							$EUC_new_edi_map +
							$EUC_new_vendor_setup +
							$Others; ?></th>
						</tr>
					</tfoot>
					<?php
				}
				?>			
			</table>
		</div>
		<div class="col-lg-12"><!-- Row Labels,User Response Awaited,Grand Total -->
			<table class="table border">
				<thead>
					<tr class="table-success">
						<th>SR#</th>
						<th>Pending</th>
					</tr>
					<tr class="table-success">
						<th>Bucket Age</th>
						<th>Other Team/Group Dependency</th>
						<th>User Response Awaited</th>
						<th>Vendor Dependency</th>
						<th>In Progress</th>
						<th>Scheduled Ticket</th>
						<th>Total</th>
					</tr>

				</thead>
				<tbody>
					<?php

					if($sr_pivot_data != null)
					{
						$sr_backlog = 0;

						$other_Team_15_50 = 0;
						$user_response_awaited_15_50 = 0;
						$vendor_dependency_15_50 = 0;
						$in_progress_15_50 = 0;
						$scheduled_ticket_15_50 = 0;
						$other_Team_51_70 = 0;
						$user_response_awaited_51_70 = 0;
						$vendor_dependency_51_70 = 0;
						$in_progress_51_70 = 0;
						$scheduled_ticket_51_70 = 0;
						$other_Team_71_90 = 0;
						$user_response_awaited_71_90 = 0;
						$vendor_dependency_71_90 = 0;
						$in_progress_71_90 = 0;
						$scheduled_ticket_71_90 = 0;
						$other_Team_90 = 0;
						$user_response_awaited_90 = 0;
						$vendor_dependency_90 = 0;
						$in_progress_90 = 0;
						$scheduled_ticket_90 = 0;

						foreach ($sr_pivot_data as $row) 
						{  
							$other_Team_15_50 = $other_Team_15_50 + $row->other_Team_15_50;
							$user_response_awaited_15_50 = $user_response_awaited_15_50 + $row->user_response_awaited_15_50;
							$vendor_dependency_15_50 = $vendor_dependency_15_50 + $row->vendor_dependency_15_50;
							$in_progress_15_50 = $in_progress_15_50 + $row->in_progress_15_50;
							$scheduled_ticket_15_50 = $scheduled_ticket_15_50 + $row->scheduled_ticket_15_50;

							$other_Team_51_70 = $other_Team_51_70 + $row->other_Team_51_70;
							$user_response_awaited_51_70 = $user_response_awaited_51_70 + $row->user_response_awaited_51_70;
							$vendor_dependency_51_70 = $vendor_dependency_51_70 + $row->vendor_dependency_51_70;
							$in_progress_51_70 = $in_progress_51_70 + $row->in_progress_51_70;
							$scheduled_ticket_51_70 = $scheduled_ticket_51_70 + $row->scheduled_ticket_51_70;

							$other_Team_71_90 = $other_Team_71_90 + $row->other_Team_71_90;
							$user_response_awaited_71_90 = $user_response_awaited_71_90 + $row->user_response_awaited_71_90;
							$vendor_dependency_71_90 = $vendor_dependency_71_90 + $row->vendor_dependency_71_90;
							$in_progress_71_90 = $in_progress_71_90 + $row->in_progress_71_90;
							$scheduled_ticket_71_90 = $scheduled_ticket_71_90 + $row->scheduled_ticket_71_90;

							$other_Team_90 = $other_Team_90 + $row->other_Team_90;
							$user_response_awaited_90 = $user_response_awaited_90 + $row->user_response_awaited_90;
							$vendor_dependency_90 = $vendor_dependency_90 + $row->vendor_dependency_90;
							$in_progress_90 = $in_progress_90 + $row->in_progress_90;
							$scheduled_ticket_90 = $scheduled_ticket_90 + $row->scheduled_ticket_90;
						}   
						?>   
						<tr>
							<td>15-50 days</td>
							<td><?php echo $other_Team_15_50;?></td>
							<td><?php echo $user_response_awaited_15_50;?></td>
							<td><?php echo $vendor_dependency_15_50;?></td>  
							<td><?php echo $in_progress_15_50;?></td>  
							<td><?php echo $scheduled_ticket_15_50;?></td>

							<td><?php echo $scheduled_ticket_15_50 
							+ $other_Team_15_50 
							+ $user_response_awaited_15_50 
							+ $vendor_dependency_15_50 
							+ $in_progress_15_50; ?></td>  

						</tr>
						<tr>
							<td>51-70 days</td>
							<td><?php echo $other_Team_51_70;?></td>
							<td><?php echo $user_response_awaited_51_70;?></td>
							<td><?php echo $vendor_dependency_51_70;?></td>  
							<td><?php echo $in_progress_51_70;?></td>  
							<td><?php echo $scheduled_ticket_51_70;?></td>

							<td><?php echo $scheduled_ticket_51_70 
							+ $other_Team_51_70 
							+ $user_response_awaited_51_70 
							+ $vendor_dependency_51_70 
							+ $in_progress_51_70; ?></td>  

						</tr>
						<tr>
							<td>71-90 days</td>
							<td><?php echo $other_Team_71_90;?></td>
							<td><?php echo $user_response_awaited_71_90;?></td>
							<td><?php echo $vendor_dependency_71_90;?></td>  
							<td><?php echo $in_progress_71_90;?></td>  
							<td><?php echo $scheduled_ticket_71_90;?></td>

							<td><?php echo $scheduled_ticket_71_90 
							+ $other_Team_71_90 
							+ $user_response_awaited_71_90 
							+ $vendor_dependency_71_90 
							+ $in_progress_71_90; ?></td>       
						</tr>
						<tr>
							<td>more than 90 days</td>
							<td><?php echo $other_Team_90;?></td>
							<td><?php echo $user_response_awaited_90;?></td>
							<td><?php echo $vendor_dependency_90;?></td>  
							<td><?php echo $in_progress_90;?></td>  
							<td><?php echo $scheduled_ticket_90;?></td>

							<td><?php echo $scheduled_ticket_90 
							+ $other_Team_90 
							+ $user_response_awaited_90 
							+ $vendor_dependency_90 
							+ $in_progress_90; ?></td>      
						</tr>
					</tbody>
					<tfoot>
						<tr>
							<th class="table-success">Total</th>
							<th>
								<?php 
								echo $other_Team_15_50 
								+ $other_Team_51_70
								+ $other_Team_71_90
								+ $other_Team_90 ;
								?>
							</th>
							<th>
								<?php
								echo $user_response_awaited_15_50 
								+ $user_response_awaited_51_70
								+ $user_response_awaited_71_90
								+ $user_response_awaited_90 ;
								?>
							</th>
							<th>
								<?php 
								echo $vendor_dependency_15_50 
								+ $vendor_dependency_51_70
								+ $vendor_dependency_71_90
								+ $vendor_dependency_90 ;
								?>
							</th>
							<th>
								<?php 
								echo $in_progress_15_50 
								+ $in_progress_51_70
								+ $in_progress_71_90
								+ $in_progress_90 ;
								?>
							</th>
							<th>
								<?php 
								echo $scheduled_ticket_15_50 
								+ $scheduled_ticket_51_70
								+ $scheduled_ticket_71_90
								+ $scheduled_ticket_90 ;
								?>
							</th>
							<th>
								<?php 
								echo $sr_backlog = $scheduled_ticket_15_50 
								+ $other_Team_15_50 
								+ $user_response_awaited_15_50 
								+ $vendor_dependency_15_50 
								+ $in_progress_15_50
								+ $scheduled_ticket_51_70 
								+ $other_Team_51_70 
								+ $user_response_awaited_51_70 
								+ $vendor_dependency_51_70 
								+ $in_progress_51_70
								+ $scheduled_ticket_71_90 
								+ $other_Team_71_90 
								+ $user_response_awaited_71_90 
								+ $vendor_dependency_71_90 
								+ $in_progress_71_90
								+ $scheduled_ticket_90 
								+ $other_Team_90 
								+ $user_response_awaited_90 
								+ $vendor_dependency_90 
								+ $in_progress_90; 
								?>
							</th>						
						</tr>
					</tfoot>
					<?php
				}
				?>				
			</table>
		</div>
		<div class="col-lg-auto">
			<canvas id="chart_sr_pivot" width="700"></canvas>
		</div>
	</div>
</div>
<div id="Report" class="tabcontent">
<h3>Reports</h3>
	<div class="col-lg-auto"><!-- incidents Report Table -->
		<table class="table border">
			<thead>
				<tr class="table-success">
					<th class="center">Incidents</th>
					<th class="center"></th>
					<th class="center"></th>
					<th class="center"></th>
					<th class="center"></th>
					<th class="center"></th>
					<th class="center"></th>						
				</tr>
			</thead>
			<tbody>
				<?php
				if($insident_pivot_data != null)
				{
					$i_pending_Total = 0;
					$i_in_process_Total = 0;
					$i_Grand_Total = 0;
					$i_Workflow_Error_Total = 0;
					foreach ($insident_pivot_data as $row) 
					{  
						$i_pending_Total = $i_pending_Total + $row->Pending;
						$i_in_process_Total = $i_in_process_Total + $row->In_Process;
						$i_Workflow_Error_Total =$i_Workflow_Error_Total + $row->workflow_error_count;
					}   
					?>   
					<tr>
						<td><?php echo $i_New_incident; ?></td>							
						<td><?php echo $i_Total_R_C_Incident; ?> </td>
						<td><?php echo round($i_no_Total*100,0)."%"; ?></td>
						<td><?php echo round($i_avg_mmtr_Grand_Total,2); ?></td>
						<td><?php echo $open_Total; ?></td>
						<td><?php echo $i_backlog ?></td>
						<td><?php echo $i_Workflow_Error_Total; ?> </td>

					</tr>					
				</tbody>		
				<tfoot>
					<tr>
						<th class="table-success">New</th>
						<th class="table-success">Resolved</th>
						<th class="table-success">SLA</th>
						<th class="table-success">MTTR(days)</th>
						<th class="table-success">Open</th>
						<th class="table-success">Backlog</th>
						<th class="table-success">Workflow Errors</th>
					</tr>
				</tfoot>
				<?php
			}
			?>			
		</table>
	</div>

	<div class="col-lg-auto"><!-- SR Report Table -->
		<table class="table border">
			<thead>
				<tr class="table-success">
					<th class="center">Service Request</th>
					<th class="center"></th>
					<th class="center"></th>
					<th class="center"></th>
					<th class="center"></th>
					<th class="center"></th>				
				</tr>
			</thead>
			<tbody>
				<?php
				if($insident_pivot_data != null)
				{
					$i_pending_Total = 0;
					$i_in_process_Total = 0;
					$i_Grand_Total = 0;
					$i_Workflow_Error_Total = 0;
					foreach ($insident_pivot_data as $row) 
					{  
						$i_pending_Total = $i_pending_Total + $row->Pending;
						$i_in_process_Total = $i_in_process_Total + $row->In_Process;
						$i_Workflow_Error_Total =$i_Workflow_Error_Total + $row->workflow_error_count;
					}   
					?>   
					<tr>
						<td><?php echo $sr_new_count; ?></td>							
						<td><?php echo $sr_Total_sr; ?> </td>
						<td><?php echo round($sr_no_Total*100,0)."%"; ?></td>
						<td><?php echo round($s_Grand_Total,2); ?></td>
						<td><?php echo $sr_open_Total; ?></td>
						<td><?php echo $sr_backlog; ?></td>

					</tr>					
				</tbody>		
				<tfoot>
					<tr>
						<th class="table-success">New</th>
						<th class="table-success">Resolved</th>
						<th class="table-success">SLA</th>
						<th class="table-success">MTTR(days)</th>
						<th class="table-success">Open</th>
						<th class="table-success">Backlog</th>

					</tr>
				</tfoot>
				<?php
			}
			?>			
		</table>
	</div>
<div class="row col-lg-12">
		<div class="col-lg-6">
			<canvas id="chart_incident_report" width="700"></canvas>
		</div>
		<div class="col-lg-6">
			<canvas id="chart_sr_report" width="700"></canvas>
		</div>
</div>
</div>
<div id="Trend_data" class="tabcontent">
	<h3>Trend Data</h3>

	<div class="col-lg-auto"><!--Trend Data incidents Report Table -->
		<table id="table_with_data" class="table border">
			<thead>
				<tr class="table-success">
					<th class="center">Incidents</th>
					<th class="center"></th>
					<th class="center"></th>
					<th class="center"></th>
					<th class="center"></th>
					<th class="center"></th>
					<th class="center"></th>						
				</tr>
				<tr>
					<th class="table-success"></th>
					<th class="table-success">New Tkts</th>
					<th class="table-success">Resolved</th>
					<th class="table-success">SLA</th>
					<th class="table-success">MTTR</th>
					<th class="table-success">Open</th>
					<th class="table-success">Backlog</th>						
				</tr>
			</thead>
			<tbody>
				<?php
				if($trend_data != null)
				{
//	for ($i=1; $i < 2; $i++) { 
//print_r($trend_data[$i]);
					for($j=0;$j<=8;$j=$j+3)
					{
						// echo"<pre>";
						// print_r($trend_data[0][$j+2][0]);
						// echo"</pre>";
						?>   
						<tr>
							<td><?php echo $trend_data[0][$j];?></td>							
							<td><?php echo $trend_data[0][$j+2][0]->New_Count;?></td>
							<td><?php echo $trend_data[0][$j+2][0]->Resolved + $trend_data[0][$j+2][0]->Closed ; ?></td>
							<td><?php 
							if($trend_data[0][$j+2][0]->resolution_violation_no != 0 || $trend_data[0][$j+2][0]->resolution_violation_yes != 0)
							{
								$t_i_no_Total =
								$trend_data[0][$j+2][0]->resolution_violation_no
								/($trend_data[0][$j+2][0]->resolution_violation_no
									+$trend_data[0][$j+2][0]->resolution_violation_yes);
								echo round($t_i_no_Total*100,0)."%";}
								else
								{
									echo "0";
								} 
								?>									
							</td>
							<td><?php echo round($trend_data[0][$j+2][0]->Avg_mmtr,2); ?></td>
							<td><?php echo $trend_data[0][$j+2][0]->Pending + $trend_data[0][$j+2][0]->In_Process; ?></td>
							<td><?php echo 
							 $trend_data[0][$j+2][0]->i3_days_other_team
							+$trend_data[0][$j+2][0]->i3_days_user_response
							+$trend_data[0][$j+2][0]->i3_days_in_progress
							+$trend_data[0][$j+2][0]->i3_days_under_observation
							+$trend_data[0][$j+2][0]->i3_days_vendor_dependency
							+$trend_data[0][$j+2][0]->i4_6_days_other_team
							+$trend_data[0][$j+2][0]->i4_6_days_user_response
							+$trend_data[0][$j+2][0]->i4_6_days_in_progress
							+$trend_data[0][$j+2][0]->i4_6_days_under_observation
							+$trend_data[0][$j+2][0]->i4_6_days_vendor_dependency
							+$trend_data[0][$j+2][0]->i7_9_days_other_team
							+$trend_data[0][$j+2][0]->i7_9_days_user_response
							+$trend_data[0][$j+2][0]->i7_9_days_in_progress
							+$trend_data[0][$j+2][0]->i7_9_days_under_observation
							+$trend_data[0][$j+2][0]->i7_9_days_vendor_dependency
							+$trend_data[0][$j+2][0]->more_than_9_days_other_team
							+$trend_data[0][$j+2][0]->more_than_9_days_user_response
							+$trend_data[0][$j+2][0]->more_than_9_days_in_progress
							+$trend_data[0][$j+2][0]->more_than_9_days_under_observation
							+$trend_data[0][$j+2][0]->more_than_9_days_vendor_dependency;
							?>
						</td>
					</tr>					
				</tbody>		
				<?php
				//	}
			}
		}
		?>			
	</table>

	</div>
	<div class="col-lg-auto"><!--Trend Data SR Report Table -->
		<table class="table border">
			<thead>
				<tr class="table-success">
					<th class="center">Service Requests</th>
					<th class="center"></th>
					<th class="center"></th>
					<th class="center"></th>
					<th class="center"></th>
					<th class="center"></th>
					<th class="center"></th>						
				</tr>
				<tr>
					<th class="table-success"></th>
					<th class="table-success">New Tkts</th>
					<th class="table-success">Resolved</th>
					<th class="table-success">SLA</th>
					<th class="table-success">MTTR</th>
					<th class="table-success">Open</th>
					<th class="table-success">Backlog</th>						
				</tr>
			</thead>
			<tbody>
				<?php
				if($trend_data != null)
				{
//	for ($i=1; $i < 2; $i++) { 

//print_r($trend_data[$i]);

					for($j=0;$j<=8;$j=$j+3)
					{
						// echo"<pre>";
						// print_r($trend_data[1][$j+2][0]);
						// echo"</pre>";
						?>   
						<tr>
							<td><?php echo $trend_data[1][$j];?></td>							
							<td><?php echo $trend_data[1][$j+2][0]->new_count; ?></td>
							<td><?php echo $trend_data[1][$j+2][0]->Resolved + $trend_data[1][$j+2][0]->Closed; ?></td>
							<td><?php 
							if($trend_data[1][$j+2][0]->resolution_violation_no != 0 || $trend_data[1][$j+2][0]->resolution_violation_yes != 0)
							{
								$t_i_no_Total =
								$trend_data[1][$j+2][0]->resolution_violation_no
								/($trend_data[1][$j+2][0]->resolution_violation_no
									+$trend_data[1][$j+2][0]->resolution_violation_yes);
								echo round($t_i_no_Total*100,0)."%";}
								else
								{
									echo "0";
								} 
								?>									
							</td>
							<td><?php echo round($trend_data[1][$j+2][0]->Avg_mmtr,2); ?></td>
							<td><?php echo $trend_data[1][$j+2][0]->Pending + $trend_data[1][$j+2][0]->In_Process; ?></td>
							<td><?php echo
							$trend_data[1][$j+2][0]->user_response_awaited_15_50
							+$trend_data[1][$j+2][0]->vendor_dependency_15_50
							+$trend_data[1][$j+2][0]->in_progress_15_50
							+$trend_data[1][$j+2][0]->scheduled_ticket_15_50
							+$trend_data[1][$j+2][0]->other_Team_51_70
							+$trend_data[1][$j+2][0]->user_response_awaited_51_70
							+$trend_data[1][$j+2][0]->vendor_dependency_51_70
							+$trend_data[1][$j+2][0]->in_progress_51_70
							+$trend_data[1][$j+2][0]->scheduled_ticket_51_70
							+$trend_data[1][$j+2][0]->other_Team_71_90
							+$trend_data[1][$j+2][0]->user_response_awaited_71_90
							+$trend_data[1][$j+2][0]->vendor_dependency_71_90
							+$trend_data[1][$j+2][0]->in_progress_71_90
							+$trend_data[1][$j+2][0]->scheduled_ticket_71_90
							+$trend_data[1][$j+2][0]->other_Team_90
							+$trend_data[1][$j+2][0]->user_response_awaited_90
							+$trend_data[1][$j+2][0]->vendor_dependency_90
							+$trend_data[1][$j+2][0]->in_progress_90
							+$trend_data[1][$j+2][0]->scheduled_ticket_90
							+$trend_data[1][$j+2][0]->other_Team_15_50;
							?>
						</td>
					</tr>					
				</tbody>		

				<?php
//	}
			}
		}
		?>			
	</table>
</div>
	<div class="row col-lg-12">
		<div class="col-lg-6">
			<canvas id="td_incident_chart" width="700"></canvas>
		</div>
		<div class="col-lg-6">
			<canvas id="td_sr_chart" width="700"></canvas>
		</div>
	</div>
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

<script> //Trend data Charts (incident)
var td_in = document.getElementById('td_incident_chart').getContext("2d");
var myChart = new Chart(td_in, {
    type: 'line',
    data: {
        labels: ["New Tkts", "Resolved", "SLA", "MTTR", "Open", "Backlog"],
        datasets: [{
            label:'<?php echo $trend_data[0][0];?>',
            borderColor: "#FF0000",
            pointBorderColor: "	#FF0000",
            pointBackgroundColor: "	#FF0000",
            pointHoverBackgroundColor: "#80b6f4",
            pointHoverBorderColor: "#80b6f4",
            pointBorderWidth: 2,
            pointHoverRadius: 2,
            pointHoverBorderWidth: 1,
            pointRadius: 3,
            fill: false,
            borderWidth: 2,
            data: 
            [<?php echo $trend_data[0][0+2][0]->New_Count;?>,
             <?php echo $trend_data[0][0+2][0]->Resolved + $trend_data[0][0+2][0]->Closed;?>,
              <?php 
							if($trend_data[0][0+2][0]->resolution_violation_no != 0 || $trend_data[0][0+2][0]->resolution_violation_yes != 0)
							{
								$t_i_no_Total =
								$trend_data[0][0+2][0]->resolution_violation_no
								/($trend_data[0][0+2][0]->resolution_violation_no
									+$trend_data[0][0+2][0]->resolution_violation_yes);
								echo round($t_i_no_Total*100,0);}
								else
								{
									echo "0";
								} 
								?>,
								<?php echo round($trend_data[0][0+2][0]->Avg_mmtr,2); ?>,
								<?php echo $trend_data[0][0+2][0]->Pending + $trend_data[0][0+2][0]->In_Process; ?>,
								 <?php echo 
							 $trend_data[0][0+2][0]->i3_days_other_team
							+$trend_data[0][0+2][0]->i3_days_user_response
							+$trend_data[0][0+2][0]->i3_days_in_progress
							+$trend_data[0][0+2][0]->i3_days_under_observation
							+$trend_data[0][0+2][0]->i3_days_vendor_dependency
							+$trend_data[0][0+2][0]->i4_6_days_other_team
							+$trend_data[0][0+2][0]->i4_6_days_user_response
							+$trend_data[0][0+2][0]->i4_6_days_in_progress
							+$trend_data[0][0+2][0]->i4_6_days_under_observation
							+$trend_data[0][0+2][0]->i4_6_days_vendor_dependency
							+$trend_data[0][0+2][0]->i7_9_days_other_team
							+$trend_data[0][0+2][0]->i7_9_days_user_response
							+$trend_data[0][0+2][0]->i7_9_days_in_progress
							+$trend_data[0][0+2][0]->i7_9_days_under_observation
							+$trend_data[0][0+2][0]->i7_9_days_vendor_dependency
							+$trend_data[0][0+2][0]->more_than_9_days_other_team
							+$trend_data[0][0+2][0]->more_than_9_days_user_response
							+$trend_data[0][0+2][0]->more_than_9_days_in_progress
							+$trend_data[0][0+2][0]->more_than_9_days_under_observation
							+$trend_data[0][0+2][0]->more_than_9_days_vendor_dependency;
							?>]
        },{
            label:'<?php echo $trend_data[0][3];?>',
            borderColor: "#FFA500",
            pointBorderColor: "#FFA500",
            pointBackgroundColor: "#FFA500",
            pointHoverBackgroundColor: "#80b6f4",
            pointHoverBorderColor: "#80b6f4",
            pointBorderWidth: 2,
            pointHoverRadius: 2,
            pointHoverBorderWidth: 1,
            pointRadius: 3,
            fill: false,
            borderWidth: 2,
            data: 
            [<?php echo $trend_data[0][3+2][0]->New_Count;?>,
             <?php echo $trend_data[0][3+2][0]->Resolved + $trend_data[0][3+2][0]->Closed;?>,
              <?php 
							if($trend_data[0][3+2][0]->resolution_violation_no != 0 || $trend_data[0][3+2][0]->resolution_violation_yes != 0)
							{
								$t_i_no_Total =
								$trend_data[0][3+2][0]->resolution_violation_no
								/($trend_data[0][3+2][0]->resolution_violation_no
									+$trend_data[0][3+2][0]->resolution_violation_yes);
								echo round($t_i_no_Total*100,0);}
								else
								{
									echo "0";
								} 
								?>,
								<?php echo round($trend_data[0][3+2][0]->Avg_mmtr,2); ?>,
								<?php echo $trend_data[0][3+2][0]->Pending + $trend_data[0][3+2][0]->In_Process; ?>,
								 <?php echo 
							 $trend_data[0][3+2][0]->i3_days_other_team
							+$trend_data[0][3+2][0]->i3_days_user_response
							+$trend_data[0][3+2][0]->i3_days_in_progress
							+$trend_data[0][3+2][0]->i3_days_under_observation
							+$trend_data[0][3+2][0]->i3_days_vendor_dependency
							+$trend_data[0][3+2][0]->i4_6_days_other_team
							+$trend_data[0][3+2][0]->i4_6_days_user_response
							+$trend_data[0][3+2][0]->i4_6_days_in_progress
							+$trend_data[0][3+2][0]->i4_6_days_under_observation
							+$trend_data[0][3+2][0]->i4_6_days_vendor_dependency
							+$trend_data[0][3+2][0]->i7_9_days_other_team
							+$trend_data[0][3+2][0]->i7_9_days_user_response
							+$trend_data[0][3+2][0]->i7_9_days_in_progress
							+$trend_data[0][3+2][0]->i7_9_days_under_observation
							+$trend_data[0][3+2][0]->i7_9_days_vendor_dependency
							+$trend_data[0][3+2][0]->more_than_9_days_other_team
							+$trend_data[0][3+2][0]->more_than_9_days_user_response
							+$trend_data[0][3+2][0]->more_than_9_days_in_progress
							+$trend_data[0][3+2][0]->more_than_9_days_under_observation
							+$trend_data[0][3+2][0]->more_than_9_days_vendor_dependency;
							?>]
        },{
            label:'<?php echo $trend_data[0][6];?>',
            borderColor: "#80b6f4",
            pointBorderColor: "#80b6f4",
            pointBackgroundColor: "#80b6f4",
            pointHoverBackgroundColor: "#80b6f4",
            pointHoverBorderColor: "#80b6f4",
            pointBorderWidth: 2,
            pointHoverRadius: 2,
            pointHoverBorderWidth: 1,
            pointRadius: 3,
            fill: false,
            borderWidth: 2,
            data: 
            [<?php echo $trend_data[0][6+2][0]->New_Count;?>,
             <?php echo $trend_data[0][6+2][0]->Resolved + $trend_data[0][6+2][0]->Closed;?>,
              <?php 
							if($trend_data[0][6+2][0]->resolution_violation_no != 0 || $trend_data[0][6+2][0]->resolution_violation_yes != 0)
							{
								$t_i_no_Total =
								$trend_data[0][6+2][0]->resolution_violation_no
								/($trend_data[0][6+2][0]->resolution_violation_no
									+$trend_data[0][6+2][0]->resolution_violation_yes);
								echo round($t_i_no_Total*100,0);}
								else
								{
									echo "0";
								} 
								?>,
								<?php echo round($trend_data[0][6+2][0]->Avg_mmtr,2); ?>,
								<?php echo $trend_data[0][6+2][0]->Pending + $trend_data[0][6+2][0]->In_Process; ?>,
								 <?php echo 
							 $trend_data[0][6+2][0]->i3_days_other_team
							+$trend_data[0][6+2][0]->i3_days_user_response
							+$trend_data[0][6+2][0]->i3_days_in_progress
							+$trend_data[0][6+2][0]->i3_days_under_observation
							+$trend_data[0][6+2][0]->i3_days_vendor_dependency
							+$trend_data[0][6+2][0]->i4_6_days_other_team
							+$trend_data[0][6+2][0]->i4_6_days_user_response
							+$trend_data[0][6+2][0]->i4_6_days_in_progress
							+$trend_data[0][6+2][0]->i4_6_days_under_observation
							+$trend_data[0][6+2][0]->i4_6_days_vendor_dependency
							+$trend_data[0][6+2][0]->i7_9_days_other_team
							+$trend_data[0][6+2][0]->i7_9_days_user_response
							+$trend_data[0][6+2][0]->i7_9_days_in_progress
							+$trend_data[0][6+2][0]->i7_9_days_under_observation
							+$trend_data[0][6+2][0]->i7_9_days_vendor_dependency
							+$trend_data[0][6+2][0]->more_than_9_days_other_team
							+$trend_data[0][6+2][0]->more_than_9_days_user_response
							+$trend_data[0][6+2][0]->more_than_9_days_in_progress
							+$trend_data[0][6+2][0]->more_than_9_days_under_observation
							+$trend_data[0][6+2][0]->more_than_9_days_vendor_dependency;
							?>]
        }]
    },
    options: {
        legend: {
            position: "bottom"
        },
        scales: {
            yAxes: [{
                ticks: {
                    fontColor: "rgba(0,0,0,0.5)",
                    fontStyle: "bold",
                    beginAtZero: true,
                    maxTicksLimit: 5,
                    padding: 20
                },
                gridLines: {
                    drawTicks: false,
                    display: false
                }

            }],
            xAxes: [{
                gridLines: {
                    zeroLineColor: "transparent"
                },
                ticks: {
                    padding: 20,
                    fontColor: "rgba(0,0,0,0.5)",
                    fontStyle: "bold"
                }
            }]
        }
    }
});
</script> 
<script>
 //Trend data Charts (SR)
var td_sr = document.getElementById('td_sr_chart').getContext("2d");
var myChart = new Chart(td_sr, {
    type: 'line',
    data: {
        labels: ["New Tkts", "Resolved", "SLA", "MTTR", "Open", "Backlog"],
        datasets: [{
            label:'<?php echo $trend_data[1][0];?>',
            borderColor: "#FF0000",
            pointBorderColor: "	#FF0000",
            pointBackgroundColor: "	#FF0000",
            pointHoverBackgroundColor: "#80b6f4",
            pointHoverBorderColor: "#80b6f4",
            pointBorderWidth: 2,
            pointHoverRadius: 2,
            pointHoverBorderWidth: 1,
            pointRadius: 3,
            fill: false,
            borderWidth: 2,
          	data: 
            [<?php echo $trend_data[1][0+2][0]->new_count;?>,
             <?php echo $trend_data[1][0+2][0]->Resolved + $trend_data[1][0+2][0]->Closed;?>,
              <?php 
							if($trend_data[1][0+2][0]->resolution_violation_no != 0 || $trend_data[1][0+2][0]->resolution_violation_yes != 0)
							{
								$t_i_no_Total =
								$trend_data[1][0+2][0]->resolution_violation_no
								/($trend_data[1][0+2][0]->resolution_violation_no
									+$trend_data[1][0+2][0]->resolution_violation_yes);
								echo round($t_i_no_Total*100,0);}
								else
								{
									echo "0";
								} 
								?>,
								<?php echo round($trend_data[1][0+2][0]->Avg_mmtr,2); ?>,
								<?php echo $trend_data[1][0+2][0]->Pending + $trend_data[1][0+2][0]->In_Process; ?>,
								 <?php echo 
							 $trend_data[1][0+2][0]->user_response_awaited_15_50
							+$trend_data[1][0+2][0]->vendor_dependency_15_50
							+$trend_data[1][0+2][0]->in_progress_15_50
							+$trend_data[1][0+2][0]->scheduled_ticket_15_50
							+$trend_data[1][0+2][0]->other_Team_51_70
							+$trend_data[1][0+2][0]->user_response_awaited_51_70
							+$trend_data[1][0+2][0]->vendor_dependency_51_70
							+$trend_data[1][0+2][0]->in_progress_51_70
							+$trend_data[1][0+2][0]->scheduled_ticket_51_70
							+$trend_data[1][0+2][0]->other_Team_71_90
							+$trend_data[1][0+2][0]->user_response_awaited_71_90
							+$trend_data[1][0+2][0]->vendor_dependency_71_90
							+$trend_data[1][0+2][0]->in_progress_71_90
							+$trend_data[1][0+2][0]->scheduled_ticket_71_90
							+$trend_data[1][0+2][0]->other_Team_90
							+$trend_data[1][0+2][0]->user_response_awaited_90
							+$trend_data[1][0+2][0]->vendor_dependency_90
							+$trend_data[1][0+2][0]->in_progress_90
							+$trend_data[1][0+2][0]->scheduled_ticket_90
							+$trend_data[1][0+2][0]->other_Team_15_50;
							?>]
        },{
            label:'<?php echo $trend_data[1][3];?>',
            borderColor: "#FFA500",
            pointBorderColor: "#FFA500",
            pointBackgroundColor: "#FFA500",
            pointHoverBackgroundColor: "#80b6f4",
            pointHoverBorderColor: "#80b6f4",
            pointBorderWidth: 2,
            pointHoverRadius: 2,
            pointHoverBorderWidth: 1,
            pointRadius: 3,
            fill: false,
            borderWidth: 2,
            data: 
            [<?php echo $trend_data[1][3+2][0]->new_count;?>,
             <?php echo $trend_data[1][3+2][0]->Resolved + $trend_data[1][3+2][0]->Closed;?>,
              <?php 
							if($trend_data[1][3+2][0]->resolution_violation_no != 0 || $trend_data[1][3+2][0]->resolution_violation_yes != 0)
							{
								$t_i_no_Total =
								$trend_data[1][3+2][0]->resolution_violation_no
								/($trend_data[1][3+2][0]->resolution_violation_no
									+$trend_data[1][3+2][0]->resolution_violation_yes);
								echo round($t_i_no_Total*100,0);}
								else
								{
									echo "0";
								} 
								?>,
								<?php echo round($trend_data[1][3+2][0]->Avg_mmtr,2); ?>,
								<?php echo $trend_data[1][3+2][0]->Pending + $trend_data[1][3+2][0]->In_Process; ?>,
								 <?php echo 
							 $trend_data[1][3+2][0]->user_response_awaited_15_50
							+$trend_data[1][3+2][0]->vendor_dependency_15_50
							+$trend_data[1][3+2][0]->in_progress_15_50
							+$trend_data[1][3+2][0]->scheduled_ticket_15_50
							+$trend_data[1][3+2][0]->other_Team_51_70
							+$trend_data[1][3+2][0]->user_response_awaited_51_70
							+$trend_data[1][3+2][0]->vendor_dependency_51_70
							+$trend_data[1][3+2][0]->in_progress_51_70
							+$trend_data[1][3+2][0]->scheduled_ticket_51_70
							+$trend_data[1][3+2][0]->other_Team_71_90
							+$trend_data[1][3+2][0]->user_response_awaited_71_90
							+$trend_data[1][3+2][0]->vendor_dependency_71_90
							+$trend_data[1][3+2][0]->in_progress_71_90
							+$trend_data[1][3+2][0]->scheduled_ticket_71_90
							+$trend_data[1][3+2][0]->other_Team_90
							+$trend_data[1][3+2][0]->user_response_awaited_90
							+$trend_data[1][3+2][0]->vendor_dependency_90
							+$trend_data[1][3+2][0]->in_progress_90
							+$trend_data[1][3+2][0]->scheduled_ticket_90
							+$trend_data[1][3+2][0]->other_Team_15_50;
							?>]
        },{
            label:'<?php echo $trend_data[1][6];?>',
            borderColor: "#80b6f4",
            pointBorderColor: "#80b6f4",
            pointBackgroundColor: "#80b6f4",
            pointHoverBackgroundColor: "#80b6f4",
            pointHoverBorderColor: "#80b6f4",
            pointBorderWidth: 2,
            pointHoverRadius: 2,
            pointHoverBorderWidth: 1,
            pointRadius: 3,
            fill: false,
            borderWidth: 2,
            data: 
            [<?php echo $trend_data[1][6+2][0]->new_count;?>,
             <?php echo $trend_data[1][6+2][0]->Resolved + $trend_data[1][6+2][0]->Closed;?>,
              <?php 
							if($trend_data[1][6+2][0]->resolution_violation_no != 0 || $trend_data[1][6+2][0]->resolution_violation_yes != 0)
							{
								$t_i_no_Total =
								$trend_data[1][6+2][0]->resolution_violation_no
								/($trend_data[1][6+2][0]->resolution_violation_no
									+$trend_data[1][6+2][0]->resolution_violation_yes);
								echo round($t_i_no_Total*100,0);}
								else
								{
									echo "0";
								} 
								?>,
								<?php echo round($trend_data[1][6+2][0]->Avg_mmtr,2); ?>,
								<?php echo $trend_data[1][6+2][0]->Pending + $trend_data[1][6+2][0]->In_Process; ?>,
								 <?php echo 
							 $trend_data[1][6+2][0]->user_response_awaited_15_50
							+$trend_data[1][6+2][0]->vendor_dependency_15_50
							+$trend_data[1][6+2][0]->in_progress_15_50
							+$trend_data[1][6+2][0]->scheduled_ticket_15_50
							+$trend_data[1][6+2][0]->other_Team_51_70
							+$trend_data[1][6+2][0]->user_response_awaited_51_70
							+$trend_data[1][6+2][0]->vendor_dependency_51_70
							+$trend_data[1][6+2][0]->in_progress_51_70
							+$trend_data[1][6+2][0]->scheduled_ticket_51_70
							+$trend_data[1][6+2][0]->other_Team_71_90
							+$trend_data[1][6+2][0]->user_response_awaited_71_90
							+$trend_data[1][6+2][0]->vendor_dependency_71_90
							+$trend_data[1][6+2][0]->in_progress_71_90
							+$trend_data[1][6+2][0]->scheduled_ticket_71_90
							+$trend_data[1][6+2][0]->other_Team_90
							+$trend_data[1][6+2][0]->user_response_awaited_90
							+$trend_data[1][6+2][0]->vendor_dependency_90
							+$trend_data[1][6+2][0]->in_progress_90
							+$trend_data[1][6+2][0]->scheduled_ticket_90
							+$trend_data[1][6+2][0]->other_Team_15_50;
							?>]
        }]
    },
    options: {
        legend: {
            position: "bottom"
        },
        scales: {
            yAxes: [{
                ticks: {
                    fontColor: "rgba(0,0,0,0.5)",
                    fontStyle: "bold",
                    beginAtZero: true,
                    maxTicksLimit: 5,
                    padding: 20
                },
                gridLines: {
                    drawTicks: false,
                    display: false
                }

            }],
            xAxes: [{
                gridLines: {
                    zeroLineColor: "transparent"
                },
                ticks: {
                    padding: 20,
                    fontColor: "rgba(0,0,0,0.5)",
                    fontStyle: "bold"
                }
            }]
        }
    }
});
</script>

</html>