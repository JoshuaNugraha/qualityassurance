<?php defined('BASEPATH') OR exit('No direct script access allowed');

 
class Qa extends CI_Controller
{

 	public function __construct()
	{
		parent::__construct();
          if(!$this->session->userdata('user_id')){
             redirect('login', 'refresh');
          }
        //   if($this->session->userdata('group_id') !== '4'){
        //     redirect('404_override', 'refresh');
        //   }
        $this->load->library('bot_tele');

        $this->load->model('Admin');
	}

    function maset_qa(){
        
    }


}