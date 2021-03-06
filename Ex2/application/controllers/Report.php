<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Report extends CI_Controller
{
  var $pdf_view_data;
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
    $data['insident_pivot_data']= null;
    $data['sr_pivot_data'] = null;
    $data['start_date'] = null;
    $data['trend_data']= null;
    $data['end_date'] = null;
    $this->load->view('report_filter',$data);
  }

  public function genrate_Report()
  {
    $formdata=$this->input->post();
    // print_r($formdata);
    //  exit();
    $data['start_date'] = $formdata['start_date'];
    $data['end_date'] = $formdata['end_date'];
    $data['insident_pivot_data']=$this->Report_data_model->get_Insident_Report_Data($formdata);
    $data['sr_pivot_data']=$this->Report_data_model->get_Sr_Report_Data($formdata);
    $data['trend_data']=$this->Report_data_model->get_trend_data_rows();
    $this->load->view('report_filter',$data);
  
  }

}
?>