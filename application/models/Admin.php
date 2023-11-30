<?php
 
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Admin extends CI_Model
{

      	public function __construct()
	{
		parent::__construct();
		// if(!$this->session->userdata('user_id')){
        //      redirect('login', 'refresh');
        // }

        $this->load->model('Admin');
        $this->load->library('datatables');
        

	}

    function get_group($id){
        $get = $this->db->get_where('users_groups', ['user_id' => $id])->row('group_id');

        return $get;
    }

    function get_menu($gid){
        $get = $this->db->query("SELECT a.* FROM menu a
        JOIN menu_groups b on a.id=b.id_menu
        WHERE b.id_group = '$gid'
        ORDER BY a.urut ASC
        ")->result();

        return $get;
    }

    function get_user($uid){
        $get = $this->db->query("SELECT CONCAT(a.first_name, ' ', IFNULL( a.last_name, '')) as nama ,
        b.group_id as otoritas,
        a.username, a.email
        FROM users a
        JOIN users_groups b ON a.id=b.user_id
        JOIN groups c ON b.group_id=c.id
        WHERE a.id = '$uid'")->row();
        return  $get;
    }

    function get_komplain($id){
        $kom = $this->db->query("SELECT a.*, b.id as id_booble, b.nm_user
        FROM komplain a
        JOIN users_booble b ON a.id_user_booble=b.id
        WHERE a.id = '$id'
        ")->row();

        return $kom;
    }

   
}