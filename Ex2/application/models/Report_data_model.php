<?php
class Report_data_model extends CI_Model
{
	public function __construct()
  {
    parent::__construct();
   // $this->load->model('Report_data_model');
    $this->load->library('excel');
  }

	public function get_Insident_Report_Data($formdata)
	{
		// $start = PHPExcel_Style_NumberFormat::toFormattedString($formdata['startdate'],"YYYY-M-D hh:mm:ss");
		// $end = PHPExcel_Style_NumberFormat::toFormattedString($formdata['enddate'],"YYYY-M-D hh:mm:ss");

		//print_r($formdata);
		//echo "<br/>";
		$start = date_create($formdata['start_date']);
		$start = date_format($start,"Y-m-d H:i:s");
		//echo "</br>";

		//echo $formdata['2'];
		$end = date_create($formdata['end_date']);
		$end = date_format($end,"Y-m-d H:i:s");
	    //exit();
			// $this->db->select('*');
			// $this->db->from('incident_list');
		 //    $this->db->where('logged_time >=', $start);	
			// $this->db->where('updated_time<=', $end);
			// $this->db->order_by('logged_time','asc');
			//  $query=$this->db->get();

			return $this->insident_data($start,$end);
	}

	public function get_Sr_Report_Data($formdata)
	{
		$start = date_create($formdata['start_date']);
		$start = date_format($start,"Y-m-d H:i:s");
		//echo "</br>";

		//echo $formdata['2'];
		$end = date_create($formdata['end_date']);
		$end = date_format($end,"Y-m-d H:i:s");
	    //exit();

	   return $this->sr_data($start,$end);
	}

	public function get_trend_data_rows()
	{
		$dates = array();
		$rowss = array();

	  $current_month = date_create()->format('Y-m-d H:i:s');

	  echo $current_month_first_day=date_create($current_month)
      ->modify('first day of this month')
      ->format("Y-m-d 00:00:00");

      $dates[] = $current_month_first_day;

      echo"</br>";
      
      echo $current_month_current_day=date_create($current_month)
      ->format("Y-m-d 24:00:00");	

      $dates[] = $current_month_current_day;

      echo"</br></br>";

      echo $second_month_first_day=date_create($current_month)
      ->modify('-1 months')
      ->modify('first day of this month')
      ->format("Y-m-d 00:00:00");

      $dates[] = $second_month_first_day;

      echo"</br>";

      echo $second_month_last_day=date_create($current_month)
      ->modify('-1 months')
      ->modify('last day of this month')
      ->format("Y-m-d 24:00:00");

      $dates[] = $second_month_last_day;

      echo"</br></br>";

      echo $third_month_first_day=date_create($current_month)
      ->modify('-2 months')
      ->modify('first day of this month')
      ->format("Y-m-d 00:00:00");

      $dates[] = $third_month_first_day;

      echo"</br>";
      			
      echo $third_month_last_day=date_create($current_month)
      ->modify('-2 months')
      ->modify('last day of this month')
      ->format("Y-m-d 24:00:00");

      $dates[] = $third_month_last_day;

      echo"</br>";	
      echo "<pre>";
      print_r($dates);
	  echo "</pre>";	
	  echo"</br>";			      

       for ($i=0; $i <=5 ; $i=$i+2)
       {       	
       	echo"</br>";
      	print_r($start = new DateTime($dates[$i]));
      	echo"</br>";
		echo $start = date_format($start,"Y-m-d 00:00:00");
		echo"</br>";
		print_r($end = new DateTime($dates[$i+1]));
		echo"</br>";
		echo $end = date_format($end,"Y-m-d 00:00:00");
		echo"</br>";
      	$rowss[] = $this->sr_data($start,$end);	      	      	
       }

        echo "<pre>";
      	print_r($rowss);
  		echo "</pre>";

    // // First day of a specific month
    // $d = new DateTime('2010-01-19');
    // $d->modify('first day of this month');
    // echo $d->format('jS, F Y')."</br>";

    // // alternatively...
    // echo date_create('2010-01-19')
    //   ->modify('first day of this month')
    //   ->format('jS, F Y');
		//exit();
	}

