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

	if($sr_pivot_data != null)
	{
		print_r($sr_pivot_data);
	}

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
		<div class="col-lg-6"> <!-- Assignee,Resolved,Closed,Total -->
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
					if($insident_pivot_data){
						$i_Total_Resolved=0;
						$i_Total_Close=0;
						$i_Total_Incident=0;

						foreach ($insident_pivot_data as $row) 
						{   
							$i_Total_Resolved = $i_Total_Resolved + $row->Resolved;
							$i_Total_Close = $i_Total_Close + $row->Closed;
							$i_Total_Incident = $i_Total_Incident + $row->incident_count;
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
							<th> <?php echo $i_Total_Incident; ?> </th>
						</tr>
					</tfoot>
					<?php
				}   
				?>
			</table>
		</div>
		<div class="col-lg-6"> <!-- Row Labels,Average of MTTR -->
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
						foreach ($insident_pivot_data as $row) 
						{  
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
							<th ><?php echo round($i_avg_mmtr_Grand_Total,2); ?></th>
						</tr>
					</tfoot>
					<?php
				}
				?>
			</table>
		</div>
		<div class="col-lg-6"> <!-- Status,Open -->
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
		<div class="col-lg-6"><!-- Status,Count -->
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
		<div class="col-lg-6"><!-- Row Labels,User Response Awaited,Grand Total -->
			<table class="table border">
				<thead>
					<tr class="table-success">
						<th>Count of Incident ID</th>
						<th>Column Labels</th>
					</tr>
					<tr class="table-success">
						<th>Row Labels</th>
						<th>User Response Awaited</th>
						<th>Grand Total</th>
					</tr>

				</thead>
				<tbody>
					<?php
					if($insident_pivot_data != null){
						$i_User_Responce_Waiting_count = 0;
						foreach ($insident_pivot_data as $row) 
						{  
							$i_User_Responce_Waiting_count = $i_User_Responce_Waiting_count + $row->User_Responce_Waiting;
						}   
						?>   
						<tr>
							<td>More than 9 days</td>
							<td><?php echo $i_User_Responce_Waiting_count;?></td>
							<td><?php echo $i_User_Responce_Waiting_count;?></td>       
						</tr>
					</tbody>
					<tfoot>
						<tr>
							<th class="table-success">Grand Total</th>
							<th>
								<?php echo $i_User_Responce_Waiting_count; ?>
							</th>
							<th>
								<?php echo $i_User_Responce_Waiting_count; ?>
							</th>
						</tr>
					</tfoot>
					<?php
				}
				?>				
			</table>
		</div>
		<div class="col-lg-6"><!-- Row Lables,Count of Incident ID -->
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
							$incident_total = $incident_total + $row->incident_count;
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
		<div class="col-lg-6">	
			<canvas id="bar-chart" width="800" height="450"></canvas>
		</div>
	</div>
</div>	

<div id="Sr_pivot" class="tabcontent">
	<div class="row">
		<div class="col-lg-6"> <!-- Assignee,Closed,Resolved,Total -->
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

						foreach ($sr_pivot_data as $row) 
						{   
							$sr_Total_Resolved = $sr_Total_Resolved + $row->Resolved;
							$sr_Total_Close = $sr_Total_Close + $row->Closed;
							$sr_Total_sr = $sr_Total_sr + $row->sr_count;
							?> 	 
							<tr>
								<td><?php echo $row->assigned_to; ?></td>
								<td><?php echo $row->Closed; ?></td>
								<td><?php echo $row->Resolved; ?></td>
								<td><?php echo $row->sr_count; ?></td>
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
		<div class="col-lg-6"> <!-- Row Labels,Average of MTTR -->
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
						foreach ($sr_pivot_data as $row) 
						{  
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
							<th ><?php echo round($s_Grand_Total,2); ?></th>
						</tr>
					</tfoot>
					<?php
				}
				?>
			</table>
		</div>
		<div class="col-lg-6"> <!-- Consultant,Count of SR ID (In_Process, Pending)-->
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
		<div class="col-lg-6"> <!-- Consultant,Count of SR ID (Closed, Resolved) -->
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
		<div class="col-lg-6"> <!-- Status,Open -->
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
		<div class="col-lg-6"><!-- Row Lables,Count of SR ID -->
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
							$sr_total = $sr_total + $row->sr_count;
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
		<div class="col-lg-6"><!-- Status,Count -->
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
		<div class="col-lg-6">

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
								<?php echo $other_Team_15_50 
								+ $other_Team_51_70
								+ $other_Team_71_90
								+ $other_Team_90 ;?>
							</th>
							<th>
								<?php echo $user_response_awaited_15_50 
								+ $user_response_awaited_51_70
								+ $user_response_awaited_71_90
								+ $user_response_awaited_90 ;?>
							</th>
							<th>
								<?php echo $vendor_dependency_15_50 
								+ $vendor_dependency_51_70
								+ $vendor_dependency_71_90
								+ $vendor_dependency_90 ;?>
							</th>
							<th>
								<?php echo $in_progress_15_50 
								+ $in_progress_51_70
								+ $in_progress_71_90
								+ $in_progress_90 ;?>
							</th>
							<th>
								<?php echo $scheduled_ticket_15_50 
								+ $scheduled_ticket_51_70
								+ $scheduled_ticket_71_90
								+ $scheduled_ticket_90 ;?>
							</th>
							<th>
								<?php echo $scheduled_ticket_15_50 
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
								+ $in_progress_90; ?>
							</th>						
						</tr>
					</tfoot>
					<?php
				}
				?>				
			</table>
		</div>
		<div class="col-lg-12">
			<canvas id="ctx" width="700"></canvas>

		</div>

	</div>
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
			tablinks[i].className = tablinks[i].className.replace("active", "");
		}
		document.getElementById(cityName).style.display = "block";
		evt.currentTarget.className += " active";
	}
//Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").click();
</script>

<script>
	new Chart(document.getElementById("bar-chart"), {
		type: 'bar',
		data: {
			labels: ["More than 9 days"],
			datasets: [
			{
				label: "User Response Awaited",
				backgroundColor: ["#3e95cd"],
				data: [<?php echo $i_User_Responce_Waiting_count;?>]
			}
			]
		},
		options: {
			legend: { display: true },
			title: {
				display: true,
				text: 'User Response Awaited'
			}
		}
	});
</script>

<script>
	var chart = new Chart(ctx, {
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
</html>