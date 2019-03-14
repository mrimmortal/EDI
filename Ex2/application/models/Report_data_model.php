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
		echo "<br/>";
		$start = $this->c($formdata['1']);
		$start = date_format($start,"Y-m-d H:i:s");
		echo "</br>";

		//echo $formdata['2'];
		$end = $this->c($formdata['2']);
		$end = date_format($end,"Y-m-d H:i:s");
	    //exit();

		// exit();

			$this->db->select('*');
			$this->db->from('incident_list');
			//  $this->db->where('logged_time >=', $start);	
			//  $this->db->where('dbplus_update(relation, old, new)d_time <=', $end);
			 $query=$this->db->get();
		  	// $query = $this->db->query(
  			// "SELECT FROM incident_list WHERE logged_time <= '{$start}' AND updated_time >= '{$end}'");
			$result=$query->result();
			echo "<pre>";
			foreach ($result as $row) {
			if($row->logged_time >= $start && $row->updated_time <= $end)
			{
				print_r($row->logged_time."<br/>".$row->updated_time."<br/>");
			}	
			}
			//print_r($result);
			echo "</pre>";
			exit();
			
	}
	public function c($a)
	{
		return date_create($a);
	}
}