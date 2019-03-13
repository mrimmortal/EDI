<?php
class Excel_import_model extends CI_Model
{
 function select()
 {
  $this->db->order_by('incident_id', 'DESC');
  $query = $this->db->get('incident_list');
  return $query;
 }
 
 function db_incident_List_Insert($data)
 {
  $this->db->insert_batch('incident_list', $data);
 }

function db_sr_List_Insert($data)
 {
  $this->db->insert_batch('sr_list', $data);
 }

}


