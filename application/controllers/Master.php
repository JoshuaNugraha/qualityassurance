<?php defined('BASEPATH') OR exit('No direct script access allowed');

 
class Master extends CI_Controller
{
	public $data = [];

	 	public function __construct()
	{
		parent::__construct();
          if(!$this->session->userdata('user_id')){
             redirect('login', 'refresh');
          }
          if($this->session->userdata('user_id') != '1'){
               redirect('landingpage', 'refresh');
          }

        $this->load->model('Admin');
        $this->load->library('datatables');
        

	}

    function get_user(){
        $query = $this->db->select(['a.id', 'a.email','a.pass_text' , 'a.first_name', 'a.last_name'])
        ->where('id <>', '1')
        ->from('users a');
        $column_order = array(null);
		$column_search = array('a.id', 'a.first_name');
		$order = array('a.id' => 'DESC');
        
		$list = $this->datatables->get_datatables($query, $column_order, $column_search, $order);
		$data = array();
		$no = $_POST['start'];
		$i 	= 1;
        $data = array();
        $row = array();
        foreach ($list['result'] as $tampil) {
            $row['no'] = $i;
            $row['nm_user'] = $tampil->first_name. ' '. $tampil->last_name;
            $get_oto = $this->db->query("SELECT b.name as nama FROM users_groups a JOIN groups b ON a.group_id = b.id WHERE a.user_id = '$tampil->id'")->row('nama');
            $row['otoritas'] =   $get_oto ;
            $row['login'] = '<i class="fa fa-user" aria-hidden="true"></i>'.$tampil->email . '<br>' . '<i class="fa fa-key" aria-hidden="true"></i>'. $tampil->pass_text;
            $row['aksi'] = "<div class='button-list'>
                                        <button type='button' onclick='edit(" . $tampil->id . ");' class='btn btn-twitter waves-effect waves-light btn-sm' >
                                           <i class='fa fa-pencil-square-o'></i>
                                        </button>
                               
										<button class='btn btn-danger waves-effect waves-light btn-sm' onclick='hapus(" . $tampil->id . ");'>
											<i class='fa fa-trash-o'></i>
										</button>
                        	</div>";
             
            $data[] = $row;
            $i++;
        }

        $output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->datatables->count_all($query),
			"recordsFiltered" => $list['count_filtered'],
			"data" => $data
		);
		echo json_encode($output);
    }

    function get_user_by_id(){
        $id = $this->input->post('id');

        $get_user = $this->Admin->get_user($id);
        echo json_encode(['status'=> true, 'data'=> $get_user]);

    }


}


?>