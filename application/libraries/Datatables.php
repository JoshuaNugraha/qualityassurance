<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Datatables extends CI_Model {

  function _get_datatables_query($query, $column_order, $column_search, $order) {
    
    $i = 0;
 
    foreach ($column_search as $item) 
    {
        if($_POST['search']['value']) {
             
            if ($i===0) {
                $this->db->group_start(); 
                $this->db->like($item, $_POST['search']['value']);
            } else {
                $this->db->or_like($item, $_POST['search']['value']);
            }

            if(count($column_search) - 1 == $i)
                $this->db->group_end();
        }
        $i++;
    }
     
    if(isset($_POST['order'])) {
        $this->db->order_by($column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
    } else if (isset($order)) {
        $this->db->order_by(key($order), $order[key($order)]);
    }
  }

  function get_datatables($query, $column_order, $column_search, $order) {
      $this->_get_datatables_query($query, $column_order, $column_search, $order);
      if($_POST['length'] != -1)
      $clone = clone $query;
      $this->db->limit($_POST['length'], $_POST['start']);
      $data['result'] = $query->get()->result();
      $data['count_filtered'] = $clone->get()->num_rows();
    //   $data['result'] = $query->get()->result();
    //   $data['count_filtered'] = $clone->get()->num_rows();
      return $data;
  }
  function get_datatables_rank($query, $column_order, $column_search, $order) {
      $this->_get_datatables_query($query, $column_order, $column_search, $order);
      if($_POST['length'] != -1)
      $clone = $query;
      $this->db->limit($_POST['length'], $_POST['start']);
      $data['result'] = $this->db->query($query)->result();
      $data['count_filtered'] = $this->db->query($query)->num_rows();
    //   $data['result'] = $query->get()->result();
    //   $data['count_filtered'] = $clone->get()->num_rows();
      return $data;
  }

  public function count_all($query)
  {
      return $query->count_all_results();
  }

}

/* End of file Datatables.php */
/* Location: ./application/libraries/Datatables.php */