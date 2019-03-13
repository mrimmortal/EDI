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

		print_r($formdata);
		$start = date_create($formdata['daterangestart']);
		echo date_format($start,"Y/m/d H:i:s");
		echo "</br>";
		// echo $formdata['daterangeend'];
		// $end = date_create($formdata['daterangeend']);
		// echo date_format($end,"Y/m/d H:i:s");
	exit();

		// exit();

			$this->db->select('*');
			$this->db->from('incident_list');
			// $this->db->where('logged_time >=', $formdata['startdate']);	
			// $this->db->where('updated_time <=', $formdata['enddate']);
			$query=$this->db->get();
		  	// $query = $this->db->query(
  			// "SELECT FROM incident_list WHERE logged_time <= '{$start}' AND updated_time >= '{$end}'");
			$result=$query->result();
			echo "<pre>";
			foreach ($result as $row) {
			if($row->logged_time >= $formdata['startdate'] && $row->updated_time <= $formdata['enddate'] )
			{
				print_r($row);
			}	
			}
			//print_r($result);
			echo "</pre>";
			exit();
			
	}
}