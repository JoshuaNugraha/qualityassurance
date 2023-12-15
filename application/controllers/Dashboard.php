<?php defined('BASEPATH') OR exit('No direct script access allowed');

 
class Dashboard extends CI_Controller
{
	public $data = [];

	 	public function __construct()
	{
		parent::__construct();
          if(!$this->session->userdata('user_id')){
             redirect('login', 'refresh');
          }
           

        $this->load->model('Admin');
        

	}

    function index(){
        $user_id = $this->session->userdata('user_id');
        $group_id = $this->Admin->get_group($user_id);

        $data['menu'] = $this->db->query("SELECT * FROM menu a JOIN menu_groups b ON a.id=b.id_menu
        WHERE b.id_group = '$group_id'
        ")->result();
        $data['title'] = 'Dashboard';
        if($group_id == '1'){
            $data['page'] = 'admin';
            $this->load->view('dashboard/index', $data);
        }elseif($group_id == '2'){
            $data['page'] = 'qa/dashboard';
            $this->load->view('dashboard/index', $data);
        }elseif($group_id == '4' || '3'){
            $data['page'] = 'cs/dashboard';
            $this->load->view('dashboard/index', $data);
        }elseif($group_id == '5'){
            $data['page'] = 'programmer/main';
            $this->load->view('dashboard/index', $data);
        }
        
    }



}