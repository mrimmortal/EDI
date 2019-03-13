<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Excel_import extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->helper('url');
	}

	public function index() {
		$data['num_rows'] = $this->db->get('incident_list')->num_rows();
		$this->load->view('excel_import', $data);

	}

	public function import_data() {
		$config = array(
			'upload_path'   => FCPATH.'upload/',
			'allowed_types' => 'xls|xlsx'
		);
		
		$this->load->library('upload', $config);
		if ($this->upload->do_upload('file')) {
			$data = $this->upload->data();
			@chmod($data['full_path'], 0777);

			$this->load->library('Spreadsheet_Excel_Reader');
			$this->spreadsheet_excel_reader->setOutputEncoding('CP1251');

			$this->spreadsheet_excel_reader->read($data['full_path']);
			$sheets = $this->spreadsheet_excel_reader->sheets[0];

			 echo ("<pre>");
			 	print_r($sheets);
			 echo ("</pre>");
			 exit();
		
			error_reporting(0);
			$data_excel = array();

			for ($i = 2; $i <= $sheets['numRows']; $i++)
			{

				if ($sheets['cells'][$i][1] == '') break;
				$data_excel[$i - 1]['incident_id']    = $sheets['cells'][$i][1];
				$data_excel[$i - 1]['logged_time']   = date("Y-m-d H:i", strtotime($sheets['cells'][$i][2]));
				$data_excel[$i - 1]['status'] = $sheets['cells'][$i][3];
				$data_excel[$i - 1]['caller'] = $sheets['cells'][$i][4];
				$data_excel[$i - 1]['remaining_sla_time'] = $sheets['cells'][$i][5];
				$data_excel[$i - 1]['workgroup'] = $sheets['cells'][$i][6];
				$data_excel[$i - 1]['assigned_to'] = $sheets['cells'][$i][7];
				$data_excel[$i - 1]['updated_time'] = date("Y-m-d H:i", strtotime($sheets['cells'][$i][8]));
				$data_excel[$i - 1]['priority'] = $sheets['cells'][$i][9];
				$data_excel[$i - 1]['Symptom'] = $sheets['cells'][$i][10];
				$data_excel[$i - 1]['pending_reason'] = $sheets['cells'][$i][11];
				$data_excel[$i - 1]['resolution_deadline'] = date("Y-m-d H:i", strtotime($sheets['cells'][$i][12]));
				$data_excel[$i - 1]['resolution_violation'] = $sheets['cells'][$i][13];
				$data_excel[$i - 1]['sla'] = $sheets['cells'][$i][14];
				$data_excel[$i - 1]['mttr'] = $sheets['cells'][$i][15];
				$data_excel[$i - 1]['new'] = $sheets['cells'][$i][16];
				$data_excel[$i - 1]['workflow_error'] = $sheets['cells'][$i][17];
				$data_excel[$i - 1]['age_old'] = $sheets['cells'][$i][18];
				$data_excel[$i - 1]['bucket_age'] = $sheets['cells'][$i][19];
			}

			 // echo ("<pre>");
			 // 	print_r($data_excel);
			 // echo ("</pre>");
			 // exit();

			$this->db->insert_batch('incident_list', $data_excel);
			// @unlink($data['full_path']);
			redirect('excel-import');
		}
	}
}

/* End of file Excel_import.php */
/* Location: ./application/controllers/Excel_import.php */