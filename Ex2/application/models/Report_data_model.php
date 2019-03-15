<?php
class Report_data_model extends CI_Model
{
	public function __construct()
  {
    parent::__construct();
   // $this->load->model('Report_data_model');
    $this->load->library('excel');
  }
	public function get_Report_Data($formdata)
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

			 $query = $this->db->query("SELECT assigned_to,status,AVG(mttr),COUNT(status) FROM `incident_list` WHERE logged_time >= '{$start}' AND updated_time <= '{$end}' GROUP BY `assigned_to` ASC;");

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
	
}