<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Excel_import extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('excel_import_model');
    $this->load->library('excel');
  }

  function index()
  {
    $data['table_data'] = $this->excel_import_model->select();
    // echo $data->num_rows();
    // exit();
    $this->load->view('excel_import2',$data);
  }

  function fetch()
  {
    $data = $this->excel_import_model->select();
    $output = '
    <h3 align="center">Total Data - '.$data->num_rows().'</h3>
    <table class="table table-striped table-bordered">
    <tr>
    <th>Customer Name</th>
    <th>Address</th>
    <th>City</th>
    <th>Postal Code</th>
    <th>Country</th>
    </tr>
    ';
    foreach($data->result() as $row)
    {
      $output .= '
      <tr>
      <td>'.$row->CustomerName.'</td>
      <td>'.$row->Address.'</td>
      <td>'.$row->City.'</td>
      <td>'.$row->PostalCode.'</td>
      <td>'.$row->Country.'</td>
      </tr>
      ';
    }
    $output .= '</table>';
    echo $output;
  }

  function import()
  {
    if(isset($_FILES["file"]["name"]))
    {
      $path = $_FILES["file"]["tmp_name"];
      $object = PHPExcel_IOFactory::load($path);

      foreach($object->getWorksheetIterator() as $worksheet)
      {
        $sheetNo=$object->getIndex($worksheet);
// print_r($sheetNo);
// exit();
        if($sheetNo==0)
        {
          $data=$this->incidentList($worksheet);
          $this->excel_import_model->db_incident_List_Insert($data);
          echo 'Data Imported successfully into incident_list table';   
        }
        else
        {
          $data=$this->srList($worksheet);
          $this->excel_import_model->db_sr_List_Insert($data);
          echo 'Data Imported successfully into sr_list table';
        }
      }
// echo ("<pre>");
//     print_r($data);
//   echo ("</pre>");
//   exit();
    } 
  }

  public function incidentList($worksheet)
  {
    $highestRow = $worksheet->getHighestRow();
    $highestColumn = $worksheet->getHighestColumn();
    for($row=2; $row<=$highestRow; $row++)
    {
      $incident_id = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
      $logged_time = PHPExcel_Style_NumberFormat::toFormattedString($worksheet->getCellByColumnAndRow(1, $row)->getValue(),"YYYY-M-D hh:mm:ss");
      $status = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
      $caller = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
      $remaining_sla_time = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
      $workgroup = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
      $assigned_to = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
      $updated_time = PHPExcel_Style_NumberFormat::toFormattedString($worksheet->getCellByColumnAndRow(7, $row)->getValue(),"YYYY-M-D hh:mm:ss");
      $priority = $worksheet->getCellByColumnAndRow(8, $row)->getValue();
      $symptom = $worksheet->getCellByColumnAndRow(9, $row)->getValue();
      $pending_reason = $worksheet->getCellByColumnAndRow(10, $row)->getValue();
      $resolution_deadline = PHPExcel_Style_NumberFormat::toFormattedString($worksheet->getCellByColumnAndRow(11, $row)->getValue(),"YYYY-M-D hh:mm:ss");
      $resolution_violation = $worksheet->getCellByColumnAndRow(12, $row)->getValue();
      $sla = $worksheet->getCellByColumnAndRow(13, $row)->getValue();
// $mttr = $worksheet->getCellByColumnAndRow(14, $row)->getValue();
//$new = $worksheet->getCellByColumnAndRow(15, $row)->getValue();
      $workflow_error = $worksheet->getCellByColumnAndRow(16, $row)->getValue();
//$age_old = $worksheet->getCellByColumnAndRow(17, $row)->getValue();
// $bucket_age = $worksheet->getCellByColumnAndRow(18, $row)->getValue();
      $data[] = array(
        'incident_id'  => $incident_id,
        'logged_time'   =>$logged_time,
        'status'    => $status,
        'caller'  => $caller,
        'remaining_sla_time'   => $remaining_sla_time,
        'workgroup' =>$workgroup,
        'assigned_to' =>$assigned_to,
        'updated_time' =>$updated_time,
        'priority' =>$priority,
        'symptom' =>$symptom,
        'pending_reason' =>$pending_reason,
        'resolution_deadline' =>$resolution_deadline,
        'resolution_violation' =>$resolution_violation,
        'sla' =>$sla,
        'mttr' =>$this->cal_mttr($updated_time,$logged_time),
        'new' =>$this->cal_new($logged_time),
        'workflow_error' => $this->cal_workflow_error_incident_list($sla),//$workflow_error,
        'age_old' =>$this->cal_age_old($logged_time),
        'bucket_age' =>$this->cal_bucket_age_incident_list($this->cal_age_old($logged_time))
      );
    }
// echo ("<pre>");
// print_r($data);
// echo ("</pre>");
// exit();
    return $data;
  }

  public function srList($worksheet)
  {
    $highestRow = $worksheet->getHighestRow();
    $highestColumn = $worksheet->getHighestColumn();
    for($row=2; $row<=$highestRow; $row++)
    {
      $sr_id = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
      $log_time = PHPExcel_Style_NumberFormat::toFormattedString($worksheet->getCellByColumnAndRow(1, $row)->getValue(),"YYYY-M-D hh:mm:ss");
      $status = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
      $caller = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
      $workgroup = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
      $assigned_to = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
      $updated_time = PHPExcel_Style_NumberFormat::toFormattedString($worksheet->getCellByColumnAndRow(6, $row)->getValue(),"YYYY-M-D hh:mm:ss");
      $priority = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
      $category = $worksheet->getCellByColumnAndRow(8, $row)->getValue();
      $pending_reason = $worksheet->getCellByColumnAndRow(9, $row)->getValue();
      $resolution_deadline = PHPExcel_Style_NumberFormat::toFormattedString($worksheet->getCellByColumnAndRow(10, $row)->getValue(),"YYYY-M-D hh:mm:ss");
      $resolution_violation = $worksheet->getCellByColumnAndRow(11, $row)->getValue();
      $logged_by = $worksheet->getCellByColumnAndRow(12, $row)->getValue();
      $follow_up_count = $worksheet->getCellByColumnAndRow(13, $row)->getValue();
      $description = $worksheet->getCellByColumnAndRow(14, $row)->getValue();
//$mttr = $worksheet->getCellByColumnAndRow(15, $row)->getValue();
//$new = $worksheet->getCellByColumnAndRow(16, $row)->getValue();
//$age_old = $worksheet->getCellByColumnAndRow(17, $row)->getValue();
//$bucket_age = $worksheet->getCellByColumnAndRow(18, $row)->getValue();

      $data[] = array(
        'sr_id'  => $sr_id,
        'log_time'   =>$log_time,
        'status'    => $status,
        'caller'  => $caller,
        'workgroup'   => $workgroup,
        'assigned_to' => $assigned_to,
        'updated_time' =>$updated_time,
        'priority' =>$priority,
        'category' =>$category,
        'pending_reason' =>$pending_reason,
        'resolution_deadline' =>$resolution_deadline,
        'resolution_violation' =>$resolution_violation,
        'logged_by' =>$logged_by,
        'follow_up_count' =>$follow_up_count,
        'description' =>$description,
        'mttr' =>$this->cal_mttr($updated_time,$log_time),
        'new' =>$this->cal_new($log_time),
        'age_old' =>$this->cal_age_old($log_time),
        'bucket_age' =>$this->cal_bucket_age_sr_list($this->cal_age_old($log_time))
      );
    }
//   echo ("<pre>");
//   print_r($data);
//   echo ("</pre>");
//   exit();
    return $data;
  }

  public function cal_mttr($updated_time,$log_time)
  {
// echo '<br>'.$updated_time.'<br>';
// echo $log_time.'<br>';  
// $start_date = new DateTime($updated_time);
// $since_start = $start_date->diff(new DateTime($log_time));
//           echo $since_start->days.' days total<br>';
//           echo $since_start->y.' years<br>';
//           echo $since_start->m.' months<br>';
//           echo $since_start->d.' days<br>';
//           echo $since_start->h.' hours<br>';
//           echo $since_start->i.' minutes<br>';
//           echo $since_start->s.' seconds<br>';
    $hourdiff = round((strtotime($updated_time) - strtotime($log_time))/3600,2);
    $mttr = $hourdiff/24;
// echo $mttr.' hours<br>';
// exit();
    return round($mttr,2);
  }

  public function cal_new($log_time)
  {
//echo $log_time;
    $start_date = new DateTime($log_time);
    $new_value = ($start_date->format('m')==1) ? '1' : '0';
//echo $value = ($start_date->format('m')==1) ? '1' : '0';
//exit();
    return $new_value;
  }

  public function cal_age_old($log_time)
  {

$now = time(); // or your date as well
$your_date = strtotime($log_time);
$datediff = $now - $your_date;

return round($datediff / (60 * 60 * 24));
//echo '<br>'.$log_time.'<br>';
}

public function cal_bucket_age_incident_list($age)
{
  if($age>9){return "more than 9 days";}
  if($age>6){return "7-9 days";}
  if($age>3){return "4-6 days";}
  if($age<4){return "3 days";}
}

public function cal_bucket_age_sr_list($age)
{
  if($age>90){return "more than 90 days";}
  if($age>70){return "71-90 days";}
  if($age>50){return "51-70 days";}
  if($age>15){return "15-50 days";}
  if($age<=15){return "0-15 days";}
// echo $age;
// exit();
}

public function cal_workflow_error_incident_list($sla)
{
  if(trim($sla)=="9/5 Support")
  {
    return 1;
  }
  else
  {
    return 0;
  }
}
}

?>