	public function insident_data($start,$end)
	{

		 $query = $this->db->query("SELECT assigned_to,status,
			 	AVG(mttr) AS Avg_mmtr,
			 	
			 	COUNT(case bucket_age when 'more than 9 days' AND (status='Pending' OR status='In-Progress') then 1 else null end) AS bucket_age,

			 	COUNT(case new when '1' then 1 else null end) AS New_Count,
			 	COUNT(case status when 'Pending' then 1 else null end) AS Pending,
			 	COUNT(case status when 'Closed' then 1 else null end) AS Closed,
			 	COUNT(case status when 'In-Progress' then 1 else null end) AS In_Process,
			 	COUNT(case status when 'Resolved' then 1 else null end) AS Resolved,
			 	COUNT(case resolution_violation when 'Yes'then 1 else null end) AS resolution_violation_yes,
			 	COUNT(case resolution_violation when 'No' then 1 else null end) AS resolution_violation_no,
			 	COUNT(case workflow_error when '1' then 1 else null end) AS workflow_error_count,
			 	COUNT(incident_id) As incident_count,
			 	

			 	-- 3 days pending reasons
			 	COUNT(case  when pending_reason ='Other Team/Group Dependency' AND bucket_age = '3 days' then 1 else null end) As i3_days_other_team,
			 	COUNT(case  when pending_reason ='User Response Awaited' AND bucket_age = '3 days' then 1 else null end) As i3_days_user_response,
			 	COUNT(case  when pending_reason ='In Progress' AND bucket_age ='3 days' then 1 else null end) AS i3_days_in_progress,
			 	COUNT(case  when pending_reason ='Under Observation' AND bucket_age = '3 days' then 1 else null end) As i3_days_under_observation,
			 	COUNT(case  when pending_reason ='Vendor Dependency' AND bucket_age = '3 days' then 1 else null end) As i3_days_vendor_dependency,

			 	-- 4-6 days pending reasons
			 	COUNT(case  when pending_reason ='Other Team/Group Dependency' AND bucket_age = '4-6 days' then 1 else null end) As i4_6_days_other_team,
			 	COUNT(case  when pending_reason ='User Response Awaited' AND bucket_age = '4-6 days' then 1 else null end) As i4_6_days_user_response,
			 	COUNT(case  when pending_reason ='In Progress' AND bucket_age ='4-6 days' then 1 else null end) AS i4_6_days_in_progress,
			 	COUNT(case  when pending_reason ='Under Observation' AND bucket_age = '4-6 days' then 1 else null end) As i4_6_days_under_observation,
			 	COUNT(case  when pending_reason ='Vendor Dependency' AND bucket_age = '4-6 days' then 1 else null end) As i4_6_days_vendor_dependency,


			 	-- 7-9 days pending reasons
			 	COUNT(case  when pending_reason ='Other Team/Group Dependency' AND bucket_age = '7-9 days' then 1 else null end) As i7_9_days_other_team,
			 	COUNT(case  when pending_reason ='User Response Awaited' AND bucket_age = '7-9 days' then 1 else null end) As i7_9_days_user_response,
			 	COUNT(case  when pending_reason ='In Progress' AND bucket_age ='4-6 days' then 1 else null end) AS i7_9_days_in_progress,
			 	COUNT(case  when pending_reason ='Under Observation' AND bucket_age = '7-9 days' then 1 else null end) As i7_9_days_under_observation,
			 	COUNT(case  when pending_reason ='Vendor Dependency' AND bucket_age = '7-9 days' then 1 else null end) As i7_9_days_vendor_dependency,
			 	

			 	-- more than 9 days pending reasons
			 	COUNT(case  when pending_reason ='Other Team/Group Dependency' AND bucket_age = 'more than 9 days' then 1 else null end) As more_than_9_days_other_team,
			 	COUNT(case  when pending_reason ='User Response Awaited' AND bucket_age = 'more than 9 days' then 1 else null end) As more_than_9_days_user_response,
			 	COUNT(case  when pending_reason ='In Progress' AND bucket_age ='more than 9 days' then 1 else null end) AS more_than_9_days_in_progress,
			 	COUNT(case  when pending_reason ='Under Observation' AND bucket_age = 'more than 9 days' then 1 else null end) As more_than_9_days_under_observation,
			 	COUNT(case  when pending_reason ='Vendor Dependency' AND bucket_age = 'more than 9 days' then 1 else null end) As more_than_9_days_vendor_dependency
			 	

			 	FROM `incident_list` WHERE logged_time >= '{$start}' AND updated_time <= '{$end}' GROUP BY `assigned_to` ASC;");

		  	// $query = $this->db->query(
  			// "SELECT FROM incident_list WHERE logged_time <= '{$start}' AND updated_time >= '{$end}'");
			return $result=$query->result();
			// echo "<pre>";
			// // foreach ($result as $row) {
			// // if($row->logged_time >= $start && $row->updated_time <= $end)
			// // {
			// 	// print_r($row->logged_time." ".$row->updated_time."<br/>");
			// // }	
			// // }
			// //print_r($result);
			// echo "</pre>";
			// exit();			

	}

	public function sr_data($start,$end)
	{
		 $query = $this->db->query("SELECT assigned_to,status,
	    	AVG(mttr) AS Avg_mmtr,
	    	COUNT(case status when 'Pending' then 1 else null end) AS Pending,
	    	COUNT(case status when 'Closed' then 1 else null end) AS Closed,
	    	COUNT(case status when 'In-Progress' then 1 else null end) AS In_Process,
	    	COUNT(case status when 'Resolved' then 1 else null end) AS Resolved,
	    	COUNT(case resolution_violation when 'Yes'then 1 else null end) AS resolution_violation_yes,
			COUNT(case resolution_violation when 'No' then 1 else null end) AS resolution_violation_no,
			COUNT(case new when '1' then 1 else null end) AS new_count,


			COUNT(case  when pending_reason ='Other Team/Group Dependency' AND bucket_age = '15-50 days' then 1 else null end) As other_Team_15_50,
			COUNT(case  when pending_reason ='User Response Awaited' AND bucket_age = '15-50 days' then 1 else null end) As user_response_awaited_15_50,
			COUNT(case  when pending_reason ='Vendor Dependency' AND bucket_age = '15-50 days' then 1 else null end) As vendor_dependency_15_50,
			COUNT(case  when pending_reason ='In Progress' AND bucket_age = '15-50 days' then 1 else null end) As in_progress_15_50,
			COUNT(case  when pending_reason ='Scheduled Ticket' AND bucket_age = '15-50 days' then 1 else null end) As scheduled_ticket_15_50,


			COUNT(case  when pending_reason ='Other Team/Group Dependency' AND bucket_age = '51-70 days' then 1 else null end) As other_Team_51_70,
			COUNT(case  when pending_reason ='User Response Awaited' AND bucket_age = '51-70 days' then 1 else null end) As user_response_awaited_51_70,
			COUNT(case  when pending_reason ='Vendor Dependency' AND bucket_age = '51-70 days' then 1 else null end) As vendor_dependency_51_70,
			COUNT(case  when pending_reason ='In Progress' AND bucket_age = '51-70 days' then 1 else null end) As in_progress_51_70,
			COUNT(case  when pending_reason ='Scheduled Ticket' AND bucket_age = '51-70 days' then 1 else null end) As scheduled_ticket_51_70,


			COUNT(case  when pending_reason ='Other Team/Group Dependency' AND bucket_age = '71-90 days' then 1 else null end) As other_Team_71_90,
			COUNT(case  when pending_reason ='User Response Awaited' AND bucket_age = '71-90 days' then 1 else null end) As user_response_awaited_71_90,
			COUNT(case  when pending_reason ='Vendor Dependency' AND bucket_age = '71-90 days' then 1 else null end) As vendor_dependency_71_90,
			COUNT(case  when pending_reason ='In Progress' AND bucket_age = '71-90 days' then 1 else null end) As in_progress_71_90,
			COUNT(case  when pending_reason ='Scheduled Ticket' AND bucket_age = '71-90 days' then 1 else null end) As scheduled_ticket_71_90,


			COUNT(case  when pending_reason ='Other Team/Group Dependency' AND bucket_age = 'more than 90 days' then 1 else null end) As other_Team_90,
			COUNT(case  when pending_reason ='User Response Awaited' AND bucket_age = 'more than 90 days' then 1 else null end) As user_response_awaited_90,
			COUNT(case  when pending_reason ='Vendor Dependency' AND bucket_age = 'more than 90 days' then 1 else null end) As vendor_dependency_90,
			COUNT(case  when pending_reason ='In Progress' AND bucket_age = 'more than 90 days' then 1 else null end) As in_progress_90,
			COUNT(case  when pending_reason ='Scheduled Ticket' AND bucket_age = 'more than 90 days' then 1 else null end) As scheduled_ticket_90,

			-- count(case when priority ='EUC-Master Data' AND status='Pending' then 1 else null end) AS A,
			-- count(case when priority ='EUC-Master Data' AND status='In-Progress' then 1 else null end) B,
			-- (count(case when priority ='EUC-Master Data' AND status='Pending' then 1 else null end)) + (count(case when priority ='EUC-Master Data' AND status='In-Progress' then 1 else null end)) AS EUC_master_data_count,
			
			COUNT(case when priority ='EUC-Master Data' AND (status='Pending' OR status='In-Progress') then 1 else null end) AS EUC_master_data_count,
			COUNT(case when priority ='EUC-Minor EDI Map Change' AND (status='Pending' OR status='In-Progress') then 1 else null end) AS EUC_minor_edi_map_change,
			COUNT(case when priority ='EUC-New connection' AND (status='Pending' OR status='In-Progress') then 1 else null end) AS EUC_new_connection,
			COUNT(case when priority ='EUC-New customer setup' AND (status='Pending' OR status='In-Progress') then 1 else null end) AS EUC_new_customer_setup,
			COUNT(case when priority ='EUC-New EDI Map' AND (status='Pending' OR status='In-Progress') then 1 else null end) AS EUC_new_edi_map,
			COUNT(case when priority ='EUC-New vendor setup' AND (status='Pending' OR status='In-Progress') then 1 else null end) AS EUC_new_vendor_setup,
			COUNT(case when priority ='S4' AND (status='Pending' OR status='In-Progress') then 1 else null end) AS Others,		
	    	COUNT(sr_id) As sr_count 
	    	FROM `sr_list` WHERE log_time >= '{$start}' AND updated_time <= '{$end}' GROUP BY `assigned_to` ASC;");
			
			return $result=$query->result();
	}
	
}