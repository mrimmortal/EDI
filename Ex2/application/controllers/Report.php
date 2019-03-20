<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Report extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('Report_data_model');
   // $this->load->library('excel');
  }

  //Load Report_Filter View
  function index()
  {
    // $data['table_data'] = $this->excel_import_model->select();
    // // echo $data->num_rows();
    // // exit();
    $data['formdata']="Empty";
    $this->load->view('report_filter',$data);
  }

  public function genrate_Report()
  {
    $formdata=$this->input->post(); 
    $data['insident_pivot_data']=$this->Report_data_model->get_Insident_Report_Data($formdata);
    $data['sr_pivot_data']=$this->Report_data_model->get_Sr_Report_Data($formdata);
    $this->load->view('report_filter',$data);
  }
}
?>